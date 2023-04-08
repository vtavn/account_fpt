<div class="container">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= admin_url('dashboard') ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <section class="col-lg-12">
          <div class="card card-primary card-outline">
            <?php $this->load->view('message'); ?>
            <div class="card-header">
              <h5 class="m-0"><?= $title ?></h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <form>
                    <label for="">Tài khoản</label>
                    <input type="text" value="<?= explodeData($account_info->account)[0] ?>" class="form-control" disabled>
                    <label for="">Mật khẩu</label>
                    <input type="text" value="<?= explodeData($account_info->account)[1] ?>" class="form-control" disabled>
                    <div class="mt-3">
                      <p>Hạn sử dụng: <b><?= $account_info->duration ?> tháng</b>.</p>
                      <p>Ngày mua: <b><?= display_time($account_info->buyed_at) ?></b>.</p>
                      <p>Ngày hết hạn: <b><?= display_time($order_info->expired_at) ?> </b>.</p>
                      <p>Số ngày dùng còn lại: <b><?= daysUntil($account_info->buyed_at, $order_info->expired_at) ?></b> ngày.</p>
                    </div>
                  </form>
                </div>
                <div class="col-lg-6">
                  <strong>Lưu ý khi sử dụng</strong>
                  <p>- Lưu ý 1</p>
                  <p>- Lưu ý 2</p>
                  <p>- Lưu ý 3</p>
                </div>
              </div>
              <a href="<?= base_url('orders') ?>" class="btn btn-block btn-primary btn-flat">Quay lại</a>
            </div>
          </div>
      </div>
      </section>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>