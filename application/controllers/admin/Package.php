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

  // function update()
  // {
  //   $id = $this->uri->rsegment('3');

  //   $where = array('id' => $id);
  //   $user_info = $this->member_model->get_info_rule($where);
  //   if (!$user_info) {
  //     return redirect(admin_url('member/index'));
  //   }

  //   if ($this->input->post()) {
  //     $email = $this->input->post('email');
  //     $username = $this->input->post('username');
  //     $name = $this->input->post('name');
  //     $phone = $this->input->post('phone');
  //     $password = $this->input->post('password');
  //     $status = $this->input->post('status');
  //     $role_id = $this->input->post('role_id');

  //     if ($password != '') {
  //       $data = array(
  //         'email' => $email,
  //         'name' => $name,
  //         'username' => $username,
  //         'password' => md5($password),
  //         'phone' => $phone,
  //         'status' => $status,
  //         'role_id' => $role_id,
  //         'updated_at' => date("Y-m-d H:i:s", time()),
  //       );
  //     } else {
  //       $data = array(
  //         'email' => $email,
  //         'name' => $name,
  //         'username' => $username,
  //         'phone' => $phone,
  //         'status' => $status,
  //         'role_id' => $role_id,
  //         'updated_at' => date("Y-m-d H:i:s", time()),
  //       );
  //     }
  //     $this->member_model->update($user_info->id, $data);
  //     $this->session->set_flashdata('success', 'Cập nhật thành công!.');
  //     return redirect(admin_url('member'));
  //   }

  //   $this->data['user_info'] = $user_info;
  //   $this->data['temp'] = 'admin/member/update';
  //   $this->load->view('admin/main', $this->data);
  // }

  // function remove()
  // {
  //   $id = $this->input->post('id');
  //   $info = $this->member_model->getData($id);
  //   if (!$info) {
  //     $data = json_encode([
  //       'status'    => 'error',
  //       'msg'       => 'Tài khoản không tồn tại.'
  //     ]);
  //   } else {
  //     $data = array(
  //       'status' => 0,
  //       'deleted_at' => date("Y-m-d H:i:s", time()),
  //     );
  //     $this->member_model->update($id, $data);
  //     $data = json_encode([
  //       'status'    => 'success',
  //       'msg'       => 'Xoá tài khoản người dùng thành công.'
  //     ]);
  //   }
  //   return ($data);
  // }

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
