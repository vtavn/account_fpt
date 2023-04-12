<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends MY_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->load->model('package_model');
    $this->load->model('account_model');

    $packS['where'] = array('deleted_at' => null);
    $allPackage = $this->package_model->getList($packS);
    $this->data['all_packages'] = $allPackage;

    if (!is_ctv()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $id_user = $this->session->userdata('uid');

    //search 
    $accountS = $this->input->get('account');
    $packageS = $this->input->get('package_id');
    $statusS = $this->input->get('status');

    $where = "WHERE id like '%'";

    if ($accountS) {
      $where .= " AND account LIKE '%" . $accountS . "%'";
    }
    if ($packageS) {
      $where .= " AND package_id = '" . $packageS . "'";
    }

    if ($statusS) {
      $where .= " AND status = '" . $statusS . "'";
    }

    //default
    $where .= " AND status != 3 AND seller_id = '" . $id_user . "'";

    $sql_2 = 'SELECT count(id) as total from accounts ' . $where;
    $total_rows = $this->account_model->query($sql_2);
    $this->data['total_rows'] = $total_rows[0]->total;

    $config = array();
    $config['total_rows'] = $total_rows[0]->total;
    $config['base_url'] = ctv_url('account/index');
    $config['per_page'] = 15;
    $config['reuse_query_string'] = true;
    $config['uri_segment'] = 4;
    $this->pagination->initialize($config);
    $segment = $this->uri->segment(4);
    $segment = intval($segment);
    $limit = 'LIMIT ' . $segment . ', ' . $config['per_page'];
    $sql = 'SELECT * FROM accounts ' . $where . ' ORDER BY id DESC ' . $limit;
    $data = $this->account_model->query($sql);
    $this->data['data'] = $data;
    $pagination = $this->pagination->create_links();
    $this->data['pagination'] = $pagination;
    // end pagination
    $this->data['title'] = 'Danh sách tài khoản';
    $this->data['temp'] = 'ctv/account/index';
    $this->load->view('ctv/main', $this->data);
  }

  // function update()
  // {
  //   $id = $this->uri->rsegment('3');

  //   $where = array('id' => $id);
  //   $account_info = $this->account_model->get_info_rule($where);
  //   if (!$account_info) {
  //     return redirect(ctv_url('account/index'));
  //   }

  //   if ($this->input->post()) {
  //     $this->form_validation->set_rules('package_id', 'Gói cần được phải chọn.', 'required');
  //     if ($this->form_validation->run()) {
  //       $package_id = $this->input->post('package_id');
  //       $name = $this->input->post('name');
  //       $price = $this->input->post('price');
  //       $sale_price = $this->input->post('sale_price');
  //       $status = $this->input->post('status');
  //       $account = $this->input->post('account');

  //       $data = array(
  //         'name' => $name,
  //         'price' => $price,
  //         'sale_price' => $sale_price,
  //         'package_id' => $package_id,
  //         'account' => $account,
  //         'status' => $status,
  //         'updated_at' => date("Y-m-d H:i:s", time())
  //       );
  //       insertLog('Cập nhật tài khoản id: ' . $account_info->id);
  //       $this->account_model->update($account_info->id, $data);
  //       $this->session->set_flashdata('success', 'Cập nhật thành công!.');
  //       return redirect(ctv_url('account'));
  //     }
  //   }

  //   $this->data['account_info'] = $account_info;
  //   $this->data['title'] = 'Sửa tài khoản: ' . $account_info->id;
  //   $this->data['temp'] = 'admin/account/update';
  //   $this->load->view('admin/main', $this->data);
  // }

  // function remove()
  // {
  //   $id = $this->input->post('id');
  //   $info = $this->account_model->getData($id);
  //   if (!$info) {
  //     $data = json_encode([
  //       'status'    => 'error',
  //       'msg'       => 'Tài khoản không tồn tại.'
  //     ]);
  //   } else {
  //     $data = array(
  //       'status' => 3,
  //       'deleted_at' => date("Y-m-d H:i:s", time()),
  //     );
  //     insertLog('Xoá tài khoản id: ' . $id);
  //     $this->account_model->update($id, $data);
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

      $this->form_validation->set_rules('package_id', 'Gói cần được phải chọn.', 'required');

      if ($this->form_validation->run()) {
        $package_id = $this->input->post('package_id');
        $name = $this->input->post('name');
        $price = empty($this->input->post('price')) ? 0 : $this->input->post('price');
        $sale_price = empty($this->input->post('sale_price')) ? 0 : $this->input->post('sale_price');
        $seller_id = $this->session->userdata('uid');
        $duration = $this->input->post('duration');

        $account = check_string($this->input->post('account'));
        $accounts = explode(PHP_EOL, $account);

        foreach ($accounts as $account) {
          $data = array(
            'name' => $name,
            'price' => $price,
            'sale_price' => $sale_price,
            'package_id' => $package_id,
            'seller_id' => $seller_id,
            'account' => $account,
            'status' => 4,
            'ctv' => 1,
            'duration' => $duration
          );

          if ($this->account_model->create($data)) {
            insertLog('Thêm tài khoản thành công. Package: ' . $package_id);
            $this->session->set_flashdata('success', 'Thêm tài khoản thành công.');
          } else {
            $this->session->set_flashdata('error', 'Tạo tài khoản thất bại vui lòng liên hệ để được hỗ trợ.');
          }
        }

        redirect(ctv_url('account/create'));
      }
    }

    $this->data['title'] = 'Thêm tài khoản';
    $this->data['temp'] = 'ctv/account/create';
    $this->load->view('ctv/main', $this->data);
  }
}
