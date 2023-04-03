<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {

    $this->data['temp'] = 'admin/dashboard/index';
    $this->load->view('admin/main', $this->data);
  }
}
