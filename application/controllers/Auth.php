<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('member_model');
  }

  public function login()
  {
    var_dump($this->session->userdata('uid'));
    var_dump($this->session->userdata('username'));
    if ($this->input->post()) {
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Mật khẩu', 'required');

      if ($this->form_validation->run()) {
        $user = $this->getUserInfo();
        $remoteip = getIp();

        if ($user) {
          if ($user->status != 0) {
            $this->session->set_userdata('uid', $user->id);
            $this->session->set_userdata('username', $user->username);
            $this->session->set_userdata('uemail', $user->email);
            $this->session->set_userdata('urole', $user->role_id);

            //save ip login
            $iplist = $user->ip_login;
            if ($iplist) {
              $iplist .= ',' . $remoteip;
            } else {
              $iplist .= $remoteip;
            }
            $data = array(
              'ip_login' => $iplist,
            );
            $this->member_model->update($user->id, $data);
            redirect(base_url('index'));
          } else {
            $this->session->set_flashdata('error', 'Tài khoản của bạn đã bị khoá.Vui lòng liên hệ admin để được hỗ trợ.');
          }
        } else {
          $this->session->set_flashdata('error', 'Vui lòng kiểm tra lại tài khoản.');
        }
      }
    }

    $this->load->view('auth/login');
  }

  public function register()
  {
    if ($this->input->post()) {
      $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email');
      $this->form_validation->set_rules('name', 'Họ Tên', 'required');
      $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
      $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
      // $this->form_validation->set_rules('terms', 'Đồng ý điều khoản', 'required');

      if ($this->form_validation->run()) {
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');

        $data = array(
          'email' => $email,
          'password' => md5($password),
          'name' => $name,
          'phone' => $phone,
          'username' => createUsername($email),
          'price' => 0,
          'role_id' => 1, //member role
          'status' => 1, //1 active, 0 ban
        );

        if ($this->member_model->create($data)) {
          $this->session->set_flashdata('success', 'Tạo tài khoản thành công. Bây giờ bạn có thể đăng nhập!');
        } else {
          $this->session->set_flashdata('error', 'Tạo tài khoản thất bại vui lòng liên hệ admin để hỗ trợ.');
        }

        redirect(base_url('auth/register'));
      }
    }
    $this->load->view('auth/register');
  }

  function logout()
  {
    $this->session->unset_userdata('uid');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('uemail');
    $this->session->unset_userdata('urole');
    $this->session->sess_destroy();
    return redirect('index');
  }

  function check_email()
  {
    $email = $this->input->post('email');
    $where = array('email' => $email);
    if ($this->member_model->check_exists($where)) {
      $this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại, vui lòng điền email khác.');
      return false;
    }
    return true;
  }

  private function getUserInfo()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $password = md5($password);
    $where = array('email' => $email, 'password' => $password);
    $user = $this->member_model->get_info_rule($where);
    return $user;
  }
}
