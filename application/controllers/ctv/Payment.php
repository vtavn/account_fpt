<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends MY_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->load->model('package_model');
    $this->load->model('account_model');
    $this->load->model('invoice_model');
    $this->load->model('member_model');
    $this->load->model('bank_model');

    $packS['where'] = array('deleted_at' => null);
    $allPackage = $this->package_model->getList($packS);
    $this->data['all_packages'] = $allPackage;

    if (!is_ctv()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    if (!is_login()) {
      redirect(base_url('auth/login'));
    }

    $where = "WHERE member_id = '" . $this->session->userdata('uid') . "'";

    $sql_2 = 'SELECT count(id) as total from invoices ' . $where;
    $total_rows = $this->invoice_model->query($sql_2);
    $this->data['total_rows'] = $total_rows[0]->total;

    $config = array();
    $config['total_rows'] = $total_rows[0]->total;
    $config['base_url'] = base_url('payment/invoices');
    $config['per_page'] = 15;
    $config['reuse_query_string'] = true;
    $config['uri_segment'] = 4;
    $this->pagination->initialize($config);
    $segment = $this->uri->segment(3);
    $segment = intval($segment);
    $limit = 'LIMIT ' . $segment . ', ' . $config['per_page'];
    $sql = 'SELECT * FROM invoices ' . $where . ' ORDER BY id DESC ' . $limit;
    $list_invoices = $this->invoice_model->query($sql);
    $this->data['list_invoices'] = $list_invoices;
    $pagination = $this->pagination->create_links();
    $this->data['pagination'] = $pagination;
    // end pagination

    $this->data['title'] = 'Danh sách hoá đơn';
    $this->data['temp'] = 'ctv/invoice/index';
    $this->load->view('ctv/main', $this->data);
  }

  function create()
  {
    $member_id = $this->session->userdata('uid');
    $where = "WHERE id like '%'";
    $where .= " AND ctv != 0 AND member_id = '" . $member_id . "' AND status = '1'";
    $sql = 'SELECT * FROM banks ' . $where;
    $data = $this->bank_model->query($sql);
    $this->data['data'] = $data;

    if ($this->input->post()) {
      $this->form_validation->set_rules('type', 'Phương thức thanh toán cần được phải chọn.', 'required');
      $this->form_validation->set_rules('amount', 'Số tiền nạp cần phải chọn.', 'required');
      if ($this->form_validation->run()) {
        $type = check_string($this->input->post('type'));
        $amount = check_string($this->input->post('amount'));
        $uid = $this->session->userdata('uid');

        //check bank
        $fBank = array('id' => $type);
        $checkBank = $this->bank_model->get_info_rule($fBank);
        if (!$checkBank) {
          die(json_encode(['status' => 'error', 'msg' => 'Phương thức thanh toán không tồn tại trong hệ thống']));
        }

        //check token
        $fMem = array('id' => $uid);
        $checkMem = $this->member_model->get_info_rule($fMem);
        if (!$checkMem) {
          die(json_encode(['status' => 'error', 'msg' => 'Tài khoản bị chặn rút tiền hoặc chưa đăng nhập. Vui lòng thử lại.']));
        }

        //check amount
        if ($amount < 100000) {
          die(json_encode(['status' => 'error', 'msg' => 'Số tiền rút tối thiểu là 100.000 vnđ']));
        }
        if ($checkMem->money_ctv < $amount) {
          die(json_encode(['status' => 'error', 'msg' => 'Số tiền rút lớn hơn số dư của bạn.']));
        }
        $trans_id = random("CUAQWERTYUPASDFGHJKZXCVBNM123456789", 5);

        $data = array(
          'type' => 'withdraw_money',
          'member_id' => $checkMem->id,
          'trans_id' => $trans_id,
          'payment_method' => $checkBank->name,
          'amount' => $amount,
          'pay' => 0,
          'status' => 0
        );

        if ($this->invoice_model->create($data)) {
          insertLog("Tạo hoá đơn rút tiền #" . $trans_id);
          $this->member_model->deductMoney("members", "money_ctv", $amount, $checkMem->id);
          die(json_encode(['status' => 'success', 'msg' => 'Tạo hoá đơn thành công', 'trans_id' => $trans_id]));
        } else {
          die(json_encode(['status' => 'error', 'msg' => 'Tạo hoá đơn thất bại, vui lòng thử lại']));
        }
      }
    }

    $this->data['title'] = 'Rút tiền về tài khoản';
    $this->data['temp'] = 'ctv/invoice/create';
    $this->load->view('ctv/main', $this->data);
  }
}
