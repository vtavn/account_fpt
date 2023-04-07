  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Danh sách gói</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= admin_url('dashboard') ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active">Danh sách gói</li>
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
              <h5 class="m-0">Danh sách gói</h5>
            </div>
            <?php $this->load->view('message'); ?>

            <div class="card-body">
              <div class="table-responsive p-0">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Ảnh</th>
                      <th>Tên gói</th>
                      <th>Thời hạn</th>
                      <th>Giá</th>
                      <th>Giá Sale</th>
                      <th>Tài khoản</th>
                      <th>Trạng thái</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $item) : ?>
                      <tr>
                        <td><?= $item->id ?></td>
                        <td><img src="<?= $item->thumb ?>" alt="" width="40px"></td>
                        <td><?= $item->name ?></td>
                        <td><?= $item->duration ?> tháng</td>
                        <td><?= number_format($item->price) ?></td>
                        <td><?= number_format($item->sale_price) ?></td>
                        <td><span class="badge badge-success"><?= number_format(getTotalAccountByIdPackage($item->id)) ?></span></td>
                        <td><?= display_banned($item->status) ?></td>

                        <td>
                          <a aria-label="" href="<?= admin_url('package/update') ?>/<?= $item->id ?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                            <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                          </a>
                          <button style="color:white;" onclick="RemovePackage(<?= $item->id; ?>,'<?= $item->name ?>')" class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
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
        url: "<?= admin_url('package/remove'); ?>",
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
              message: "Đã xóa thành công gói " + id,
              timer: 3000
            });
          } else {
            cuteToast({
              type: "error",
              title: "Lỗi",
              message: "Đã xảy ra lỗi khi xoá gói " + id,
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
        message: "Bạn có chắc chắn muốn xóa gói <b>" + id + "</b> - <b>" + name + "</b> không ?",
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