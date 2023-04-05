<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
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
    $input['where'] = array('deleted_at' => null);
    $total_rows = $this->member_model->getTotal($input);
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
    $data = $this->member_model->getList($input);
    $this->data['data'] = $data;
    $pagination = $this->pagination->create_links();
    $this->data['pagination'] = $pagination;
    // end pagination

    $input['where'] = array('status = ' => 1, 'deleted_at' => null);
    $countMemberAc = $this->member_model->getTotal($input);
    $input['where'] = array('status = ' => 0, 'deleted_at' => null);
    $countMemberB = $this->member_model->getTotal($input);
    $input['where'] = array('role_id = ' => 3, 'deleted_at' => null);
    $countAdmin = $this->member_model->getTotal($input);
    $input['where'] = array('role_id = ' => 2, 'deleted_at' => null);

    $countCTV = $this->member_model->getTotal($input);
    $totalMoney = $this->member_model->getSum('money');

    $this->data['member_count'] = $countMemberAc;
    $this->data['member_ban_count'] = $countMemberB;
    $this->data['admin_count'] = $countAdmin;
    $this->data['ctv_count'] = $countCTV;
    $this->data['total_money'] = $totalMoney;

    $this->data['title'] = 'Danh sách thành viên';
    $this->data['temp'] = 'admin/member/index';
    $this->load->view('admin/main', $this->data);
  }

  function update()
  {
    $id = $this->uri->rsegment('3');

    $where = array('id' => $id);
    $user_info = $this->member_model->get_info_rule($where);
    if (!$user_info) {
      return redirect(admin_url('member/index'));
    }

    if ($this->input->post()) {
      $email = $this->input->post('email');
      $username = $this->input->post('username');
      $name = $this->input->post('name');
      $phone = $this->input->post('phone');
      $password = $this->input->post('password');
      $status = $this->input->post('status');
      $role_id = $this->input->post('role_id');

      if ($password != '') {
        $data = array(
          'email' => $email,
          'name' => $name,
          'username' => $username,
          'password' => md5($password),
          'phone' => $phone,
          'status' => $status,
          'role_id' => $role_id,
          'updated_at' => date("Y-m-d H:i:s", time()),
        );
      } else {
        $data = array(
          'email' => $email,
          'name' => $name,
          'username' => $username,
          'phone' => $phone,
          'status' => $status,
          'role_id' => $role_id,
          'updated_at' => date("Y-m-d H:i:s", time()),
        );
      }
      $this->member_model->update($user_info->id, $data);
      insertLog('Sửa thông tin thành viên' . $user_info->id);
      $this->session->set_flashdata('success', 'Cập nhật thành công!.');
      return redirect(admin_url('member'));
    }

    $this->data['user_info'] = $user_info;
    $this->data['title'] = 'Sửa thành viên';
    $this->data['temp'] = 'admin/member/update';
    $this->load->view('admin/main', $this->data);
  }

  function remove()
  {
    $id = $this->input->post('id');
    $info = $this->member_model->getData($id);
    if (!$info) {
      $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Tài khoản không tồn tại.'
      ]);
    } else {
      $data = array(
        'status' => 0,
        'deleted_at' => date("Y-m-d H:i:s", time()),
      );
      insertLog('Xoá thành viên' . $id);
      $this->member_model->update($id, $data);
      $data = json_encode([
        'status'    => 'success',
        'msg'       => 'Xoá tài khoản người dùng thành công.'
      ]);
    }
    return ($data);
  }
}
