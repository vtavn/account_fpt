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

function display_status($id)
{
  if ($id == 1) {
    $show = '<span class="badge badge-success">Hiển thị</span>';
  } elseif ($id == 0) {
    $show = '<span class="badge badge-danger">Ẩn</span>';
  } else {
    $show = '<span class="badge badge-danger">Xoá</span>';
  }
  return $show;
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

function display_account($status)
{
  if ($status == 1) {
    return '<span class="badge badge-warning">Đang bán</span>';
  } elseif ($status == 2) {
    return '<span class="badge badge-success">Đã bán</span>';
  } else {
    return '<span class="badge badge-danger">Xoá</span>';
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


function check_string($data)
{
  return trim(htmlspecialchars(addslashes($data)));
}

function getNameMemberById($id)
{
  $CI = &get_instance();
  $CI->load->model('member_model');
  $where = array('id' => $id);
  $user = $CI->member_model->get_info_rule($where);
  return $user;
}

function getNamePackageById($id)
{
  $CI = &get_instance();
  $CI->load->model('package_model');
  $where = array('id' => $id);
  $package = $CI->package_model->get_info_rule($where);
  return $package;
}

function getValueinGet($key)
{
  $CI = &get_instance();
  return ($CI->input->get($key)) ? $CI->input->get($key) : '';
}

function getTotalAccountByIdPackage($id, $status = 1)
{
  $CI = &get_instance();
  $CI->load->model('account_model');
  $input['where'] = array('status = ' => $status, 'package_id' => $id);
  return $CI->account_model->getTotal($input);
}

function insertLog($text)
{
  $CI = &get_instance();
  $CI->load->model('log_model');
  $user_id = $CI->session->userdata('uid');

  $data = array(
    'member_id' => $user_id,
    'ip' => getIp(),
    'device' => '',
    'action' => $text
  );

  $CI->log_model->create($data);
}

function showCategories($categories, $parent_id = 0, $char = '')
{
  foreach ($categories as $key => $item) {
    if ($item->parent_id == $parent_id) {
      echo '<option value="' . $item->id . '">';
      echo $char . $item->name;
      echo '</option>';
      unset($categories[$key]);
      showCategories($categories, $item->id, $char . '|---');
    }
  }
}

function showCategoriesInTable($categories, $parent_id = 0, $char = '')
{
  foreach ($categories as $key => $item) {
    if ($item->parent_id == $parent_id) {
      echo '<tr>';
      echo '<td>';
      echo '<a href="' . $item->link . '">' . $char . $item->name . '</a>';
      echo '</td>';
      echo '<td>
      <a aria-label="" href="' . admin_url('menu/update/') . $item->id . '" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
        <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
      </a>
      <button style="color:white;" onclick="RemoveBanner(' . $item->id . ',\'' . $item->name . '\')" class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
        <i class="fas fa-trash mr-1"></i><span class="">Delete</span>
      </button>
    </td>';
      echo '</tr>';
      unset($categories[$key]);
      showCategoriesInTable($categories, $item->id, $char . '|---');
    }
  }
}
