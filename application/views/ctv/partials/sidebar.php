    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= ctv_url('dashboard') ?>" class="brand-link">
        <img src="<?php echo public_url('admin/') ?>img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CTV Panel</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo public_url('admin/') ?>img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $my_info->username ?></a>
            <a href="<?= base_url('auth/logout') ?>" class="badge badge-danger">Đăng xuất</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item has-treeview">
              <a href="<?= ctv_url('dashboard') ?>" class="nav-link <?= ($controller == 'dashboard' && $action == 'index') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item <?= (($controller == 'account' && ($action == 'index' || $action == 'create' || $action == 'update'))) ? 'menu-is-opening menu-open' : '' ?>">
              <a href="#" class="nav-link <?= (($controller == 'account' && ($action == 'index' || $action == 'create' || $action == 'update'))) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-store"></i>
                <p>
                  Tài khoản
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ">
                <li class="nav-item">
                  <a href="<?= ctv_url('account') ?>" class="nav-link <?= ($controller == 'account' && $action == 'index') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tài khoản</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= ctv_url('account/create') ?>" class="nav-link <?= ($controller == 'account' && $action == 'create') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thêm Tài khoản</p>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item">
              <a href="<?= ctv_url('bank') ?>" class="nav-link <?= ($controller == 'bank' && ($action == 'index' || $action == 'update')) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-university"></i>
                <p>
                  Ngân Hàng
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= ctv_url('payment') ?>" class="nav-link <?= ($controller == 'payment' && ($action == 'index' || $action == 'create')) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-university"></i>
                <p>
                  Hoá Đơn
                </p>
              </a>
            </li>

            <!-- <li class="nav-item">
              <a href="<?= ctv_url('bank') ?>" class="nav-link <?= ($controller == 'bank' && ($action == 'index' || $action == 'update')) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-university"></i>
                <p>
                  Ngân Hàng
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= ctv_url('orders') ?>" class="nav-link  <?= ($controller == 'orders' && ($action == 'index' || $action == 'update')) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>
                  Đơn hàng
                </p>
              </a>
            </li>
 -->


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>