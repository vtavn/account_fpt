<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MY_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->load->model('menu_model');
    $this->load->model('member_model');

    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $input = array();
    $data = $this->menu_model->getList($input);
    $this->data['data'] = $data;

    $this->data['title'] = 'Cài đặt menu website';
    $this->data['temp'] = 'admin/menu/index';
    $this->load->view('admin/main', $this->data);
  }

  function update()
  {
    $id = $this->uri->rsegment('3');

    $where = array('id' => $id);
    $banner_info = $this->slider_model->get_info_rule($where);
    if (!$banner_info) {
      return redirect(admin_url('slider/index'));
    }

    if ($this->input->post()) {
      $this->form_validation->set_rules('name', 'Tên bắt buộc phải nhập.', 'required');

      if ($this->form_validation->run()) {
        $name = $this->input->post('name');
        $thumb = $this->input->post('thumb');
        $link = $this->input->post('link');
        $member_id = $this->session->userdata('uid');
        $status = $this->input->post('status');

        $data = array(
          'name' => $name,
          'link' => $link,
          'thumb' => $thumb,
          'member_id' => $member_id,
          'status' => $status,
        );

        insertLog('Sửa banner id: ' . $banner_info->id);
        $this->slider_model->update($banner_info->id, $data);
        $this->session->set_flashdata('success', 'Cập nhật thành công!.');
        return redirect(admin_url('slider'));
      }
    }

    $this->data['banner_info'] = $banner_info;
    $this->data['title'] = 'Sửa banner ' . $banner_info->id;
    $this->data['temp'] = 'admin/slider/update';
    $this->load->view('admin/main', $this->data);
  }

  function remove()
  {
    $id = $this->input->post('id');
    $info = $this->slider_model->getData($id);
    if (!$info) {
      $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Tài khoản không tồn tại.'
      ]);
    } else {
      insertLog('Xoá banner : ' . $id);
      $this->slider_model->delete($id);
      $data = json_encode([
        'status'    => 'success',
        'msg'       => 'Xoá banner thành công.'
      ]);
    }
    return ($data);
  }

  function create()
  {
    $input = array();
    $listMenu = $this->menu_model->getList($input);
    $this->data['listMenu'] = $listMenu;

    if ($this->input->post()) {

      $this->form_validation->set_rules('name', 'Tên bắt buộc phải nhập.', 'required');

      if ($this->form_validation->run()) {
        $name = $this->input->post('name');
        $parent_id = $this->input->post('parent_id');
        $link = $this->input->post('link');
        $status = $this->input->post('status');
        $position = $this->input->post('position');

        $data = array(
          'name' => $name,
          'link' => $link,
          'parent_id' => $parent_id,
          'status' => $status,
          'position' => $position,
        );

        if ($this->menu_model->create($data)) {
          insertLog('Tạo menu mới : ' . $name);
          $this->session->set_flashdata('success', 'Tạo menu mới thành công.');
        } else {
          $this->session->set_flashdata('error', 'Tạo thất bại vui lòng liên hệ để được hỗ trợ.');
        }

        redirect(admin_url('menu'));
      }
    }

    $this->data['title'] = 'Tạo Menu Mới';
    $this->data['temp'] = 'admin/menu/create';
    $this->load->view('admin/main', $this->data);
  }
}
