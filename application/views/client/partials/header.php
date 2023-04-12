<header>
  <div class="top-bar">
    <div class="container">
      <div class="row content">
        <div class="col-12 col-lg-4 d-none d-lg-flex flex-column">
          <span>Chăm sóc khách hàng</span>
          <span>Email: <a href="mailto:<?= getSettingByName('email') ?>" class="text-white"><?= getSettingByName('email') ?></a></span>
        </div>
        <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center flex-column">
          <p class="m-0">Hotline tư vấn đăng ký</p>
          <span class="phone-topbar"><i class="fas fa-phone-alt"></i> <?= getSettingByName('phone_topbar') ?></span>
        </div>

        <div class="col-6 col-lg-2 d-flex align-items-center mb-2 mb-lg-0">
          <a href="tel:<?= getSettingByName('phone') ?>" class="text-uppercase btn btn-block btn-buy-cua btn-cua-top">Hỗ Trợ Trực Tuyến</a>
        </div>
        <div class="col-6 col-lg-2 d-flex align-items-center mb-2 mb-lg-0">
          <a href="<?= getSettingByName('facebook_admin') ?>" class="text-uppercase btn btn-block btn-buy-cua btn-cua-top-2">Đăng Ký Đại Lý/CTV</a>
        </div>

      </div>
    </div>
  </div>
  <!-- Navbar -->
  <nav id="navbar_top" class="main-header navbar navbar-expand-md navbar-dark">
    <div class="container">

      <a href="/" class="navbar-brand">
        <img src="<?= getSettingByName('logo') ?>" al="Logo" class="">
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <?php showMenuClient($menuShowClient); ?>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <?php if (empty($my_info)) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/register') ?>">
              <i class="fas fa-sign-in-alt"></i> Đăng ký
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/login') ?>">
              <i class="fas fa-sign-in-alt"></i> Đăng nhập
            </a>
          </li>
        <?php else : ?>
          <?php if ($my_info->role_id == '3') : ?>
            <li class="nav-item">
              <a class="btn btn-md btn-danger text-white" target="_blank" href="<?= admin_url('dashboard') ?>">Administrator</a>
            </li>
          <?php endif ?>
          <?php if ($my_info->role_id == '2') : ?>
            <li class="nav-item">
              <a class="btn btn-md btn-danger text-white" target="_blank" href="<?= ctv_url('dashboard') ?>">CTV</a>
            </li>
          <?php endif ?>
          <li class="nav-item dropdown dropdown-hover">
            <a id="drMemberHeader" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?= $my_info->username ?></a>
            <ul aria-labelledby="drMemberHeader" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Số dư: <b class="text-red"><?= number_format($my_info->money) ?> vnđ</b></a></li>
              <li><a href="<?= base_url('auth/profile') ?>" class="dropdown-item">Thông tin của bạn </a></li>
              <li><a href="<?= base_url('auth/logout') ?>" class="dropdown-item">Đăng xuất</a></li>
            </ul>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </nav>

  <!-- /.navbar -->
</header>