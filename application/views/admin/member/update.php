  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Cập nhật thành viên</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= admin_url('dashboard') ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active">Cập nhật thành viên</li>
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
            <div class="card-header">
              <h5 class="m-0">Cập nhật thành viên</h5>
            </div>
            <form action="" method="post">
              <div class="card-body">
                <div class="row">

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Email (*)</label>
                      <input type="email" class="form-control" value="" name="email" required>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" value="" name="username" required>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Họ tên</label>
                      <input type="text" class="form-control" value="" name="name" required>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Số điện thoại</label>
                      <input type="text" class="form-control" value="" name="phone" required>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mật khẩu (*)</label>
                      <input type="text" class="form-control" placeholder="**********" name="password">
                      <i>Nhập mật khẩu cần thay đổi, hệ thống sẽ tự động mã hoá (để trống nếu
                        không muốn
                        thay đổi)</i>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <select class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">Banned</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Quyền hạn</label>
                      <select class="form-control" name="status">
                        <option value="1">Thành Viên</option>
                        <option value="2">CTV</option>
                        <option value="3">Admin</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>IP Login</label>
                      <textarea cols="30" rows="10" class="form-control" disabled>sss</textarea>
                    </div>
                  </div>

                </div>
              </div>
            </form>
          </div>
        </section>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->