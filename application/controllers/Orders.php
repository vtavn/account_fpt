<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('bank_model');
    $this->load->model('member_model');
    $this->load->model('invoice_model');

    $this->load->model('order_model');

    if (!is_login()) {
      redirect(base_url('auth/login'));
    }
  }

  function index()
  {
    $where = "WHERE buyer_id = '" . $this->session->userdata('uid') . "'";

    $sql_2 = 'SELECT count(id) as total from orders ' . $where;
    $total_rows = $this->order_model->query($sql_2);
    $this->data['total_rows'] = $total_rows[0]->total;

    $config = array();
    $config['total_rows'] = $total_rows[0]->total;
    $config['base_url'] = base_url('order/index');
    $config['per_page'] = 15;
    $config['reuse_query_string'] = true;
    $config['uri_segment'] = 4;
    $this->pagination->initialize($config);
    $segment = $this->uri->segment(3);
    $segment = intval($segment);
    $limit = 'LIMIT ' . $segment . ', ' . $config['per_page'];
    $sql = 'SELECT * FROM orders ' . $where . ' ORDER BY id DESC ' . $limit;
    $list_orders = $this->order_model->query($sql);
    $this->data['list_orders'] = $list_orders;
    $pagination = $this->pagination->create_links();
    $this->data['pagination'] = $pagination;
    // end pagination

    $this->data['title'] = 'Lịch sử mua hàng';
    $this->data['temp'] = 'client/pages/orders';
    $this->load->view('client/main', $this->data);
  }
}
