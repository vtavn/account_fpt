<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('bank_model');
    $this->load->model('member_model');
    if (!is_ctv()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $member_id = $this->session->userdata('uid');
    $where = "WHERE id like '%'";
    $where .= " AND ctv != 0 AND member_id = '" . $member_id . "'";
    $sql = 'SELECT * FROM banks ' . $where;
    $data = $this->bank_model->query($sql);

    $this->data['data'] = $data;
    $this->data['listBankDefault'] = $this->config->item('config_listbank');
    $this->data['title'] = 'Danh sách ngân hàng của bạn';
    $this->data['temp'] = 'ctv/bank/index';
    $this->load->view('ctv/main', $this->data);
  }

  // function update()
  // {
  //   $id = $this->uri->rsegment('3');
  //   $where = array('id' => $id);
  //   $bank_info = $this->bank_model->get_info_rule($where);
  //   if (!$bank_info) {
  //     return redirect(ctv_url('bank'));
  //   }

  //   $input = array();
  //   $data = $this->bank_model->getList($input);
  //   $this->data['data'] = $data;
  //   $this->data['listBankDefault'] = $this->config->item('config_listbank');

  //   if ($this->input->post()) {
  //     $this->form_validation->set_rules('name', 'Tên ngân hàng cần được chọn.', 'required');

  //     if ($this->form_validation->run()) {
  //       $name = $this->input->post('name');
  //       $thumb = $this->input->post('thumb');
  //       $accountName = $this->input->post('accountName');
  //       $accountNumber = $this->input->post('accountNumber');
  //       $member_id = $this->session->userdata('uid');

  //       $data = array(
  //         'name' => $name,
  //         'thumb' => $thumb,
  //         'accountName' => $accountName,
  //         'accountNumber' => $accountNumber,
  //         'member_id' => $member_id,
  //       );
  //       $this->bank_model->update($bank_info->id, $data);
  //       insertLog('Sửa thành công ngân hàng: ' . $bank_info->name . ' STK: ' . $bank_info->accountNumber . ' Tên: ' . $bank_info->accountName . ' => ' . $name . ' STK: ' . $accountNumber . ' Tên: ' . $accountName);
  //       $this->session->set_flashdata('success', 'Cập nhật thành công!.');
  //       return redirect(ctv_url('bank'));
  //     }
  //   }

  //   $this->data['bank_info'] = $bank_info;
  //   $this->data['title'] = 'Sửa thông tin ngân hàng: ' . $bank_info->id;
  //   $this->data['temp'] = 'admin/bank/update';
  //   $this->load->view('admin/main', $this->data);
  // }


  function create()
  {
    if ($this->input->post()) {

      $this->form_validation->set_rules('name', 'Tên ngân hàng cần được chọn.', 'required');

      if ($this->form_validation->run()) {
        $name = check_string($this->input->post('name'));
        $thumb = check_string($this->input->post('thumb'));
        $accountName = check_string($this->input->post('accountName'));
        $accountNumber = check_string($this->input->post('accountNumber'));
        $member_id = $this->session->userdata('uid');

        $data = array(
          'name' => $name,
          'thumb' => $thumb,
          'accountName' => $accountName,
          'accountNumber' => $accountNumber,
          'member_id' => $member_id,
          'ctv' => 1,
          'status' => 0
        );

        if ($this->bank_model->create($data)) {
          insertLog('Thêm ngân hàng: ' . $name . ' STK: ' . $accountNumber . ' Tên: ' . $accountName);
          $this->session->set_flashdata('success', 'Thêm ngân hàng thành công.');
        } else {
          $this->session->set_flashdata('error', 'Tạo ngân hàng thất bại vui lòng liên hệ để được hỗ trợ.');
        }

        redirect(ctv_url('bank'));
      }
    }
  }
}
