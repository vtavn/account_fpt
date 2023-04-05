<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends MY_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->load->model('log_model');
    $this->load->model('account_model');

    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $mS = array();

    //get list member ctv/admin
    $this->load->model('member_model');
    $mS['where'] = array('role_id !=' => '1');
    $members = $this->member_model->getList($mS);
    $this->data['members'] = $members;

    //search 
    $accountS = $this->input->get('member_id');
    $actionS = $this->input->get('action');
    $ipS = $this->input->get('ip');
    $deviceS = $this->input->get('device');

    $where = "WHERE id like '%'";

    if ($accountS) {
      $where .= " AND member_id LIKE '%" . $accountS . "%'";
    }
    if ($actionS) {
      $where .= " AND action LIKE '%" . $actionS . "%'";
    }
    if ($ipS) {
      $where .= " AND ip LIKE '%" . $ipS . "%'";
    }
    if ($deviceS) {
      $where .= " AND device LIKE '%" . $deviceS . "%'";
    }

    $sql_2 = 'SELECT count(id) as total from logs ' . $where;
    $total_rows = $this->log_model->query($sql_2);
    $this->data['total_rows'] = $total_rows[0]->total;

    $config = array();
    $config['total_rows'] = $total_rows[0]->total;
    $config['base_url'] = admin_url('account/index');
    $config['per_page'] = 15;
    $config['reuse_query_string'] = true;
    $config['uri_segment'] = 4;
    $this->pagination->initialize($config);
    $segment = $this->uri->segment(4);
    $segment = intval($segment);
    $limit = 'LIMIT ' . $segment . ', ' . $config['per_page'];
    $sql = 'SELECT * FROM logs ' . $where . ' ORDER BY id DESC ' . $limit;
    $data = $this->log_model->query($sql);
    $this->data['data'] = $data;
    $pagination = $this->pagination->create_links();
    $this->data['pagination'] = $pagination;
    // end pagination
    $this->data['title'] = 'Nhật ký hoạt động';
    $this->data['temp'] = 'admin/log/index';
    $this->load->view('admin/main', $this->data);
  }
}
