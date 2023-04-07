<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('package_model');
    $this->load->model('account_model');
    $this->load->model('slider_model');
  }

  public function index()
  {

    //package 
    $filterPack = array();
    $filterPack['order'] = array('id', 'DESC');
    $filterPack['where'] = array('status', '1');
    $packages = $this->package_model->getList($filterPack);
    $this->data['list_package'] = $packages;

    $fAccount = array();
    $fAccount['order'] = array('id', 'RAND()');
    $fAccount['where'] = array('status', '1');
    $fAccount['limit'] = array(8, 0);
    $accounts = $this->account_model->getList($fAccount);
    $this->data['list_account'] = $accounts;

    //banner 
    $fillterS = array();
    $fillterS['order'] = array('id', 'DESC');
    $fillterS['where'] = array('status', '1');
    $banners = $this->slider_model->getList($fillterS);
    $this->data['list_banner'] = $banners;

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
