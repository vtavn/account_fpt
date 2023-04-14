<!-- slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner">
    <?php
    $count = 0;
    foreach ($list_banner as $banner) :
    ?>
      <div class="carousel-item <?= ($count == 0) ? 'active' : '' ?>">
        <a href="<?= $banner->link ?>">
          <img class="d-block w-100" src="<?= $banner->thumb ?>" alt="<?= $banner->name ?>">
        </a>
      </div>
    <?php
      $count++;
    endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-custom-icon" aria-hidden="true">
      <i class="fas fa-chevron-left"></i>
    </span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-custom-icon" aria-hidden="true">
      <i class="fas fa-chevron-right"></i>
    </span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container">
  <div class="row">

    <div class="col-lg-12 mt-2">
      <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="3" scrolldelay="5" direction="left">
        <div class="link-slide">
          <?php
          $listFakeOrders = explode(PHP_EOL, getSettingByName('fake_order'));
          foreach ($listFakeOrders as $notice) :
          ?>
            <p>🏷️ <?= $notice ?></p>
          <?php endforeach; ?>
        </div>
      </marquee>
    </div>
    <!-- endslider -->

    <!-- categories -->
    <div class="col-lg-12">
      <div class="row owl-carousel owl-theme" id="listPackageHome">
        <?php foreach ($list_package as $pack) : ?>
          <div class="col-12">
            <div class="info-box category-item">
              <span><img src="<?= $pack->thumb ?>" alt=""></span>

              <div class="info-box-content">
                <span class="info-box-text"><?= $pack->name ?></span>
                <a class="btn btn-xs btn-buy-cua" href="<?= client_url($pack->name) ?><?= $pack->id ?>.html">Mua ngay</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="col-lg-12">
      <h3 class="mt-3 d-flex title-home">Tài khoản mới</h3>
      <?php if (count($list_account) > 0) : ?>
        <div class="row owl-carousel owl-theme" id="listAccounts">
          <?php $this->load->view('client/pages/products/listAccounts') ?>
        </div>
      <?php else : ?>
        <h4 class="alert alert-danger text-center text-uppercase">Đã hết Tài khoản, Vui lòng quay lại sau.</h4>
      <?php endif; ?>
    </div>

    <div class="col-lg-6">
      <?= getSettingByName('ads_img_home') ?>
    </div>
    <div class="col-lg-6">
      <?= getSettingByName('ads_video_home') ?>
    </div>

    <div class="col-lg-12">
      <h3 class="mt-3 d-flex title-home">Tài khoản Cộng Tác Viên</h3>
      <?php if (count($list_account_ctv) > 0) : ?>
        <div class="row owl-carousel owl-theme" id="listAccounts2">
          <?php $this->load->view('client/pages/products/listAccountsCtv') ?>
        </div>
      <?php else : ?>
        <h4 class="alert alert-danger text-center text-uppercase">Đã hết Tài khoản, Vui lòng quay lại sau.</h4>
      <?php endif; ?>
    </div>

    <div class="col-lg-12">
      <h3 class="mt-3 d-flex title-home">Tài khoản nổi bật</h3>
      <?php if (count($list_account) > 0) : ?>
        <div class="row owl-carousel owl-theme" id="listAccounts3">
          <?php $this->load->view('client/pages/products/listAccounts') ?>
        </div>
      <?php else : ?>
        <h4 class="alert alert-danger text-center text-uppercase">Đã hết Tài khoản, Vui lòng quay lại sau.</h4>
      <?php endif; ?>
    </div>

    <div class="col-lg-12">
      <h3 class="mt-3 d-flex title-home">Tin tức <a href="<?= base_url('blog') ?>" class="ml-2 readmore"><i class="fas fa-angle-double-right"></i></a></h3>
      <div class="row">
        <?php foreach ($blog_list as $blog) : ?>
          <div class="col-md-12 col-lg-6 col-xl-4" style="border-radius: 10px!important;">
            <a href="<?= base_url() . 'blog/' . create_slug($blog->title) . '-' . $blog->id . '.html' ?>">
              <div class="card mb-2 bg-gradient-dark">
                <img class="card-img-top" style="border-radius: 10px!important;" src="<?= $blog->thumb ?>" alt="Dist Photo 1">
                <div class="card-img-overlay d-flex flex-column justify-content-end">
                  <h5 class="card-title text-primary text-white"><?= split_content($blog->title, 150) ?></h5>
                  <a href="#" class="text-white mt-2"><?= getNameMemberById($blog->member_id)->name ?> - <?= $blog->updated_at ?></a>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <!-- /.row -->

  <?php $this->load->view('client/models/buymodel'); ?>

  <!-- Modal -->

  <div class="modal fade" id="noticeAdmin">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Thông báo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-center mb-3">
            <img src="<?= getSettingByName('logo') ?>" alt="Logo">
          </div>
          <?= getSettingByName('notice_home_admin') ?>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- /.content -->
  <div class="modal fade" id="notiGuest">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-content-custom">
        <div class="modal-body">
          <div class="d-flex justify-content-center mb-3 pophome">
            <img src="<?= getSettingByName('popup_home') ?>" alt="Pop" class="img-fluid">
          </div>

          <p class="d-block" style="color: black;font-size: 18px;text-align: center;"><?= getSettingByName('popup_content_home') ?></p>
          <div class="d-flex justify-content-center mb-3 pophome">
            <a class="btn btn-buy" href="<?= getSettingByName('popup_link_home') ?>">Xem ngay</a>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

  </div><!-- /.container-fluid -->
  <!-- /.content -->

  <?php
  if (isset($my_info)) {
    if ($my_info->role_id != '3') {
  ?>
      <script>
        setTimeout(function() {
          $('#noticeAdmin').modal('show')
        }, 1000);
      </script>
    <?php }
  } else { ?>
    <script>
      setTimeout(function() {
        $('#notiGuest').modal('show')
      }, 1000);
    </script>
  <?php } ?>