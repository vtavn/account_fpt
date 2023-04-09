<!-- slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner">
    <?php
    $count = 0;
    foreach ($list_banner as $banner) :
    ?>
      <div class="carousel-item <?= ($count == 0) ? 'active' : '' ?>">
        <img class="d-block w-100" src="<?= $banner->thumb ?>" alt="<?= $banner->name ?>">
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
    <div class="col-lg-12">

    </div>
    <!-- endslider -->

    <!-- categories -->
    <div class="col-lg-12 mt-3">
      <div class="row owl-carousel owl-theme" id="listPackageHome">
        <?php foreach ($list_package as $pack) : ?>
          <div class="col-12">
            <div class="info-box category-item">
              <span><img src="<?= $pack->thumb ?>" alt=""></span>

              <div class="info-box-content">
                <span class="info-box-text"><b><?= $pack->name ?></b></span>
                <a class="btn btn-xs btn-info" href="<?= client_url($pack->name) ?><?= $pack->id ?>.html">Mua ngay</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="col-lg-12">
        <h3 class="mt-3 d-flex title-home">Tài khoản mới</h3>
        <div class="row owl-carousel owl-theme" id="listAccounts">
          <?php foreach ($list_account as $account) : ?>
            <!-- card item account -->
            <div class="product-item mt-4 mt-md-3">
              <div class="card basic-drop-shadow p-3 shadow-showcase shadow">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <p><img class="mr-1" src="https://fptplay.vn/favicon.ico" width="25px"><b><?= $account->name ?></b>
                    </p>
                    <p style="font-size: 12px;"><i class="fas fa-angle-right mr-1"></i><i>Bảo hành trong suốt quá trình sử dụng.</i></p>
                    <p style="font-size: 12px;"><i class="fas fa-angle-right mr-1"></i><i>Cam kết sử dụng đủ thời hạn.</i></p>
                    <p style="font-size: 13px;"><i class="fas fa-user mr-1"></i><i>Người bán: <a href="#"><?= getNameMemberById($account->seller_id)->username ?> <i class="fas fa-check mr-1"></i></a></i></p>
                  </div>
                  <div class="col-md-12">
                    <?php if ($account->sale_price > 0) : ?>
                      <span class="btn mb-1 btn-sm btn-outline-success">
                        Giá Sale: <b><?= number_format($account->sale_price) ?></b>
                      </span>
                      <span class="btn mb-1 btn-sm btn-outline-danger">
                        Giá: <b><del><?= number_format($account->price) ?></del></b>
                      </span>
                    <?php else : ?>
                      <span class="btn mb-1 btn-sm btn-outline-success">
                        Giá: <b><?= number_format($account->price) ?></b>
                      </span>
                    <?php endif ?>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-2"></div>
                    <div class="text-center">
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                    </div>
                    <div class="mb-4"></div>
                    <button class="btn btn-block btn-primary" onclick="modalBuy('<?= $account->id ?>', '<?= $account->name ?>')">
                      <i class="fas fa-shopping-cart mr-1"></i>MUA NGAY </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card item account -->
          <?php endforeach; ?>
        </div>
      </div>


      <div class="col-lg-12">
        <h3 class="mt-3 d-flex title-home">Tài khoản nổi bật</h3>
        <div class="row owl-carousel owl-theme" id="listAccounts2">
          <?php foreach ($list_account as $account) : ?>
            <!-- card item account -->
            <div class="product-item mt-4 mt-md-3">
              <div class="card basic-drop-shadow p-3 shadow-showcase shadow">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <p><img class="mr-1" src="https://fptplay.vn/favicon.ico" width="25px"><b><?= $account->name ?></b>
                    </p>
                    <p style="font-size: 12px;"><i class="fas fa-angle-right mr-1"></i><i>Bảo hành trong suốt quá trình sử dụng.</i></p>
                    <p style="font-size: 12px;"><i class="fas fa-angle-right mr-1"></i><i>Cam kết sử dụng đủ thời hạn.</i></p>
                    <p style="font-size: 13px;"><i class="fas fa-user mr-1"></i><i>Người bán: <a href="#"><?= getNameMemberById($account->seller_id)->username ?> <i class="fas fa-check mr-1"></i></a></i></p>
                  </div>
                  <div class="col-md-12">
                    <?php if ($account->sale_price > 0) : ?>
                      <span class="btn mb-1 btn-sm btn-outline-success">
                        Giá Sale: <b><?= number_format($account->sale_price) ?></b>
                      </span>
                      <span class="btn mb-1 btn-sm btn-outline-danger">
                        Giá: <b><del><?= number_format($account->price) ?></del></b>
                      </span>
                    <?php else : ?>
                      <span class="btn mb-1 btn-sm btn-outline-success">
                        Giá: <b><?= number_format($account->price) ?></b>
                      </span>
                    <?php endif ?>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-2"></div>
                    <div class="text-center">
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                      <i class="fas fa-star text-warning mr-1 main_star"></i>
                    </div>
                    <div class="mb-4"></div>
                    <button class="btn btn-block btn-primary" onclick="modalBuy('<?= $account->id ?>', '<?= $account->name ?>')">
                      <i class="fas fa-shopping-cart mr-1"></i>MUA NGAY </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card item account -->
          <?php endforeach; ?>
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

  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->