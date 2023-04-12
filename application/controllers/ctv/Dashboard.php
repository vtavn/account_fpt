<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    if (!is_ctv()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {

    $this->data['title'] = 'Trang thống kê';
    $this->data['temp'] = 'ctv/dashboard/index';
    $this->load->view('ctv/main', $this->data);
  }
}
