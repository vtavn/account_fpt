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
            <div class="card-header">
              <h5 class="m-0"><?= $title ?></h5>
            </div>
            <?php $this->load->view('message'); ?>
            <div class="card-body">
              <form method="get" action="<?= admin_url('log') ?>" class="mb-2">
                <div class="row">
                  <input class="form-control col-sm-2 mb-2" name="member_id" value="<?= getValueinGet('member_id') ?>" placeholder="Id Thành Viên">
                  <input class="form-control col-sm-2 mb-2" name="action" value="<?= getValueinGet('action') ?>" placeholder="Action">
                  <input class="form-control col-sm-2 mb-2" name="ip" value="<?= getValueinGet('ip') ?>" placeholder="IP">
                  <input class="form-control col-sm-2 mb-2" name="device" value="<?= getValueinGet('device') ?>" placeholder="Device">

                  <div class="col-sm-4 mb-2">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
                      Tìm kiếm
                    </button>
                    <a class="btn btn-danger" href="<?= admin_url('log') ?>"><i class="fa fa-trash"></i>
                      Bỏ lọc
                    </a>
                  </div>

                </div>
              </form>
              <div class="table-responsive p-0">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Tên tài khoản</th>
                      <th>Action</th>
                      <th>Time</th>
                      <th>Ip</th>
                      <th>Device</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $item) : ?>
                      <tr>
                        <td><a href="<?= admin_url('member/update/') . $item->member_id ?>"><?= getNameMemberById($item->member_id)->username ?></a></td>
                        <td><?= $item->action ?></td>
                        <td><?= display_time($item->created_at) ?></td>
                        <td><?= $item->ip ?></td>
                        <td><?= $item->device ?></td>
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
        url: "<?= admin_url('account/remove'); ?>",
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
              message: "Đã xóa thành công tài khoản " + id,
              timer: 3000
            });
          } else {
            cuteToast({
              type: "error",
              title: "Lỗi",
              message: "Đã xảy ra lỗi khi xoá tài khoản " + id,
              timer: 5000
            });
          }
        }
      });
    }

    function RemovePackage(id, name) {
      cuteAlert({
        type: "question",
        title: "CẢNH BÁO",
        message: "Bạn có chắc chắn muốn xóa tài khoản <b>" + id + "</b> - <b>" + name + "</b> không ?",
        confirmText: "Đồng Ý",
        cancelText: "Hủy"
      }).then((e) => {
        if (e) {
          postRemove(id)
          location.reload()
        }
      })
    }

    $(function() {
      $(".select2").select2()
      $(".select2bs4").select2({
        theme: "bootstrap4"
      });
    });
  </script>
  </script>