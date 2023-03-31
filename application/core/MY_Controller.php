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
  }
}
