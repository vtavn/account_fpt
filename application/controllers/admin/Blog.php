<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('blog_model');
    $this->load->model('member_model');
    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $where = "WHERE id like '%'";

    $where .= " AND status != 2 AND deleted_at IS NULL";

    $sql_2 = 'SELECT count(id) as total from blog_posts ' . $where;
    $total_rows = $this->blog_model->query($sql_2);
    $this->data['total_rows'] = $total_rows[0]->total;

    $config = array();
    $config['total_rows'] = $total_rows[0]->total;
    $config['base_url'] = admin_url('account/index');
    $config['per_page'] = 15;
    $config['reuse_query_string'] = true;
    $config['uri_segment'] = 4;
    $this->pagination->initialize($config);
    $segment = $this->uri->segment(4);
    $segment = intval($segment);
    $limit = 'LIMIT ' . $segment . ', ' . $config['per_page'];
    $sql = 'SELECT * FROM blog_posts ' . $where . ' ORDER BY id DESC ' . $limit;
    $data = $this->blog_model->query($sql);
    $this->data['data'] = $data;
    $pagination = $this->pagination->create_links();
    $this->data['pagination'] = $pagination;
    // end pagination

    $this->data['title'] = 'Danh sách bài viết';
    $this->data['temp'] = 'admin/blog/index';
    $this->load->view('admin/main', $this->data);
  }

  function create()
  {
    if ($this->input->post()) {

      $this->form_validation->set_rules('title', 'Tiêu đề cần phải có.', 'required');

      if ($this->form_validation->run()) {
        $title = $this->input->post('title');
        $thumb = $this->input->post('thumb');
        $content = $this->input->post('content');
        $member_id = $this->session->userdata('uid');
        $status = $this->input->post('status');

        $data = array(
          'title' => $title,
          'thumb' => $thumb,
          'content' => $content,
          'member_id' => $member_id,
          'status' => $status,
        );

        if ($this->blog_model->create($data)) {
          insertLog('Thêm bài viết mới: ' . $title);
          $this->session->set_flashdata('success', 'Thêm bài viết mới thành công.');
        } else {
          $this->session->set_flashdata('error', 'Thêm bài viết mới thất bại vui lòng liên hệ để được hỗ trợ.');
        }

        redirect(admin_url('blog/create'));
      }
    }

    $this->data['title'] = 'Tạo bài viết mới';
    $this->data['temp'] = 'admin/blog/create';
    $this->load->view('admin/main', $this->data);
  }

  function update()
  {
    $id = $this->uri->rsegment('3');
    $where = array('id' => $id);
    $post_info = $this->blog_model->get_info_rule($where);
    if (!$post_info) {
      return redirect(admin_url('blog/index'));
    }


    if ($this->input->post()) {

      $this->form_validation->set_rules('title', 'Tiêu đề cần phải có.', 'required');

      if ($this->form_validation->run()) {
        $title = $this->input->post('title');
        $thumb = $this->input->post('thumb');
        $content = $this->input->post('content');
        $member_id = $this->session->userdata('uid');
        $status = $this->input->post('status');

        $data = array(
          'title' => $title,
          'thumb' => $thumb,
          'content' => $content,
          'member_id' => $member_id,
          'status' => $status,
        );

        if ($this->blog_model->update($post_info->id, $data)) {
          insertLog('Sửa bài viết: ' . $post_info->id . ' - ' . $title);
          $this->session->set_flashdata('success', 'Sửa bài viết thành công.');
        } else {
          $this->session->set_flashdata('error', 'Sửa bài viết thất bại vui lòng liên hệ để được hỗ trợ.');
        }

        redirect(admin_url('blog'));
      }
    }

    $this->data['post_info'] = $post_info;
    $this->data['title'] = 'Sửa bài viết: ' . $post_info->id;
    $this->data['temp'] = 'admin/blog/update';
    $this->load->view('admin/main', $this->data);
  }

  function remove()
  {
    $id = $this->input->post('id');
    $info = $this->blog_model->getData($id);
    if (!$info) {
      $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Bài viết không tồn tại.'
      ]);
    } else {
      $data = array(
        'status' => 2,
        'deleted_at' => date("Y-m-d H:i:s", time()),
      );
      insertLog('Xoá bài viết id: ' . $info->title);
      $this->blog_model->update($id, $data);
      $data = json_encode([
        'status'    => 'success',
        'msg'       => 'Xoá bài viết thành công.'
      ]);
    }
    die($data);
  }
}
