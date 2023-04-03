<?php
class MY_Controller extends CI_Controller
{
  public $data = array();

  function __construct()
  {
    parent::__construct();
    $controller = $this->uri->rsegment('1');
    $action = $this->uri->rsegment('2');
    $this->data['controller'] = $controller;
    $this->data['action'] = $action;

    //load setting 
    $this->load->model('setting_model');
    $this->load->model('member_model');
    // $this->setting_model = 

    if ($this->session->userdata('uid') && $this->session->userdata('urole')) {
      $this->data['userId'] = $this->session->userdata('uid');
      $user = $this->member_model->get_info_rule(['id' => $this->session->userdata('uid')]);
      $this->data['user'] = $user;
    }
  }
}
