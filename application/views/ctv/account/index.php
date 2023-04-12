  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Danh sách tài khoản</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= ctv_url('dashboard') ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active">Danh sách tài khoản</li>
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
              <h5 class="m-0">Danh sách tài khoản</h5>
            </div>
            <?php $this->load->view('message'); ?>
            <div class="card-body">
              <form method="get" action="<?= ctv_url('account') ?>" class="mb-2">
                <div class="row">
                  <input class="form-control col-sm-2 mb-2" name="account" value="<?= getValueinGet('account') ?>" placeholder="Tài khoản">
                  <select class="form-control select2bs4 col-sm-2 m-2" name="package_id">
                    <option value="">Gói Cước</option>
                    <?php foreach ($all_packages as $package) : ?>
                      <option value="<?= $package->id ?>" <?= (getValueinGet('package_id') == $package->id) ? 'selected' : '' ?>><?= $package->name ?></option>
                    <?php endforeach; ?>
                  </select>
                  <select class="form-control select2bs4 col-sm-2 mb-2" name="seller_id">
                    <option value="">Người Bán</option>
                    <?php foreach ($members as $mem) : ?>
                      <option value="<?= $mem->id ?>" <?= (getValueinGet('seller_id') == $mem->id) ? 'selected' : '' ?>><?= $mem->username ?> (<?= $mem->name ?>)</option>
                    <?php endforeach; ?>
                  </select>
                  <select class="form-control  col-sm-2 mb-2" name="status">
                    <option value="">Trạng thái</option>
                    <option value="1" <?= (getValueinGet('status') == 1) ? 'selected' : '' ?>>Đang Bán</option>
                    <option value="2" <?= (getValueinGet('status') == 2) ? 'selected' : '' ?>>Đã bán</option>
                    <option value="4" <?= (getValueinGet('status') == 4) ? 'selected' : '' ?>>Đang chờ duyệt</option>
                  </select>

                  <div class="col-sm-4 mb-2">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
                      Tìm kiếm
                    </button>
                    <a class="btn btn-danger" href="<?= ctv_url('account') ?>"><i class="fa fa-trash"></i>
                      Bỏ lọc
                    </a>
                  </div>

                </div>
              </form>
              <div class="table-responsive p-0">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tên tài khoản</th>
                      <th>Tài khoản</th>
                      <th>Giá</th>
                      <th>Giá Sale</th>
                      <th>Gói</th>
                      <th>Thời Hạn</th>
                      <th>Người bán</th>
                      <th>Người mua</th>
                      <th>Trạng thái</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $item) : ?>
                      <tr>
                        <td><?= $item->id ?></td>
                        <td><?= $item->name ?></td>
                        <td><textarea class="form-control" disabled><?= $item->account ?></textarea></td>
                        <td><?= number_format($item->price) ?></td>
                        <td><?= number_format($item->sale_price) ?></td>
                        <td><span class="badge badge-info"><?= getNamePackageById($item->package_id)->name ?></span></td>
                        <td><span class="badge badge-info"><?= $item->duration ?> Tháng</span></td>
                        <td><span class="badge badge-info"><?= getNameMemberById($item->seller_id)->name ?></span></td>
                        <td><span class="badge badge-success"><?= ($item->buyer_id) ? getNameMemberById($item->buyer_id)->name : 'none' ?></span></td>
                        <td><?= display_account($item->status) ?></td>

                        <td>
                          <a aria-label="" href="<?= ctv_url('account/update') ?>/<?= $item->id ?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
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
        url: "<?= ctv_url('account/remove'); ?>",
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