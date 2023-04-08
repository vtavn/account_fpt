<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="IE=edge" />
  <title><?= $title ?></title>
  <meta name="description" content="<?= $title ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="robots" content="all,follow" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="pragma" content="no-cache" />
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="<?= public_url('client/faces'); ?>/javax.faces.resource/material/css/bootstrap.min.css" />
  <!-- Google fonts - Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700" />
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="<?= public_url('client/faces'); ?>/javax.faces.resource/material/css/style.default.css" id="theme-stylesheet" />
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?= public_url('client/faces'); ?>/javax.faces.resource/material/css/style-version=1.0.css" />
  <link rel="stylesheet" href="<?= public_url('client/faces'); ?>/javax.faces.resource/material/css/qr-code.css" />
  <link rel="stylesheet" href="<?= public_url('client/faces'); ?>/javax.faces.resource/material/css/qr-code-tablet.css" />
  <!-- Font Awesome CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Cute Alert -->
  <link rel="stylesheet" href="<?php echo public_url('admin/') ?>plugins/cute-alert/style.css">
  <script src="<?php echo public_url('admin/') ?>plugins/cute-alert/cute-alert.js"></script>
  <!-- jQuery -->
  <script src="<?php echo public_url('admin/') ?>plugins/jquery/jquery.min.js"></script>
  <style type="text/css">
    .container-fluid {
      width: 40% !important;
      min-width: 750px !important;
    }

    .info-box {
      min-height: 600px;
    }

    .entry {
      border-bottom: 1px solid #424242;
    }

    .left {
      background-color: #262626;
    }

    .receipt {
      border-bottom: 1px solid #424242
    }
  </style>
</head>

<body>
  <div class="spinner" id="spinner">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
  <div id="page" style="display: none;">
    <nav class="navbar navbar-default hidden-xs">
      <div class="container-fluid" style="padding: 1px;padding: 1px;width: 45%;min-width: 800px;">
        <div class="navbar-header" style="position: relative">
          <div class="col-xs-12 col-sm-12 col-md-12 text-right" style="padding-right: 0px;">
            <img src="<?= public_url('client/faces'); ?>/javax.faces.resource/images/hotline.svg" alt="logo-security" width="35" />
            <span><?= getSettingByName('phone') ?></span>
            <img src="<?= public_url('client/faces'); ?>/javax.faces.resource/images/email.svg" alt="logo-security" width="35" />
            <a href="mailto:<?= getSettingByName('email') ?>"><span><?= getSettingByName('email') ?></span></a>
          </div>
        </div>
      </div>

    </nav>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 left">
          <div class="info-box">
            <div class="receipt">
              <img src="<?= getSettingByName('logo') ?>" alt="Logo" width="100%" />
            </div>
            <div class="entry">
              <p><i class="fa fa-university" aria-hidden="true"></i>
                <span style="padding-left: 5px;"><?= ('Ngân hàng'); ?></span>
                <br />
                <span style="padding-left: 25px;word-break: keep-all;"><?= $info_bank->name; ?></span>
              </p>
            </div>
            <div class="entry">
              <p><i class="fa fa-credit-card" aria-hidden="true"></i>
                <span style="padding-left: 5px;"><?= ('Số tài khoản'); ?></span>
                <br />
                <b id="copyStk" style="padding-left: 25px;word-break: keep-all;color:greenyellow;"><?= $info_bank->accountNumber; ?></b>
                <i onclick="copy()" data-clipboard-target="#copyStk" class="fas fa-copy copy"></i>
              </p>
            </div>
            <div class="entry">
              <p><i class="fa fa-user" aria-hidden="true"></i>
                <span style="padding-left: 5px;"><?= ('Chủ tài khoản'); ?></span>
                <br />
                <span style="padding-left: 25px;word-break: keep-all;"><?= $info_bank->accountName; ?></span>
              </p>
            </div>
            <div class="entry">
              <p><i class="fa fa-money" aria-hidden="true"></i>
                <span style="padding-left: 5px;"><?= ('Số tiền cần thanh toán'); ?></span>
                <br />
                <b style="padding-left: 25px;color:aqua;"><?= number_format($invoice_info->amount); ?></b>
              </p>
            </div>
            <div class="entry">
              <p><i class="fa fa-comment" aria-hidden="true"></i>
                <span style="padding-left: 5px;"><?= ('Nội dung chuyển khoản'); ?></span>
                <br />
                <b id="copyNoiDung" style="padding-left: 25px;word-break: keep-all;color:yellow;"><?= $invoice_info->trans_id; ?></b>
                <i onclick="copy()" data-clipboard-target="#copyNoiDung" class="fas fa-copy copy"></i>
              </p>
            </div>
            <div class="entry">
              <p><i class="fa fa-barcode" aria-hidden="true"></i>
                <span style="padding-left: 5px;"><?= ('Trạng thái'); ?>
                </span>
                <br />
                <i class="fa fa-spinner fa-spin"></i><span id="status_payment" style="padding-left: 25px;word-break: break-all;"><?= ('Đang tìm dữ liệu...'); ?></span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 right">
          <div class="content">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="message" id="loginForm">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="qr-code">
                        <?php // Thanh toán MOMO
                        if ($invoice_info->payment_method == 'MOMO') { ?>
                          <div class="payment-cta">
                            <div>
                              <h1><?= ('Quét mã QR để thanh toán'); ?></h1>
                            </div>
                            <a><?= ('Sử dụng <b> App MoMo </b> hoặc ứng dụng camera hỗ trợ QR code để quét mã'); ?></a>
                          </div>
                          <?= file_get_contents("https://api.web2m.com/api/qrmomo.php?amount=" . $invoice_info->pay . "&phone=" . $info_bank->accountNumber . "&noidung=" . $invoice_info->trans_id); ?>
                          <h3 class="text-center"><?= ('Nội dung chuyển tiền'); ?> <b style="color: blue;"><?= $invoice_info->trans_id; ?></b></h3>
                          <h4><?= ('Vui lòng nhập đúng nội dung chuyển tiền'); ?></h4>

                        <?php } elseif ($invoice_info->payment_method == 'THESIEURE') { ?>

                          <img src="https://thesieure.com/storage/userfiles/images/logo_thesieurecom.png" class="mb-5">
                          <h3 class="text-center">Thực hiện chuyển quỹ vào ví có số điện thoại là
                            <b><?= $invoice_info->accountNumber; ?></b>
                          </h3>
                          <h3 class="text-center"><?= ('Số tiền cần chuyển là'); ?> <b style="color: red;"><?= number_format($invoice_info->pay); ?></b></h3>
                          <h3 class="text-center"><?= ('Nội dung chuyển tiền'); ?> <b style="color: blue;"><?= $invoice_info->trans_id; ?></b></h3>
                          <h4 class="text-center"><?= ('Hệ thống tự động xử lý giao dịch khi thực hiện chuyển tiền thành công'); ?></h4>


                        <?php } elseif (
                          $invoice_info->payment_method == 'Zalo Pay' ||
                          $invoice_info->payment_method == 'Kasikorn Bank' ||
                          $invoice_info->payment_method == 'Siam Commercial Bank' ||
                          $invoice_info->payment_method == 'MOMO' ||
                          $invoice_info->payment_method == 'THESIEURE' ||
                          $invoice_info->payment_method == 'Zalo Pay' ||
                          $invoice_info->payment_method == 'Bank of Ayudthya' ||
                          $invoice_info->payment_method == 'Krungthai Bank' ||
                          $invoice_info->payment_method == 'Bangkok Bank' ||
                          $invoice_info->payment_method == 'Wing Bank' ||
                          $invoice_info->payment_method == 'ABA Bank' ||
                          $invoice_info->payment_method == 'State Bank of India' ||
                          $invoice_info->payment_method == 'HDFC Bank' ||
                          $invoice_info->payment_method == 'ICICI Bank' ||
                          $invoice_info->payment_method == 'Thanachart Bank' ||
                          $invoice_info->payment_method == 'Maybank' ||
                          $invoice_info->payment_method == 'CIMB Clicks Malaysia' ||
                          $invoice_info->payment_method == 'United Bank for Africa (UBA)'
                        ) { ?>
                          <h3 class="text-center"><?= ('Số tiền cần chuyển là'); ?> <b style="color: red;"><?= number_format($invoice_info->pay); ?></b></h3>
                          <h3 class="text-center"><?= ('Nội dung chuyển tiền'); ?> <b style="color: blue;"><?= $invoice_info->trans_id; ?></b></h3>
                          <h4><?= ('Vui lòng nhập đúng nội dung chuyển tiền'); ?></h4>
                        <?php } else { ?>


                          <div class="payment-cta">
                            <div>
                              <h1><?= ('Quét mã QR để thanh toán'); ?></h1>
                            </div>
                            <a><?= ('Sử dụng <b> App Internet Banking </b> hoặc ứng dụng camera hỗ trợ QR code để quét mã'); ?></a>
                          </div>
                          <img src="https://api.vietqr.io/<?= $invoice_info->payment_method; ?>/<?= $info_bank->accountNumber; ?>/<?= $invoice_info->pay; ?>/<?= $invoice_info->trans_id; ?>/vietqr_net_2.jpg?accountName=<?= $info_bank->accountName; ?>" width="100%" />

                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid hidden-xs">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="copyrights text-center">
            <p style="color: #737373;   font-size: 11pt; font-weight: bold;">
              <br />
              <?= ('Vui lòng thanh toán vào thông tin tài khoản trên để hệ thống xử lý hoá đơn tự động.'); ?>
            </p>
            <a href="<?= base_url('payment/invoices'); ?>">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
              <span><?= ('Quay lại'); ?></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= public_url('client/faces'); ?>/javax.faces.resource/adyen/js/tracking-version=1.2.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="<?= public_url('client/faces'); ?>/javax.faces.resource/adyen/js/tether.min.js"></script>
  <script src="<?= public_url('client/faces'); ?>/javax.faces.resource/adyen/js/bootstrap.min.js"></script>
  <script src="<?= public_url('client/faces'); ?>/javax.faces.resource/adyen/js/m2.js"></script>
  <script type="text/javascript" src="<?= public_url('client/faces'); ?>/javax.faces.resource/js/momo.js"></script>
  <script type="text/javascript" src="<?= public_url('client/faces'); ?>/javax.faces.resource/js/ws.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
  <script type="text/javascript">
    $(window).load(function() {
      $('#page').show();
      $('#spinner').hide();
      $("img.lazy").show().lazyload();
    });
  </script>
  <script type="text/javascript">
    function getStatusInvoice() {
      $.ajax({
        url: "<?= base_url('payment/invoice/'); ?><?= $invoice_info->trans_id ?>",
        type: "POST",
        dataType: "JSON",
        data: {
          trans_id: "<?= $invoice_info->trans_id; ?>"
        },
        success: function(result) {
          if (result.return == 1) {
            setTimeout("location.href = '<?= base_url('payment/invoices'); ?>';", 1000);
          }
          $('#status_payment').html(result.status);
        }
      });
    }
    setInterval(function() {
      $('#status_payment').load(getStatusInvoice());
    }, 5000);
    new ClipboardJS(".copy");

    function copy() {
      cuteToast({
        type: "success",
        message: "<?= ('Đã sao chép vào bộ nhớ tạm'); ?>",
        timer: 5000
      });
    }
  </script>
</body>

</html>