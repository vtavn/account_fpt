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
    $this->load->view('client/main', $this->data);
  }
}
