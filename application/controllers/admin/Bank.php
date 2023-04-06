<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('bank_model');
    $this->load->model('member_model');
    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $input = array();
    $data = $this->bank_model->getList($input);
    $this->data['data'] = $data;
    $this->data['listBankDefault'] = $this->config->item('config_listbank');
    $this->data['title'] = 'Danh sách ngân hàng';
    $this->data['temp'] = 'admin/bank/index';
    $this->load->view('admin/main', $this->data);
  }

  function update()
  {
    $id = $this->uri->rsegment('3');
    $where = array('id' => $id);
    $bank_info = $this->bank_model->get_info_rule($where);
    if (!$bank_info) {
      return redirect(admin_url('bank'));
    }

    $input = array();
    $data = $this->bank_model->getList($input);
    $this->data['data'] = $data;
    $this->data['listBankDefault'] = $this->config->item('config_listbank');

    if ($this->input->post()) {
      $this->form_validation->set_rules('name', 'Tên ngân hàng cần được chọn.', 'required');

      if ($this->form_validation->run()) {
        $name = $this->input->post('name');
        $thumb = $this->input->post('thumb');
        $accountName = $this->input->post('accountName');
        $accountNumber = $this->input->post('accountNumber');
        $member_id = $this->session->userdata('uid');

        $data = array(
          'name' => $name,
          'thumb' => $thumb,
          'accountName' => $accountName,
          'accountNumber' => $accountNumber,
          'member_id' => $member_id,
        );
        $this->bank_model->update($bank_info->id, $data);
        insertLog('Sửa thành công ngân hàng: ' . $bank_info->name . ' STK: ' . $bank_info->accountNumber . ' Tên: ' . $bank_info->accountName . ' => ' . $name . ' STK: ' . $accountNumber . ' Tên: ' . $accountName);
        $this->session->set_flashdata('success', 'Cập nhật thành công!.');
        return redirect(admin_url('bank'));
      }
    }

    $this->data['bank_info'] = $bank_info;
    $this->data['title'] = 'Sửa thông tin ngân hàng: ' . $bank_info->id;
    $this->data['temp'] = 'admin/bank/update';
    $this->load->view('admin/main', $this->data);
  }

  function remove()
  {
    $id = $this->input->post('id');
    $info = $this->bank_model->getData($id);
    if (!$info) {
      $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Ngân hàng không tồn tại.'
      ]);
    } else {
      $data = array(
        'status' => 0,
        'deleted_at' => date("Y-m-d H:i:s", time()),
      );
      insertLog('Xoá ngân hàng' . $info->name . ' STK: ' . $info->accountNumber . ' Tên: ' . $info->accountName);
      $this->bank_model->delete($id);
      $data = json_encode([
        'status'    => 'success',
        'msg'       => 'Xoá ngân hàng thành công.'
      ]);
    }
    return ($data);
  }

  function create()
  {
    if ($this->input->post()) {

      $this->form_validation->set_rules('name', 'Tên ngân hàng cần được chọn.', 'required');

      if ($this->form_validation->run()) {
        $name = $this->input->post('name');
        $thumb = $this->input->post('thumb');
        $accountName = $this->input->post('accountName');
        $accountNumber = $this->input->post('accountNumber');
        $member_id = $this->session->userdata('uid');

        $data = array(
          'name' => $name,
          'thumb' => $thumb,
          'accountName' => $accountName,
          'accountNumber' => $accountNumber,
          'member_id' => $member_id,
        );

        if ($this->bank_model->create($data)) {
          insertLog('Thêm thành công ngân hàng: ' . $name . ' STK: ' . $accountNumber . ' Tên: ' . $accountName);
          $this->session->set_flashdata('success', 'Thêm ngân hàng thành công.');
        } else {
          $this->session->set_flashdata('error', 'Tạo ngân hàng thất bại vui lòng liên hệ để được hỗ trợ.');
        }

        redirect(admin_url('bank'));
      }
    }
  }
}
