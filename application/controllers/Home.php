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
    $sql = "SELECT * FROM `packages` WHERE `status` = 1 ORDER BY CAST(duration AS UNSIGNED) ASC";
    $packages = $this->package_model->query($sql);
    $this->data['list_package'] = $packages;

    $sql_account = "SELECT * FROM `accounts` WHERE `buyed_at` IS NULL AND `status` = 1 AND `ctv` != 1 ORDER BY RAND() LIMIT 8";
    $accounts = $this->account_model->query($sql_account);
    $this->data['list_account'] = $accounts;

    $sql_account_ctv = "SELECT * FROM `accounts` WHERE `buyed_at` IS NULL AND `status` = 1  AND `ctv` = 1  ORDER BY RAND() LIMIT 8";
    $accounts_ctv = $this->account_model->query($sql_account_ctv);
    $this->data['list_account_ctv'] = $accounts_ctv;

    //banner 
    $fillterS = array();
    $fillterS['order'] = array('updated_at', 'DESC');
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
