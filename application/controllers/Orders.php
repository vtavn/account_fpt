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
    $this->load->model('account_model');

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
    $this->data['temp'] = 'client/pages/orders/index';
    $this->load->view('client/main', $this->data);
  }

  function show()
  {
    $trans_id = $this->uri->segment(3);
    $token_user = $this->session->userdata('token');
    $id_user = $this->session->userdata('uid');

    if ($trans_id) {
      //find user
      $fMem = array('token' => $token_user, 'id' => $id_user);
      $checkMem = $this->member_model->get_info_rule($fMem);
      if (!$checkMem) {
        $this->session->set_flashdata('error', 'Người dùng không tồn tại.');
        return redirect(base_url('orders'));
      } else {
        $where = array('trans_id' => $trans_id, 'buyer_id' => $checkMem->id);
        $order_info = $this->order_model->get_info_rule($where);
        if (!$order_info) {
          $this->session->set_flashdata('error', 'Đơn hàng này không phải của bạn.');
          return redirect(base_url('orders'));
        } else {
          // check order by user
          $account_info = $this->account_model->get_info_rule($where);
          if (!$account_info) {
            $this->session->set_flashdata('error', 'Đơn hàng này không phải của bạn.');
            return redirect(base_url('orders'));
          } else {
            $this->data['account_info'] = $account_info;
            $this->data['order_info'] = $order_info;
            $this->data['title'] = 'Thông tin đơn hàng #' . $order_info->trans_id;
            $this->data['temp'] = 'client/pages/orders/show';
            $this->load->view('client/main', $this->data);
          }
        }
      }
    } else {
      $this->session->set_flashdata('error', 'Thiếu giá trị truyền vào.');
      return redirect(base_url('orders'));
    }
  }
}
