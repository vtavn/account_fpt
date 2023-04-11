<header>
  <div class="top-bar">
    <div class="container">
      <div class="row content">
        <div class="col-12 col-lg-4 d-flex flex-column align-items-center">
          <span>Chăm sóc khách hàng</span>
          <span>Email: <a href="mailto:<?= getSettingByName('email') ?>" class="text-white"><?= getSettingByName('email') ?></a></span>
        </div>
        <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center">
          <span class="phone-topbar"><i class="fas fa-phone-alt"></i> <?= getSettingByName('phone') ?></span>
        </div>
        <div class="col-12 col-lg-2 d-flex align-items-center mb-2 mb-lg-0">
          <a href="tel:<?= getSettingByName('phone') ?>" class="btn btn-block btn-buy-cua btn-cua-top">Hỗ Trợ Trực Tuyến</a>
        </div>
        <div class="col-12 col-lg-2 d-flex align-items-center mb-2 mb-lg-0">
          <a href="<?= getSettingByName('facebook_admin') ?>" class="btn btn-block btn-buy-cua btn-cua-top-2">Đăng Ký Đại Lý/CTV</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
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
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">1</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-header">1 Thông báo</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> Cập nhật phiên bản.
                <span class="float-right text-muted text-sm">3 phút</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">Xem tất cả thông báo</a>
            </div>
          </li>
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
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">1</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-header">1 Thông báo</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> Chào mừng.
                <span class="float-right text-muted text-sm">3 phút</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">Xem tất cả thông báo</a>
            </div>
          </li>
          <li class="nav-item">
            <b class="nav-link">
              <i class="fas fa-dollar-sign"></i> <?= number_format($my_info->money) ?> vnđ
            </b>
          </li>
          <li class="nav-item dropdown dropdown-hover">
            <a id="drMemberHeader" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?= $my_info->username ?></a>
            <ul aria-labelledby="drMemberHeader" class="dropdown-menu border-0 shadow">
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