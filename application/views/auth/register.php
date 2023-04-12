<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng ký tài khoản</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>/css/adminlte.min.css">
  <style>
    b.h4 {
      color: #000;
      font-weight: 400;
      font-size: 19px;
      line-height: 1.8;
    }
  </style>
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="/">
          <img src="<?= getSettingByName('logo') ?>" al="Logo" class=""><br>
          <b class="h4">Đăng Ký</b>
        </a>
      </div>
      <div class="card-body">
        <?php $this->load->view('message', $this->data); ?>

        <form action="" method="post">
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            <input type="text" class="form-control <?= (form_error('name')) ? 'is-invalid' : '' ?>" value="<?= set_value('name') ?>" placeholder="Họ tên" name="name">
          </div>
          <?= (form_error('name')) ? form_error('name', "<p style='color:red'>", "</p>") : '' ?>

          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <input type="email" class="form-control <?= (form_error('email')) ? 'is-invalid' : '' ?>" value="<?= set_value('email') ?>" placeholder="Email" name="email">
          </div>
          <?= (form_error('email')) ? form_error('email', "<p style='color:red'>", "</p>") : '' ?>

          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
            <input type="text" class="form-control <?= (form_error('phone')) ? 'is-invalid' : '' ?>" value="<?= set_value('phone') ?>" placeholder="Số điện thoại" name="phone">
          </div>
          <?= (form_error('phone')) ? form_error('phone', "<p style='color:red'>", "</p>") : '' ?>

          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <input type="password" class="form-control <?= (form_error('password')) ? 'is-invalid' : '' ?>" value="<?= set_value('password') ?>" placeholder="Password" name="password">
          </div>
          <?= (form_error('password')) ? form_error('password', "<p style='color:red'>", "</p>") : '' ?>

          <div class="row">
            <div class="col-12 mb-3">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="1">
                <label for="agreeTerms">
                  Đồng ý <a href="#">điều khoản dịch vụ</a> của chúng tối
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12 mb-3">
              <button type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
            </div>
            <!-- /.col -->

          </div>
        </form>

        <a href="<?= base_url('auth/login') ?>" class="text-center">Đăng nhập nếu có tài khoản?</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="<?php echo public_url('admin/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo public_url('admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo public_url('admin/') ?>js/adminlte.min.js"></script>
</body>

</html>