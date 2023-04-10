<div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $title ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <?php
  $avatar = "https://www.gravatar.com/avatar/" . $my_info->email . ".jpg?s=120";

  ?>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="<?= $avatar ?>" alt="<?= $my_info->username ?>">
              </div>

              <h3 class="profile-username text-center"><?= $my_info->username ?></h3>

              <p class="text-muted text-center"><?= getRoleById($my_info->role_id)->name ?></p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Tiền đã nạp</b> <b class="float-right text-primary"><?= number_format(getTotalPaymentById($my_info->id)) ?> đ</b>
                </li>
                <li class="list-group-item">
                  <b>Tiền đã tiêu</b> <b class="float-right text-danger"><?= number_format(getTotalPaymentById($my_info->id) - $my_info->money) ?> vnđ</b>
                </li>
                <li class="list-group-item">
                  <b>Số dư</b> <b class="float-right text-success"><?= number_format($my_info->money) ?> vnđ</b>
                </li>
              </ul>

              <a href="<?= getSettingByName('phone') ?>" class="btn btn-primary btn-block"><b>Gọi hỗ trợ</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <?php $this->load->view('message'); ?>
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#my_info" data-toggle="tab">Thông tin cá nhân</a></li>
                <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">Lịch sử hoạt động</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Bảo mật</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="my_info">
                  <!-- my info -->
                  <form class="form-horizontal" action="<?= base_url('auth/changeinfo') ?>" method="post">
                    <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" name="email" value="<?= $my_info->email ?>" hidden>
                        <input type="email" class="form-control" name="showMail" placeholder="Email" value="<?= $my_info->email ?>" disabled>
                        <i>* nếu bạn cần thay đổi địa chỉ email vui lòng liên hệ admin.</i>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="username" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" placeholder="username" value="<?= $my_info->username ?>">
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Tên</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Tên của bạn" value="<?= $my_info->name ?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Số điện thoại</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="<?= $my_info->phone ?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="changePassword" class="col-sm-2 col-form-label">Đổi mật khẩu
                        <input type="checkbox" name="changePassword" id="changePassword" class="checkChangePass" value="1">
                      </label>
                    </div>

                    <div class="changePassword">
                      <div class="form-group row">
                        <label for="oldPassword" class="col-sm-2 col-form-label">Mật khẩu cũ </label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="oldPassword" placeholder="******">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="newPassword" class="col-sm-2 col-form-label">Mật khẩu mới </label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="newPassword" placeholder="******">
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Lưu</button>
                      </div>
                    </div>
                  </form>
                  <!-- /.my info -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="history">
                  <!-- The timeline -->
                  Updating...
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                  <p>Vui lòng bảo mật token của bạn. Nếu token bị lộ vui lòng <b>đăng xuất</b> tài khoản và thực hiện <b>đăng nhập lại</b>.</p>
                  <label>Token của bạn:</label>
                  <input type="text" class="form-control" value="<?= $my_info->token ?>" disabled>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<script>
  $(".changePassword").hide();
  $(".checkChangePass").click(function() {
    if ($(this).is(":checked")) {
      $(".changePassword").show(300);
    } else {
      $(".changePassword").hide(200);
    }
  });
</script>