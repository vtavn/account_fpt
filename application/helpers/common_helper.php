<?php

function create_slug($string)
{
  $search = array(
    '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
    '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
    '#(ì|í|ị|ỉ|ĩ)#',
    '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
    '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
    '#(ỳ|ý|ỵ|ỷ|ỹ)#',
    '#(đ)#',
    '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
    '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
    '#(Ì|Í|Ị|Ỉ|Ĩ)#',
    '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
    '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
    '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
    '#(Đ)#',
    "/[^a-zA-Z0-9\-\_]/",
  );
  $replace = array(
    'a',
    'e',
    'i',
    'o',
    'u',
    'y',
    'd',
    'A',
    'E',
    'I',
    'O',
    'U',
    'Y',
    'D',
    '-',
  );
  $string = preg_replace($search, $replace, $string);
  $string = preg_replace('/(-)+/', '-', $string);
  $string = strtolower($string);
  return $string;
}

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

function client_url($text)
{
  return base_url(create_slug($text)) . '-';
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

function insertLog($text, $uid = '0')
{
  $CI = &get_instance();
  $CI->load->model('log_model');
  $user_id = $CI->session->userdata('uid') ? $CI->session->userdata('uid') : $uid;

  $data = array(
    'member_id' => $user_id,
    'ip' => getIp(),
    'device' => '',
    'action' => $text
  );

  $CI->log_model->create($data);
}

function showCategories($categories, $checked, $edit_id = 0)
{
  $categoryMap = [];
  foreach ($categories as $category) {
    $categoryMap[$category->id] = $category;
    $categoryMap[$category->id]->children = [];
  }

  foreach ($categoryMap as $category) {
    if ($category->id == $edit_id) {
      continue;
    }
    if (isset($categoryMap[$category->parent_id])) {
      $categoryMap[$category->parent_id]->children[] = $category;
    } else {
      $tree[] = $category;
    }
  }

  function buildOption($category, $char, $checked)
  {
    $selected = ($category->id == $checked) ? 'selected' : '';
    echo '<option value="' . $category->id . '" ' . $selected . '>';
    echo $char . $category->name;
    echo '</option>';
  }

  function traverseTree($tree, $char, $checked)
  {
    foreach ($tree as $category) {
      buildOption($category, $char, $checked);
      if (!empty($category->children)) {
        traverseTree($category->children, $char . '|---', $checked);
      }
    }
  }

  traverseTree($tree, '', $checked);
}

function showCategoriesInTable($categories, $parent_id = 0, $char = '')
{
  foreach ($categories as $key => $item) {
    if ($item->parent_id == $parent_id) {
      echo '<tr>';
      echo '<td>';
      echo '<a href="' . base_url($item->link) . '">' . $char . $item->name . '</a>';
      echo '</td>';
      echo '<td>
      <a aria-label="" href="' . admin_url('menu/update/') . $item->id . '" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
        <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
      </a>
      <button style="color:white;" onclick="RemoveMenu(' . $item->id . ',\'' . $item->name . '\')" class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
        <i class="fas fa-trash mr-1"></i><span class="">Delete</span>
      </button>
    </td>';
      echo '</tr>';
      unset($categories[$key]);
      showCategoriesInTable($categories, $item->id, $char . '|---');
    }
  }
}

function showMenuClient($categories, $parent_id = 0, $char = '')
{
  $cate_child = array();
  foreach ($categories as $key => $item) {
    if ($item->parent_id == $parent_id) {
      $cate_child[] = $item;
      unset($categories[$key]);
    }
  }

  if ($cate_child) {
    foreach ($cate_child as $key => $item) {
      $has_child = false;
      foreach ($categories as $category) {
        if ($category->parent_id == $item->id) {
          $has_child = true;
          break;
        }
      }
      if ($has_child) {
        echo '<li class="nav-item dropdown dropdown-hover">
                <a id="'  . $item->id . '" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">'  . $item->name . '</a>
                <ul aria-labelledby="'  . $item->id . '" class="dropdown-menu border-0 shadow">';
      } else {
        if ($char) {
          echo '<li><a href="' . $item->link . '" class="dropdown-item">'  . $item->name . '</a></li>';
        } else {
          echo '<li class="nav-item"><a href="' . $item->link . '" class="nav-link">'  . $item->name . '</a></li>';
        }
      }
      showMenuClient($categories, $item->id, $char . 'xxx');
      if ($has_child) {
        echo '</ul></li>';
      }
    }
  }
}

function random($string, $int)
{
  return substr(str_shuffle($string), 0, $int);
}

function createToken()
{
  return md5(random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 6) . time());
}


function display_invoice($status)
{
  if ($status == 'waiting') {
    return '<span class="badge bg-warning">Waiting</span>';
  } elseif ($status == 'expired') {
    return '<span class="badge bg-danger">Expired</span>';
  } else if ($status == 'completed') {
    return '<span class="badge bg-success">Completed</span>';
  } else if ($status == 0) {
    return '<p class="mb-0 text-warning font-weight-bold d-flex justify-content-start align-items-center">' . 'Đang chờ thanh toán' . '</p>';
  } else if ($status == 1) {
    return '<p class="mb-0 text-success font-weight-bold d-flex justify-content-start align-items-center">' . 'Đã thanh toán' . '</p>';
  } else if ($status == 2) {
    return '<p class="mb-0 text-danger font-weight-bold d-flex justify-content-start align-items-center">' . 'Huỷ bỏ' . '</p>';
  } else {
    return '<b style="color:yellow;">Khác</b>';
  }
}

function getTotalPaymentById($id)
{
  $CI = &get_instance();
  $CI->load->model('invoice_model');
  $where = array('member_id' => $id);
  $total = $CI->invoice_model->getSum('pay', $where);
  return $total;
}


function getTotalAccountById($id, $type)
{
  $CI = &get_instance();
  $CI->load->model('account_model');

  $where = "";
  if ($type == 'seller') {
    $where = "seller_id = $id AND status = 1";
  } else if ($type == 'buyer') {
    $where = "buyer_id = $id AND status = 1";
  } else if ($type == 'sell_done') {
    $where = "seller_id = $id AND status = 2";
  }

  $sql = "SELECT COUNT(id) as total FROM accounts WHERE " . $where;
  $total = $CI->account_model->query($sql);

  return $total[0]->total;
}

function getTotalAccountByPackage($id, $status = '1')
{
  $CI = &get_instance();
  $CI->load->model('account_model');

  $where = "package_id = $id AND status = $status";

  $sql = "SELECT COUNT(id) as total FROM accounts WHERE " . $where;
  $total = $CI->account_model->query($sql);

  return $total[0]->total;
}
