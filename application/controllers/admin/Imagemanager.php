<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Imagemanager extends MY_Controller
{

  function __construct()
  {
    parent::__construct();

    if (!is_admin()) {
      return redirect(base_url('/'));
    }
  }

  function index()
  {
    $this->data['title'] = 'Upload Ảnh';
    $this->data['temp'] = 'admin/uploadForm/img';
    $this->load->view('admin/main', $this->data);
  }

  function upload_file()
  {

    $config['upload_path'] =  './public/uploads/';
    $config['allowed_types'] = '*';
    $config['max_filename'] = '255';
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = '2048'; //1 MB

    if (isset($_FILES['file']['name'])) {
      if (0 < $_FILES['file']['error']) {
        echo 'Error during file upload' . $_FILES['file']['error'];
      } else {
        $config['file_name'] = 'new_filename'; // set the new file name here

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
          echo $this->upload->display_errors();
        } else {
          echo base_url() . 'public/uploads/' . $this->upload->data('file_name');
        }
      }
    } else {
      echo 'Please choose a file';
    }
  }
}
