<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng nhập</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Đăng Nhập</b></a>
      </div>
      <div class="card-body">
        <?php $this->load->view('message', $this->data); ?>

        <form action="" method="post">
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <input type="email" class="form-control <?= (form_error('email')) ? 'is-invalid' : '' ?>" value="<?= set_value('email') ?>" name="email" placeholder="Email">
          </div>
          <?= (form_error('email')) ? form_error('email', "<p style='color:red'>", "</p>") : '' ?>

          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <input type="password" class="form-control <?= (form_error('password')) ? 'is-invalid' : '' ?>" value="<?= set_value('password') ?>" name="password" placeholder="Password">
          </div>
          <?= (form_error('password')) ? form_error('password', "<p style='color:red'>", "</p>") : '' ?>

          <div class="row">
            <div class="col-12">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Lưu ID
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <a href="<?= base_url('auth/register') ?>" class="btn btn-warning btn-block text-white">Đăng ký</a>
            </div>
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p> -->
        <hr>
        <p class="m-2">
          <?= getSettingByName('note_before_login') ?>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo public_url('admin/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo public_url('admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo public_url('admin/') ?>/js/adminlte.min.js"></script>
</body>

</html>