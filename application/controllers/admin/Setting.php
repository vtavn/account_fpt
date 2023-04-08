<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends MY_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->load->model('setting_model');

    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $input = array();
    $data = $this->setting_model->getList($input);
    $this->data['data'] = $data;

    if ($this->input->post()) {

      $data = $this->input->post();

      foreach ($data as $key => $value) {
        $this->setting_model->update_setting($key, $value);
        insertLog('Sửa cài đặt.');
        $this->session->set_flashdata('success', 'Cập nhật thành công!.');
      }
      return redirect(admin_url('setting'));
    }

    $this->data['title'] = 'Cài đặt website';
    $this->data['temp'] = 'admin/setting/index';
    $this->load->view('admin/main', $this->data);
  }

  function update()
  {
    //list menu
    $input = array();
    $listMenu = $this->menu_model->getList($input);
    $this->data['listMenu'] = $listMenu;

    $id = $this->uri->rsegment('3');

    $where = array('id' => $id);
    $menu_info = $this->menu_model->get_info_rule($where);
    if (!$menu_info) {
      return redirect(admin_url('slider/index'));
    }

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

        insertLog('Sửa menu id: ' . $menu_info->id);
        $this->menu_model->update($menu_info->id, $data);
        $this->session->set_flashdata('success', 'Cập nhật thành công!.');
        return redirect(admin_url('menu'));
      }
    }

    $this->data['menu_info'] = $menu_info;
    $this->data['title'] = 'Sửa menu: ' . $menu_info->id;
    $this->data['temp'] = 'admin/menu/update';
    $this->load->view('admin/main', $this->data);
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
