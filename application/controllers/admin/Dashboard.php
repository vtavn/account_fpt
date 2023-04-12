<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('account_model');
    $this->load->model('order_model');
    $this->load->model('member_model');

    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {

    $sql = "SELECT COUNT(*) as count FROM `accounts`";
    $all_accounts = $this->account_model->query($sql);
    $this->data['all_accounts'] = $all_accounts[0]->count;

    $sql2 = "SELECT COUNT(*) as count FROM `orders`";
    $all_orders = $this->order_model->query($sql2);
    $this->data['all_orders'] = $all_orders[0]->count;

    $sql3 = "SELECT COUNT(*) as count FROM `members`";
    $all_members = $this->member_model->query($sql3);
    $this->data['all_members'] = $all_members[0]->count;

    $sql4 = "SELECT SUM(pay) AS total FROM `orders` WHERE `ctv` != 1";
    $total_orders = $this->order_model->query($sql4);
    $this->data['total_orders'] = $total_orders[0]->total;


    $this->data['title'] = 'Trang thống kê';
    $this->data['temp'] = 'admin/dashboard/index';
    $this->load->view('admin/main', $this->data);
  }
}
