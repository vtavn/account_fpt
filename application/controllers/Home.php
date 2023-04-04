<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->data['title'] = 'Trang chủ';
    $this->data['temp'] = 'client/pages/home';
    $this->load->view('client/main', $this->data);
  }

  public function detail()
  {
    $this->data['title'] = 'Chi tiết tài khoản';
    $this->data['temp'] = 'client/pages/detail';
    $this->load->view('client/main', $this->data);
  }
}
