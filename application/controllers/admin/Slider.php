<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends MY_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->load->model('slider_model');
    $this->load->model('member_model');

    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $input = array();

    // pagination
    $input['order'] = array('id', 'DESC');
    $total_rows = $this->slider_model->getTotal($input);
    $this->data['total_rows'] = $total_rows;
    $config = array();
    $config['total_rows'] = $total_rows;
    $config['base_url'] = admin_url('member/index');
    $config['per_page'] = 15;
    $config['uri_segment'] = 4;
    $this->pagination->initialize($config);
    $segment = $this->uri->segment(4);
    $segment = intval($segment);
    $input['limit'] = array($config['per_page'], $segment);
    $data = $this->slider_model->getList($input);
    $this->data['data'] = $data;
    $pagination = $this->pagination->create_links();
    $this->data['pagination'] = $pagination;
    // end pagination

    $this->data['title'] = 'Danh sách banner';
    $this->data['temp'] = 'admin/slider/index';
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

        if ($this->slider_model->create($data)) {
          insertLog('Tạo banner home mới thành công : ' . $name);
          $this->session->set_flashdata('success', 'Tạo banner home mới thành công.');
        } else {
          $this->session->set_flashdata('error', 'Tạo thất bại vui lòng liên hệ để được hỗ trợ.');
        }

        redirect(admin_url('slider'));
      }
    }

    $this->data['title'] = 'Tạo Banner Mới';
    $this->data['temp'] = 'admin/slider/create';
    $this->load->view('admin/main', $this->data);
  }
}
