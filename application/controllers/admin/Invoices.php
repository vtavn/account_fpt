<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoices extends MY_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->load->model('invoice_model');
    $this->load->model('account_model');
    $this->load->model('member_model');

    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $this->data['listBankDefault'] = $this->config->item('config_listbank');

    //search 
    $member_id = $this->input->get('member_id');
    $trans_id = $this->input->get('trans_id');
    $payment_method = $this->input->get('payment_method');
    $status = $this->input->get('status');

    $where = "WHERE id like '%'";

    if ($member_id) {
      $where .= " AND member_id LIKE '%" . $member_id . "%'";
    }

    if ($trans_id) {
      $where .= " AND trans_id = '" . $trans_id . "'";
    }
    if ($payment_method) {
      $where .= " AND payment_method = '" . $payment_method . "'";
    }

    if ($status) {
      $where .= " AND status = '" . $status . "'";
    }

    $where .= " AND deleted_at IS NULL";

    $sql_2 = 'SELECT count(id) as total from invoices ' . $where;
    $total_rows = $this->invoice_model->query($sql_2);
    $this->data['total_rows'] = $total_rows[0]->total;

    $config = array();
    $config['total_rows'] = $total_rows[0]->total;
    $config['base_url'] = admin_url('invoices/index');
    $config['per_page'] = 15;
    $config['reuse_query_string'] = true;
    $config['uri_segment'] = 4;
    $this->pagination->initialize($config);
    $segment = $this->uri->segment(4);
    $segment = intval($segment);
    $limit = 'LIMIT ' . $segment . ', ' . $config['per_page'];
    $sql = 'SELECT * FROM invoices ' . $where . ' ORDER BY id DESC ' . $limit;
    $data = $this->invoice_model->query($sql);
    $this->data['data'] = $data;
    $pagination = $this->pagination->create_links();
    $this->data['pagination'] = $pagination;
    // end pagination
    $this->data['title'] = 'Danh sách hoá đơn';
    $this->data['temp'] = 'admin/invoices/index';
    $this->load->view('admin/main', $this->data);
  }

  function remove()
  {
    $id = $this->input->post('id');
    $info = $this->invoice_model->getData($id);
    if (!$info) {
      $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Hoá đơn không tồn tại.'
      ]);
    } else {
      $data = array(
        'status' => 2,
        'deleted_at' => date("Y-m-d H:i:s", time()),
      );
      insertLog('Xoá hoá đơn : ' . $id . ' Trans Id: ' . $info->trans_id);
      $this->invoice_model->update($id, $data);
      $data = json_encode([
        'status'    => 'success',
        'msg'       => 'Xoá hoá đơn thành công.'
      ]);
    }
    die($data);
  }

  function update()
  {
    $id = $this->uri->rsegment('3');

    $where = array('id' => $id);
    $invoice_info = $this->invoice_model->get_info_rule($where);
    if (!$invoice_info) {
      return redirect(admin_url('invoices'));
    }

    if ($this->input->post()) {

      $pay = $this->input->post('pay');
      $status = $this->input->post('status');

      $data = array(
        'pay' => $pay,
        'status' => $status,
      );

      if ($status == 1) {
        $this->member_model->addMoney("members", "money", $pay, $invoice_info->member_id);
      }

      $this->invoice_model->update($invoice_info->id, $data);

      insertLog('Sửa hoá đơn #' . $invoice_info->trans_id);
      $this->session->set_flashdata('success', 'Cập nhật thành công!.');
      return redirect(admin_url('invoices'));
    }

    $this->data['invoice_info'] = $invoice_info;
    $this->data['title'] = 'Sửa hoá đơn : ' . $invoice_info->trans_id;
    $this->data['temp'] = 'admin/invoices/update';
    $this->load->view('admin/main', $this->data);
  }
}
