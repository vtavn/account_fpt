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
      <div class="row owl-carousel owl-theme" id="listAccounts">
        <?php $this->load->view('client/pages/products/listAccounts') ?>
      </div>
    </div>

    <div class="col-lg-6">
      <?= getSettingByName('ads_img_home') ?>
    </div>
    <div class="col-lg-6">
      <?= getSettingByName('ads_video_home') ?>
    </div>

    <div class="col-lg-12">
      <h3 class="mt-3 d-flex title-home">Tài khoản nổi bật</h3>
      <div class="row owl-carousel owl-theme" id="listAccounts2">
        <?php $this->load->view('client/pages/products/listAccounts') ?>
      </div>
    </div>

    <div class="col-lg-12">
      <h3 class="mt-3 d-flex title-home">Tin tức</h3>
      <div class="row">
        tin tức
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
  <!-- /.modal -->

</div><!-- /.container-fluid -->
<!-- /.content -->

<div class="show-popup">
  <div class="overlay"></div>
  <div class="img-show">
    <span id="closedPop">X</span>
    <?= getSettingByName('popup_home') ?>
  </div>
</div>

<script>
  // $(function() {
  //   setTimeout($(".show-popup").fadeIn(), 1500);
  //   $("#closedPop").click(function() {
  //     $(".show-popup").fadeOut();
  //   });
  // });
</script>

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
} ?>