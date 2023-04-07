<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('bank_model');
    $this->load->model('member_model');
    $this->load->model('invoice_model');
    if (!is_login()) {
      redirect(base_url('auth/login'));
    }
  }

  public function recharge()
  {
    $fillterS = array();
    $fillterS['order'] = array('id', 'DESC');
    $banks = $this->bank_model->getList($fillterS);
    $this->data['list_banks'] = $banks;

    $this->data['title'] = 'Nạp tiền';
    $this->data['temp'] = 'client/pages/recharge';
    $this->load->view('client/main', $this->data);
  }

  function create()
  {
    if ($this->input->post()) {
      $this->form_validation->set_rules('type', 'Phương thức thanh toán cần được phải chọn.', 'required');
      $this->form_validation->set_rules('amount', 'Số tiền nạp cần phải chọn.', 'required');
      $this->form_validation->set_rules('token', 'Vui lòng đăng nhập để nạp tiền.', 'required');
      if ($this->form_validation->run()) {
        $type = check_string($this->input->post('type'));
        $amount = check_string($this->input->post('amount'));
        $token = check_string($this->input->post('token'));

        //check bank
        $fBank = array('id' => $type);
        $checkBank = $this->bank_model->get_info_rule($fBank);
        if (!$checkBank) {
          die(json_encode(['status' => 'error', 'msg' => 'Phương thức thanh toán không tồn tại trong hệ thống']));
        }

        //check token
        $fMem = array('token' => $token);
        $checkMem = $this->member_model->get_info_rule($fMem);
        if (!$checkMem) {
          die(json_encode(['status' => 'error', 'msg' => 'Tài khoản bị chặn nạp tiền hoặc chưa đăng nhập. Vui lòng thử lại.']));
        }

        //check amount pay
        if ($amount < 10000) {
          die(json_encode(['status' => 'error', 'msg' => 'Số tiền nạp tối thiểu là 10.000 vnđ']));
        }

        $trans_id = random("CUAQWERTYUPASDFGHJKZXCVBNM123456789", 5);

        $data = array(
          'type' => 'deposit_money',
          'member_id' => $checkMem->id,
          'trans_id' => $trans_id,
          'payment_method' => $checkBank->name,
          'amount' => $amount,
          'pay' => 0,
          'status' => 0
        );

        if ($this->invoice_model->create($data)) {
          insertLog("Tạo hoá đơn nạp tiền #" . $trans_id);
          die(json_encode(['status' => 'success', 'msg' => 'Tạo hoá đơn thành công', 'trans_id' => $trans_id]));
        } else {
          die(json_encode(['status' => 'error', 'msg' => 'Tạo hoá đơn thất bại, vui lòng thử lại']));
        }
      }
    }
  }

  function invoice()
  {
    //check invoice
    if ($this->input->post()) {
      $trans_id = $this->input->post('trans_id');
      $where = array('trans_id' => $trans_id);
      $invoice_info = $this->invoice_model->get_info_rule($where);
      if ($invoice_info) {
        die(json_encode([
          'status' => display_invoice($invoice_info->status),
          'return' => $invoice_info->status
        ]));
      }
    }

    $trans_id = $this->uri->rsegment('3');
    $where = array('trans_id' => $trans_id);
    $invoice_info = $this->invoice_model->get_info_rule($where);
    if (!$invoice_info) {
      return redirect(base_url('/'));
    }

    $fBank = array('name' => $invoice_info->payment_method);
    $info_bank = $this->bank_model->get_info_rule($fBank);
    $this->data['invoice_info'] = $invoice_info;
    $this->data['info_bank'] = $info_bank;

    $this->data['title'] = 'Thanh toán hoá đơn mã #' . $invoice_info->trans_id . ' số tiền: ' . $invoice_info->amount;
    $this->load->view('client/pages/invoice', $this->data);
  }

  function invoices()
  {
    $where = "WHERE member_id = '" . $this->session->userdata('uid') . "'";
    $sql = 'SELECT * FROM invoices ' . $where . ' ORDER BY id DESC ';
    $list_invoice = $this->invoice_model->query($sql);
    $this->data['list_invoices'] = $list_invoice;

    $this->data['title'] = 'Danh sách hoá đơn';
    $this->data['temp'] = 'client/pages/invoices';
    $this->load->view('client/main', $this->data);
  }
}
