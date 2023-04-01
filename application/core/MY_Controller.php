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
    // $this->setting_model = 

    if ($this->session->userdata('uid') && $this->session->userdata('username') && $this->session->userdata('uemail') && $this->session->userdata('urole')) {
      $userId = $this->session->userdata('uid');
      $username = $this->session->userdata('username');
      $uemail = $this->session->userdata('uemail');
      $urole = $this->session->userdata('urole');
    }
  }

  /**
   * * all user
   * @ login 
   * admin administrator
   */
  protected $access = "*";

  public function login_check()
  {
    if ($this->access != "*") {
      if (!$this->permissionCheck()) {
        die('Access denied');
      }
      if (!$this->session->userdata('uid')) {
        redirect(base_url('auth/login'));
      }
    }
  }

  public function permissionCheck()
  {
    if ($this->access == "@") {
      return true;
    } else {
      $access = is_array($this->access) ? $this->access : explode(",",  $this->access);
      if (in_array($this->session->userdata("role"), $access)) {
        return true;
      }
      return false;
    }
  }
}
