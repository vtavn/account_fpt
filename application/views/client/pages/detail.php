<div class="container">
  <div class="row pt-3">
    <div class="col-lg-12">
      <div class="card p-3 product-detail">
        <div class="row">
          <div class="col-3 col-lg-3">
            <div class="col-12 col-lg-12">
              <div class="thumb">
                <img src="<?= $package_info->thumb ?>" class="product-image" alt="Product Image">
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-9">
            <h3 class="product-title my-3 text-uppercase"><?= $package_info->name ?></h3>
            <p><?= $package_info->short_content ?></p>

            <div class="device justify-content-center justify-content-lg-start">
              <img src="<?= public_url('client/img/iconfpt/') ?>android.png" alt="">
              <img src="<?= public_url('client/img/iconfpt/') ?>apple.png" alt="">
              <img src="<?= public_url('client/img/iconfpt/') ?>box.png" alt="">
              <img src="<?= public_url('client/img/iconfpt/') ?>smarttv.png" alt="">
              <img src="<?= public_url('client/img/iconfpt/') ?>web.png" alt="">
            </div>
            <hr>
            <div class="row justify-content-center align-items-center">
              <div class="col-12 mb-3 col-lg-6 text-center">
                <div class="product-price">
                  <?php if ($package_info->sale_price > 0) : ?>
                    <?php $priceBuy = $package_info->sale_price; ?>
                    <h2 class="mb-0">
                      Giá: <?= number_format($package_info->sale_price) ?> <s><sup>(<?= number_format($package_info->price) ?>)</sup></s> vnđ

                    </h2>
                  <?php else : ?>
                    <?php $priceBuy = $package_info->price; ?>
                    <h2 class="mb-0">
                      Giá: <?= number_format($package_info->price) ?> vnđ
                    </h2>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-center gap-2">
                  <a target="_blank" href="<?= getSettingByName('zalo_admin') ?>">
                    <img src="<?= public_url('client/img/social/zalo.svg') ?>" alt="">
                  </a>
                  <a target="_blank" href="<?= getSettingByName('facebook_admin') ?>">
                    <img src="<?= public_url('client/img/social/facebook.svg') ?>" alt="">
                  </a>
                  <a target="_blank" href="<?= getSettingByName('tele_admin') ?>">
                    <img src="<?= public_url('client/img/social/telegram-app.svg') ?>" alt="">
                  </a>
                </div>
              </div>
            </div>
            <hr>
            <div class="mt-4 product-action">

              <?php
              if (isset($my_info)) :
                if (getTotalAccountByPackage($package_info->id) > 0) : ?>
                  <!-- <form action="" method="post" id="buyForm"> -->
                  <input type="text" name="package_id" id="package_id" value="<?= $package_info->id ?>" hidden>
                  <button type="submit" onClick="BuyClick('<?= $package_info->name ?>', '<?= number_format($priceBuy) ?>')" id="buyBtn" class="btn btn-buy-cua-2">
                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                    Mua Tài Khoản
                  </button>
                  <!-- </form> -->
                <?php else : ?>
                  <button class="btn btn-cua" disabled>
                    <i class="fas fa-store-slash fa-lg mr-2"></i>
                    Hết hàng
                  </button>
                <?php endif;
              else : ?>
                <a href="<?= base_url('auth/login') ?>" class="btn btn-buy-cua-2">
                  <i class="fas fa-sign-in-alt fa-lg mr-2"></i>
                  Đăng nhập
                </a>
              <?php endif; ?>
              <a href="<?= getSettingByName('facebook_admin') ?>" class="btn btn-cua">
                <i class="fas fa-heart fa-lg mr-2"></i>
                Liên hệ Admin
              </a>
            </div>

          </div>
        </div>

        <div class="row mt-5">
          <nav class="w-100">
            <div class="nav nav-tabs justify-content-center" id="product-tab" role="tablist">
              <a class="nav-item nav-link active font-weight-bold" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Mô Tả</a>
              <a class="nav-item nav-link font-weight-bold" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Đánh giá</a>
              <a class="nav-item nav-link font-weight-bold" id="product-comment-tab" data-toggle="tab" href="#product-comment" role="tab" aria-controls="product-comment" aria-selected="false">Bình luận</a>
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade active show" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> <?= $package_info->content ?></div>
            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">Rate</div>
            <div class="tab-pane fade" id="product-comment" role="tabpanel" aria-labelledby="product-comment-tab">
              <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="" data-numposts="5"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <?= getSettingByName('ads_before_detail') ?>
    </div>

    <div class="col-lg-12">
      <h3 class="mt-3 d-flex title-home">Tài khoản đang có</h3>
      <div class="row owl-carousel owl-theme" id="listAccounts">
        <?php $this->load->view('client/pages/products/listAccounts') ?>
      </div>
    </div>
    <!-- /.row -->
    <?php $this->load->view('client/models/buymodel'); ?>
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<script>
  function handleBuyAccount() {
    $('#buyBtn').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop(
      'disabled',
      true);
    $.ajax({
      url: "<?= base_url('product/buyAccount') ?>",
      method: "POST",
      dataType: "JSON",
      data: {
        type: 'buy-package',
        'package_id': $("#package_id").val(),
        token: '<?= $my_info->token ?>'
      },
      success: function(respone) {
        if (respone.status == 'success') {
          cuteToast({
            type: "success",
            title: "Thành Công",
            message: respone.msg,
            timer: 5000
          });
          setTimeout("location.href = '<?= base_url('orders/show/') ?>" + respone.trans_id + "'", 500);
        } else {
          Swal.fire({
            title: 'Thất bại',
            html: respone.msg,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK!'
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          })
        }
        $('#buyBtn').html('Mua tài khoản').prop('disabled', false);
      },
      error: function() {
        cuteToast({
          type: "success",
          title: "Thất bại",
          message: 'Không thể xử lý',
          timer: 5000
        });
        $('#buyBtn').html('Mua tài khoản').prop('disabled', false);
      }
    });
  }

  function BuyClick(name, price) {
    cuteAlert({
      type: "question",
      title: "CẢNH BÁO",
      message: "Bạn có muốn mua <b>" + name + "</b> với giá: <b>" + price + "đ</b> không?",
      confirmText: "Đồng Ý",
      cancelText: "Hủy"
    }).then((e) => {
      console.log(e)
      if (e == "confirm") {
        handleBuyAccount();
      }
    })
  }
</script>