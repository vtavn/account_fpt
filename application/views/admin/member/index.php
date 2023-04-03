  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Danh sách thành viên</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= admin_url('dashboard') ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active">Danh sách thành viên</li>
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
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Tổng thành viên</span>
              <span class="info-box-number"><?= number_format($member_count) ?> thành viên</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Số dư thành viên</span>
              <span class="info-box-number"><?= number_format($total_money) ?> đ</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-cog"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Staff</span>
              <span class="info-box-number">Admin:
                <?= number_format($admin_count) ?> / CTV:
                <?= number_format($ctv_count) ?></span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-lock"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tài khoản bị vô hiệu hoá</span>
              <span class="info-box-number"><?= number_format($member_ban_count) ?> tài khoản</span>
            </div>
          </div>
        </div>
        <section class="col-lg-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">Danh sách thành viên</h5>
            </div>
            <div class="card-body">

              <div class="table-responsive p-0">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tài khoản</th>
                      <th>Chi tiết</th>
                      <th>Bảo mật</th>
                      <th>Admin</th>
                      <th>CTV</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $user) : ?>
                      <tr>
                        <td><?= $user->id ?></td>
                        <td>
                          <ul>
                            <li>Tên đăng nhập: <b><?= $user->username ?></b>
                              [ID <b><?= $user->id ?></b>]</li>
                            <li>Địa chỉ Email: <b style="color:green"><?= $user->email ?></b></li>
                            <li>Số điện thoại: <b style="color:blue"><?= $user->phone ?></b>
                            </li>
                            <li>Banned: <?= display_banned($user->status) ?></li>
                          </ul>
                        </td>
                        <td>
                          <ul>
                            <li>Số dư khả dụng: <b style="color:blue"><?= $user->money ?></b></li>
                            <li>Tài khoản đang bán: <b style="color:blue">xx</b></li>
                            <li>Tài khoản đã bán: <b style="color:green">xx</b></li>
                          </ul>
                        </td>
                        <td>
                          <ul>
                            <li>IP: <b><?= display_last_ip($user->ip_login) ?></b></li>
                            <li>Status: <b><?= display_banned($user->status) ?></b>
                            </li>
                            <li>Ngày tham gia: <b><?= display_time($user->created_at) ?></b></li>
                            <li>Hoạt động gần đây: <b><?= display_time($user->updated_at) ?></b></li>
                          </ul>
                        </td>
                        <td><?= display_role(3, $user->role_id) ?></td>
                        <td><?= display_role(2, $user->role_id) ?></td>
                        <td>
                          <a aria-label="" href="<?= admin_url('member/update') ?>/<?= $user->id ?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                            <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                          </a>
                          <button style="color:white;" onclick="RemoveAccount(<?= $user->id; ?>,'<?= $user->email; ?>')" class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
                            <i class="fas fa-trash mr-1"></i><span class="">Delete</span>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <?php if (!empty($pagination)) : ?>
                <div class="pagination text-center">
                  <?php echo $pagination; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </section>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

  <script type="text/javascript">
    function postRemove(id) {
      $.ajax({
        url: "<?= admin_url('member/remove'); ?>",
        type: 'POST',
        dataType: "JSON",
        data: {
          id: id
        },
        success: function(response) {
          if (response.status == 'success') {
            cuteToast({
              type: "success",
              title: "Thành Công",
              message: "Đã xóa thành công item " + id,
              timer: 3000
            });
          } else {
            cuteToast({
              type: "error",
              title: "Lỗi",
              message: "Đã xảy ra lỗi khi xoá item " + id,
              timer: 5000
            });
          }
        }
      });
    }

    function RemoveAccount(id, email) {
      cuteAlert({
        type: "question",
        title: "CẢNH BÁO",
        message: "Bạn có chắc chắn muốn xóa thành viên ID <b>" + id + "</b> - <b>" + email + "</b> không ?",
        confirmText: "Đồng Ý",
        cancelText: "Hủy"
      }).then((e) => {
        if (e) {
          postRemove(id)
          location.reload()
        }
      })
    }
  </script>