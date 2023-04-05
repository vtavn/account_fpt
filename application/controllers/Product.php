<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('package_model');
    $this->load->model('account_model');
  }

  public function index()
  {
    $id = $this->uri->rsegment('3');

    $where = array('id' => $id);
    $package_info = $this->package_model->get_info_rule($where);
    if (!$package_info) {
      return redirect('/');
    }

    // if ($this->input->post()) {
    //   $this->form_validation->set_rules('package_id', 'Gói cần được phải chọn.', 'required');
    //   if ($this->form_validation->run()) {
    //     $package_id = $this->input->post('package_id');
    //     $name = $this->input->post('name');
    //     $price = $this->input->post('price');
    //     $sale_price = $this->input->post('sale_price');
    //     $status = $this->input->post('status');
    //     $account = $this->input->post('account');

    //     $data = array(
    //       'name' => $name,
    //       'price' => $price,
    //       'sale_price' => $sale_price,
    //       'package_id' => $package_id,
    //       'account' => $account,
    //       'status' => $status,
    //       'updated_at' => date("Y-m-d H:i:s", time())
    //     );
    //     insertLog('Mua tài khoản fpt ' . $package_info->name);
    //     $this->account_model->update($package_info->id, $data);
    //     $this->session->set_flashdata('success', 'Cập nhật thành công!.');
    //     return redirect(admin_url('account'));
    //   }
    // }

    $this->data['package_info'] = $package_info;
    $this->data['title'] = 'Mua tài khoản FPT ' . $package_info->name;
    $this->data['temp'] = 'client/pages/detail';
    $this->load->view('client/main', $this->data);
  }
}
