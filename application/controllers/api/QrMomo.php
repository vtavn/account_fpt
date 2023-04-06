<?php
defined('BASEPATH') or exit('No direct script access allowed');

class QrMomo extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  function create()
  {
    //api/qrmomo/create?amount=100000&phone=0919257664&noidung=QR200
    $amount = $this->input->get('amount');
    $phone = $this->input->get('phone');
    $content = $this->input->get('noidung');

    $linkImg = "https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=2|99|$phone|||0|0|$amount|$content|transfer_myqr";
    $this->data['linkImg'] = $linkImg;
    $this->data['title'] = $phone . ' - ' . $amount . ' Create Momo QR by Cua';
    $this->load->view('api/qrmomo', $this->data);
  }
}
