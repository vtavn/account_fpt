<?php

function public_url($url = '')
{
  return base_url('public/assets/' . $url);
}

function admin_url($url = '')
{
  return base_url('admin/' . $url);
}

function createUsername($email)
{
  return strtolower(explode('@', $email)[0]);
}

function getIp()
{
  static $realip = NULL;
  if ($realip !== NULL) {
    return $realip;
  }
  if (isset($_SERVER)) {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
      foreach ($arr as $ip) {
        $ip = trim($ip);
        if ($ip != 'unknown') {
          $realip = $ip;
          break;
        }
      }
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
      $realip = $_SERVER['HTTP_CLIENT_IP'];
    } else {
      if (isset($_SERVER['REMOTE_ADDR'])) {
        $realip = $_SERVER['REMOTE_ADDR'];
      } else {
        $realip = '0.0.0.0';
      }
    }
  } else {
    if (getenv('HTTP_X_FORWARDED_FOR')) {
      $realip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('HTTP_CLIENT_IP')) {
      $realip = getenv('HTTP_CLIENT_IP');
    } else {
      $realip = getenv('REMOTE_ADDR');
    }
  }
  preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
  $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
  return $realip;
}

function is_login()
{
  $CI = &get_instance();
  $user_id = $CI->session->userdata('uid');
  return isset($user_id);
}

function is_admin()
{
  $CI = &get_instance();

  $user_id = $CI->session->userdata('uid');
  $is_admin = $CI->db->get_where('members', array('id' => $user_id, 'role_id' => 3))->num_rows();
  return ($is_admin == 1);
}

function display_role($role, $id)
{
  if ($role == $id) {
    $show = '<span class="badge badge-success">Có</span>';
  } else {
    $show = '<span class="badge badge-danger">Không</span>';
  }
  return $show;
}

function display_banned($banned)
{
  if ($banned == 1) {
    return '<span class="badge badge-success">Active</span>';
  } else {
    return '<span class="badge badge-danger">Banned</span>';
  }
}

function display_time($time)
{
  return date('H:i:s d/m/Y', strtotime($time));
}

function display_last_ip($listIp)
{
  $array = explode(',', $listIp);
  $last_ip = end($array);
  return $last_ip;
}
