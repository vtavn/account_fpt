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
              <form method="get" action="<?= admin_url('invoices') ?>" class="mb-2">
                <div class="row">
                  <input class="form-control col-sm-2 mb-2" name="member_id" value="<?= getValueinGet('member_id') ?>" placeholder="Id Thành Viên">
                  <input class="form-control col-sm-2 mb-2" name="trans_id" value="<?= getValueinGet('trans_id') ?>" placeholder="Mã Giao Dịch">
                  <select class="form-control select2bs4 col-sm-2 m-2" name="payment_method">
                    <option value="">Method</option>
                    <?php foreach ($listBankDefault as $key => $value) { ?>
                      <option value="<?= $key; ?>" <?= (getValueinGet('payment_method') == $key) ? 'selected' : '' ?>><?= $value; ?></option>
                    <?php } ?>
                  </select>
                  <select class="form-control  col-sm-2 mb-2" name="status">
                    <option value="">Trạng thái</option>
                    <option value="0" <?= (getValueinGet('status') == 0) ? 'selected' : '' ?>>Đang chờ thanh toán</option>
                    <option value="1" <?= (getValueinGet('status') == 1) ? 'selected' : '' ?>>Đã thanh toán</option>
                    <option value="2" <?= (getValueinGet('status') == 2) ? 'selected' : '' ?>>Huỷ bỏ</option>
                  </select>

                  <div class="col-sm-4 mb-2">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
                      Tìm kiếm
                    </button>
                    <a class="btn btn-danger" href="<?= admin_url('invoices') ?>"><i class="fa fa-trash"></i>
                      Bỏ lọc
                    </a>
                  </div>

                </div>
              </form>
              <div class="table-responsive p-0">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Mã giao dịch</th>
                      <th>Người mua</th>
                      <th>Gói</th>
                      <th>Ngày mua</th>
                      <th>Ngày hết hạn</th>
                      <th>Hạn còn</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($list_orders as $item) : ?>
                      <tr>
                        <td><?= $item->id ?></td>
                        <td><a href="<?= admin_url('orders/show/') ?><?= $item->trans_id ?>"><i class="fas fa-file-alt"></i>
                            <?= $item->trans_id ?></b></a></td>
                        <td><?= getNameMemberById($item->buyer_id)->username ?></td>
                        <td><b><?= getNamePackageById($item->package_id)->name ?></b></td>
                        <td><?= display_time($item->created_at) ?></td>
                        <td><?= display_time($item->created_at) ?></td>
                        <td><b><?= daysUntil(date("Y-m-d H:i:s", time()), $item->expired_at) ?></b> ngày.</b></td>
                        <td>
                          <a title="Chi tiết hoá đơn" aria-label="" href="<?= admin_url('orders/show/') ?><?= $item->trans_id ?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                            <i class="fas fa-eye"></i><span class=""> Xem</span>
                          </a>

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
        url: "<?= admin_url('invoices/remove'); ?>",
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
        message: "Bạn có chắc chắn muốn xóa hoá đơn <b>" + id + "</b> - <b>" + name + "</b> không ?",
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