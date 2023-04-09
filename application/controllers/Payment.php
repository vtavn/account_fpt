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
    $this->load->model('account_model');
    $this->load->model('order_model');

    // if (!is_login()) {
    //   redirect(base_url('auth/login'));
    // }
  }

  public function recharge()
  {
    if (!is_login()) {
      redirect(base_url('auth/login'));
    }

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
    $this->data['temp'] = 'client/pages/invoices';
    $this->load->view('client/main', $this->data);
  }

  function totalPayment()
  {
    if ($this->input->post()) {
      $type = check_string($this->input->post('type'));
      $account_id = check_string($this->input->post('id'));
      $token = check_string($this->input->post('token'));

      if (empty($token)) {
        die('Vui lòng đăng nhập.');
      }

      if (empty($type) || empty($account_id) || empty($token)) {
        die('Lỗi vui lòng kiểm tra lại.');
      }

      if ($type == 'account') {
        $checkUser = $this->member_model->get_info_rule(['token' => $token]);
        if (!$checkUser) {
          die('Vui lòng đăng nhập.');
        }

        //get account
        $sql = "SELECT * FROM accounts WHERE id = '$account_id' AND status = 1 ORDER BY RAND() LIMIT 1";
        $result = $this->account_model->query($sql);
        if ($result) {
          $accountOK = $result[0];
          if ($accountOK->sale_price == 0) {
            $pricePay = $accountOK->price;
          } else {
            $pricePay = $accountOK->sale_price;
          }
          die(number_format($pricePay));
        } else {
          die('Tài khoản không còn.!');
        }
      }
    }

    //
  }

  function buyProduct()
  {
    if ($this->input->post()) {
      //check id
      $id_account = check_string($this->input->post('id'));
      $token = check_string($this->input->post('token'));
      $member_id = $this->session->userdata('uid');

      if (empty($id_account) || empty($token)) {
        die(json_encode(['status' => 'error', 'msg' => 'Lỗi vui lòng kiểm tra lại.']));
      }

      //get account
      $sql = "SELECT * FROM accounts WHERE id = '$id_account' AND status = 1 ORDER BY RAND() LIMIT 1";
      $result = $this->account_model->query($sql);
      if ($result) {
        $accountOK = $result[0];
        // deduct money from member 
        if ($accountOK->sale_price == 0) {
          $pricePay = $accountOK->price;
        } else {
          $pricePay = $accountOK->sale_price;
        }

        $getMoneyUser = $this->member_model->get_info_rule(['id' => $member_id, 'token' => $token])->money;
        if ($getMoneyUser < $pricePay) {
          die(json_encode(['status' => 'error', 'msg' => 'Số dư tài khoản của bạn không đủ. <br> Vui lòng nạp thêm tiền để mua tài khoản này.', 'url' => base_url('payment/recharge')]));
        } else {
          $trans_id = random("CUAQWERTYUPASDFGHJKZXCVBNM0123456789", 10);
          $time_expired = date("Y-m-d H:i:s", strtotime(convertNumberToTime($accountOK->duration)));
          $this->member_model->deductMoney("members", "money", $pricePay, $member_id);
          // update accout => out of stock
          $this->account_model->update($accountOK->id, ['trans_id' => $trans_id, 'status' => 2, 'buyer_id' => $member_id, 'updated_at' => date("Y-m-d H:i:s", time()), 'buyed_at' => date("Y-m-d H:i:s", time())]);
          // send account to history member
          $orderData = array(
            'trans_id' => $trans_id,
            'seller_id' => $accountOK->seller_id,
            'buyer_id' => $member_id,
            'package_id' => $accountOK->package_id,
            'amount' => 1,
            'pay' => $pricePay,
            'cost' => 0,
            'status' => 1,
            'expired_at' => $time_expired,
          );
          $this->order_model->create($orderData);
          //insert log
          insertLog("Mua tài khoản mã giao dịch #" . $trans_id . " hết hạn vào ngày " . $time_expired);
          die(json_encode(['status' => 'success', 'msg' => 'Mua tài khoản thành công.', 'trans_id' => $trans_id]));
        }
      } else {
        die(json_encode(['status' => 'error', 'msg' => 'Hết hàng vui lòng quay lại sau.']));
      }
    }
  }
}
