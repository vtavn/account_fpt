<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('package_model');
    $this->load->model('account_model');
    $this->load->model('order_model');
  }

  function index()
  {
    $id = $this->uri->rsegment('4');

    $where = array('id' => $id);
    $package_info = $this->package_model->get_info_rule($where);
    if (!$package_info) {
      return redirect(base_url('/'));
    }

    $sql_account = "SELECT * FROM `accounts` WHERE `buyed_at` IS NULL AND `status` = 1 ORDER BY RAND() LIMIT 8";
    $accounts = $this->account_model->query($sql_account);
    $this->data['list_account'] = $accounts;

    $this->data['package_info'] = $package_info;
    $this->data['title'] = 'Mua tài khoản FPT ' . $package_info->name;
    $this->data['temp'] = 'client/pages/detail';
    $this->load->view('client/main', $this->data);
  }

  function buyAccount()
  {
    if ($this->input->post()) {
      //check package id
      $package_id = check_string($this->input->post('package_id'));
      $where = array('id' => $package_id);
      $package_info = $this->package_model->get_info_rule($where);
      if (!$package_info) {
        die(json_encode(['status' => 'error', 'msg' => 'Lỗi vui lòng thử lại sau.']));
      } else {
        //get account
        $sql = "SELECT * FROM accounts WHERE package_id = '$package_id' AND status = 1 ORDER BY RAND() LIMIT 1";
        $result = $this->account_model->query($sql);
        if ($result) {
          $accountOK = $result[0];
          $member_id = $this->session->userdata('uid');
          $token = check_string($this->input->post('token'));
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
          die(json_encode(['status' => 'error', 'msg' => 'Hết hàng vui lòng quay lại sau']));
        }
      }
    }
  }
}
