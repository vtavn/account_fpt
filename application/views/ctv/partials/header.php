<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?> - CTV</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>css/custom.css">
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/cute-alert/style.css">
  <!-- jQuery -->
  <script src="<?php echo public_url('admin/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo public_url('admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- CuteAleart -->
  <script src="<?php echo public_url('admin/') ?>plugins/cute-alert/cute-alert.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo public_url('admin/') ?>js/adminlte.min.js"></script>

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <script src="<?php echo public_url('admin/') ?>plugins/select2/js/select2.full.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('/') ?>" class="nav-link">Trang người dùng</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Hỗ Trợ Support</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Số tiền kiếm được: <b><?= number_format($my_info->money_ctv) ?>đ</b></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Phí sàn: <b><?= getSettingMoneyByKey('pecent_sell') ?>%</b></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->