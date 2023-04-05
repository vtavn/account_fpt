<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Package extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('package_model');
    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $input = array();

    // pagination
    $input['order'] = array('id', 'DESC');
    $input['where'] = array('deleted_at' => null);
    $total_rows = $this->package_model->getTotal($input);
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
    $data = $this->package_model->getList($input);
    $this->data['data'] = $data;
    $pagination = $this->pagination->create_links();
    $this->data['pagination'] = $pagination;
    // end pagination

    $this->data['title'] = 'Danh sách gói';
    $this->data['temp'] = 'admin/package/index';
    $this->load->view('admin/main', $this->data);
  }

  function update()
  {
    $id = $this->uri->rsegment('3');

    $where = array('id' => $id);
    $package_info = $this->package_model->get_info_rule($where);
    if (!$package_info) {
      return redirect(admin_url('package/index'));
    }

    if ($this->input->post()) {
      $name = $this->input->post('name');
      $content = $this->input->post('content');
      $short_content = $this->input->post('short_content');
      $price = $this->input->post('price');
      $sale_price = $this->input->post('sale_price');
      $thumb = $this->input->post('thumb');
      $status = $this->input->post('status');
      $member_id = $this->session->userdata('uid');

      $data = array(
        'name' => $name,
        'content' => $content,
        'short_content' => $short_content,
        'price' => $price,
        'sale_price' => $sale_price,
        'thumb' => $thumb,
        'status' => $status,
        'member_id' => $member_id,
        'updated_at' => date("Y-m-d H:i:s", time()),
      );
      insertLog('Sửa gói cước ' . $name);
      $this->package_model->update($package_info->id, $data);
      $this->session->set_flashdata('success', 'Cập nhật thành công!.');
      return redirect(admin_url('package'));
    }

    $this->data['package_info'] = $package_info;
    $this->data['temp'] = 'admin/package/update';
    $this->data['title'] = 'Sửa gói cước: ' . $package_info->name;
    $this->load->view('admin/main', $this->data);
  }

  function remove()
  {
    $id = $this->input->post('id');
    $info = $this->package_model->getData($id);
    if (!$info) {
      $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Gói không tồn tại.'
      ]);
    } else {
      $data = array(
        'status' => 0,
        'deleted_at' => date("Y-m-d H:i:s", time()),
      );
      insertLog('Xoá gói cước ' . $info->name);
      $this->package_model->update($id, $data);
      $data = json_encode([
        'status'    => 'success',
        'msg'       => 'Xoá gói thành công.'
      ]);
    }
    return ($data);
  }

  function create()
  {
    if ($this->input->post()) {
      $this->form_validation->set_rules('name', 'Tên gói cần được điền.', 'required');

      if ($this->form_validation->run()) {
        $name = $this->input->post('name');
        $content = $this->input->post('content');
        $short_content = $this->input->post('short_content');
        $price = $this->input->post('price');
        $sale_price = $this->input->post('sale_price');
        $thumb = $this->input->post('thumb');
        $status = $this->input->post('status');
        $member_id = $this->session->userdata('uid');

        $data = array(
          'name' => $name,
          'content' => $content,
          'short_content' => $short_content,
          'price' => $price,
          'sale_price' => $sale_price,
          'thumb' => $thumb,
          'status' => $status,
          'member_id' => $member_id
        );

        if ($this->package_model->create($data)) {
          insertLog('Thêm gói cước ' . $name);
          $this->session->set_flashdata('success', 'Thêm gói thành công.');
        } else {
          $this->session->set_flashdata('error', 'Tạo gói thất bại vui lòng liên hệ để được hỗ trợ.');
        }

        redirect(admin_url('package/create'));
      }
    }

    $this->data['title'] = 'Tạo gói mới';
    $this->data['temp'] = 'admin/package/create';
    $this->load->view('admin/main', $this->data);
  }
}
