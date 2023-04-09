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
    if (is_login()) {
      redirect(base_url('/'));
    }
    if ($this->input->post()) {
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Mật khẩu', 'required');

      if ($this->form_validation->run()) {
        $user = $this->getUserInfo();
        $remoteip = getIp();

        if ($user) {
          if ($user->status != 0) {
            $genToken = createToken();
            $this->session->set_userdata('uid', $user->id);
            $this->session->set_userdata('urole', $user->role_id);
            $this->session->set_userdata('token', $genToken);

            //save ip login
            $iplist = $user->ip_login;
            if ($iplist) {
              $iplist .= ',' . $remoteip;
            } else {
              $iplist .= $remoteip;
            }
            $data = array(
              'token' => $genToken,
              'ip_login' => $iplist,
              'updated_at' => date("Y-m-d H:i:s", time()),
            );
            insertLog('Đăng nhập website tại địa chỉa ip: ' . $remoteip, $user->id);
            $this->member_model->update($user->id, $data);

            redirect(base_url('/'));
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
    if (is_login()) {
      redirect(base_url('/'));
    }
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
          'money' => 0,
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
    if (!is_login()) {
      redirect(base_url('auth/login'));
    }
    $this->session->unset_userdata('uid');
    $this->session->unset_userdata('urole');
    $this->session->sess_destroy();
    return redirect(base_url('/'));
  }

  function profile()
  {
    if (!is_login()) {
      redirect(base_url('auth/login'));
    }

    $this->data['title'] = 'Trang cá nhân';
    $this->data['temp'] = 'auth/profile';
    $this->load->view('client/main', $this->data);
  }

  function changeinfo()
  {
    if (!is_login()) {
      redirect(base_url('/'));
    }

    if ($this->input->post()) {
      $this->form_validation->set_rules('email', 'Email', 'required');

      if ($this->form_validation->run()) {
        $email = $this->input->post('email');
        $where = array('email' => $email);
        $user = $this->member_model->get_info_rule($where);

        $username = $this->input->post('username');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $changePassword = $this->input->post('changePassword');

        $remoteip = getIp();
        if ($user) {
          if ($changePassword == 1) {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('phone');
            $fPass = array('email' => $email, 'password' => md5($oldPassword));
            $checkPass = $this->member_model->get_info_rule($fPass);

            if ($checkPass) {
              $data = array(
                'username' => $username,
                'name' => $name,
                'phone' => $phone,
                'password' => md5($newPassword),
                'updated_at' => date("Y-m-d H:i:s", time()),
              );
              insertLog('[WARN] Đổi thông tin tài khoản & mật khẩu : ' . $remoteip, $user->id);
              $this->member_model->update($user->id, $data);
            } else {
              $this->session->set_flashdata('error', 'Mật khẩu hiện tại không đúng.');
            }
          } else {
            $data = array(
              'username' => $username,
              'name' => $name,
              'phone' => $phone,
              'updated_at' => date("Y-m-d H:i:s", time()),
            );
            insertLog('[WARN] Đổi thông tin tài khoản : ' . $remoteip, $user->id);
            $this->member_model->update($user->id, $data);
            $this->session->set_flashdata('success', 'Thay đổi thông tin cá nhân thành công.');
          }
          redirect(base_url('auth/profile'));
        } else {
          $this->session->set_flashdata('error', 'Vui lòng kiểm tra lại hoặc liên hệ với admin.');
        }
        redirect(base_url('auth/profile'));
      }
    }
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
