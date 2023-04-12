<?php
$uid = $token = "";
if (isset($my_info)) {
  $uid = $my_info->id;
  $token =  $my_info->token;
}

foreach ($list_account_ctv as $account) : ?>
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
          <?php if ((!empty($uid) && !empty($token)) && $account->sale_price > 0) : ?>
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
          <?php if ((!empty($uid) && !empty($token))) : ?>
            <button class="btn btn-block btn-buy-cua" onclick="modalBuy('<?= $account->id ?>', '<?= $account->name ?>')">
              <i class="fas fa-shopping-cart mr-1"></i>MUA NGAY </button>
          <?php else : ?>
            <a class="btn btn-block btn-buy-cua" href="<?= base_url('auth/login') ?>">
              <i class="fas fa-shopping-cart mr-1"></i>Đăng nhập </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- end card item account -->
<?php endforeach; ?>