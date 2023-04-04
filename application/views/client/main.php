<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?></title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo public_url('client/') ?>css/style.css">
  <link rel="stylesheet" href="<?php echo public_url('client/plugins/') ?>owlcarousel/owl.carousel.min.css">
  <!-- <link rel="stylesheet" href="<?php echo public_url('client/plugins/') ?>owlcarousel/owl.theme.default.min.css"> -->
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <?php $this->load->view('client/partials/header'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <div class="content p-0">
        <?php $this->load->view($temp, $this->data); ?>
      </div>
      <!-- /.content-wrapper -->

      <?php $this->load->view('client/partials/footer'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?php echo public_url('admin/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo public_url('admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo public_url('admin/') ?>js/adminlte.min.js"></script>
    <script src="<?php echo public_url('client/plugins/') ?>owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php echo public_url('client/js/') ?>owl.js"></script>
</body>

</html>