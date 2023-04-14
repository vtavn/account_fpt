<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?> - FPL.VN</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo public_url('client/') ?>css/style.css?v=1.0.10">
  <link rel="stylesheet" href="<?php echo public_url('client/plugins/') ?>owlcarousel/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo public_url('admin/plugins/') ?>sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/cute-alert/style.css">
  <!-- jQuery -->
  <script src="<?php echo public_url('admin/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo public_url('admin/') ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- CuteAleart -->
  <script src="<?php echo public_url('admin/') ?>plugins/cute-alert/cute-alert.js"></script>
  <link rel="icon" href="<?= getSettingByName('favicon') ?>">

  <link href="https://fpt.vn/assets/frontend/smart_banner/smartbanner.css" rel="stylesheet">
  <!--******** // CAI DAT APP HI FPT _ DoanVH  *****-->
  <!--****** các thẻ meta cần thiết để chạy CAI DAT APP HI FPT _ DVH ******-->
  <meta name="smartbanner:title" content="">
  <meta name="smartbanner:author" content="">
  <meta name="smartbanner:price" content="">
  <meta name="smartbanner:price-suffix-apple" content="">
  <meta name="smartbanner:price-suffix-google" content="">
  <meta name="smartbanner:icon-apple" content="">
  <meta name="smartbanner:icon-google" content="">
  <meta name="smartbanner:button" content="">
  <meta name="smartbanner:rating-Itunes" content="">
  <meta name="smartbanner:rating-Google" content="">
  <meta name="smartbanner:button-url-apple" content="">
  <meta name="smartbanner:button-url-google" content="">
  <meta name="smartbanner:enabled-platforms" content="android,ios">
  <!--****** các thẻ meta cần thiết để chạy CAI DAT APP HI FPT _ DVH ******-->
  <!--******** css AND js CAI DAT APP HI FPT _ DVH ********-->
  <script src="https://fpt.vn/assets/frontend/smart_banner/smartbanner.js" type="text/javascript"></script>
  <script src="https://fpt.vn/assets/frontend/smart_banner/data_smartbanner.js" type="text/javascript"></script>
  <script src="https://fpt.vn/assets/frontend/smart_banner/carousel-banner.js" type="text/javascript"></script>
  <script src="https://fpt.vn/assets/frontend/js/nav.js" type="text/javascript"></script>
  <!--******** // css AND js CAI DAT APP HI FPT _ DVH  *****-->

</head>

<body class="hold-transition layout-top-nav dark-mode">
  <div class="wrapper">
    <?php $this->load->view('client/partials/header'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <div class="content p-0">
        <?php $this->load->view($temp, $this->data); ?>
      </div>
      <!-- /.content-wrapper -->
    </div>
  </div>
  <!-- ./wrapper -->
  <?php $this->load->view('client/partials/footer'); ?>

  <!-- jQuery -->
  <script src="<?php echo public_url('admin/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo public_url('admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo public_url('admin/') ?>js/adminlte.min.js"></script>
  <script src="<?php echo public_url('client/plugins/') ?>owlcarousel/owl.carousel.min.js"></script>
  <script src="<?php echo public_url('client/js/') ?>owl.js?v=1.0.3"></script>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-90NQ1XX58K"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-90NQ1XX58K');
  </script>
</body>

</html>