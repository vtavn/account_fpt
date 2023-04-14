<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('blog_model');
    $this->load->model('member_model');
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
    $this->data['temp'] = 'client/pages/blog/index';
    $this->load->view('client/main', $this->data);
  }

  function detail()
  {
    $id = $this->uri->rsegment('4');
    $where = array('id' => $id);
    $post_info = $this->blog_model->get_info_rule($where);
    if (!$post_info) {
      return redirect(base_url(''));
    }

    $this->data['post_info'] = $post_info;
    $this->data['title'] = $post_info->title;
    $this->data['temp'] = 'client/pages/blog/detail';
    $this->load->view('client/main', $this->data);
  }
}
