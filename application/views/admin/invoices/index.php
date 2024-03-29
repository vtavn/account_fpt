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
              <a class="btn btn-success mb-2" href="<?= admin_url('invoices') ?>?type=withdraw_money"><i class="fas fa-funnel-dollar"></i>
                Danh sách rút tiền
              </a>
              <form method="get" action="<?= admin_url('invoices') ?>" class="mb-2">
                <div class="row">
                  <select class="form-control  col-sm-2 mb-2" name="type">
                    <option value="">Loại hoá đơn</option>
                    <option value="deposit_money" <?= (getValueinGet('type') == 'deposit_money') ? 'selected' : '' ?>>Nạp Tiền</option>
                    <option value="withdraw_money" <?= (getValueinGet('type') == 'withdraw_money') ? 'selected' : '' ?>>Rút Tiền</option>
                  </select>

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
                    <option value="pending" <?= (getValueinGet('status') == 'pending') ? 'selected' : '' ?>>Đang chờ thanh toán</option>
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
                      <th>Username</th>
                      <th>Mã giao dịch</th>
                      <th>Phương thức thanh toán</th>
                      <th>Số tiền</th>
                      <th>Đã thanh toán</th>
                      <th>Trạng thái</th>
                      <th>Tạo lúc</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $item) : ?>
                      <tr>
                        <td><?= $item->id ?></td>
                        <td><a href="<?= admin_url('member/update/') ?><?= $item->member_id ?>" target="_blank"><?= getNameMemberById($item->member_id)->username ?></a></td>
                        <td><a href="<?= base_url('payment/invoice/') ?><?= $item->trans_id ?>"><i class="fas fa-file-alt"></i>
                            <?= $item->trans_id ?></b></a></td>
                        <td><b><?= $item->payment_method ?></b></td>
                        <td><b style="color: red;"><?= number_format($item->amount) ?>đ</b></td>
                        <td><b style="color: green;"><?= number_format($item->pay) ?>đ</b></td>
                        <td><?= display_invoice($item->status) ?></td>
                        <td><?= display_time($item->created_at) ?></td>
                        <td>
                          <?php if ($item->status == '0') : ?>
                            <a aria-label="" href="<?= admin_url('invoices/update') ?>/<?= $item->id ?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                              <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                            </a>
                          <?php endif; ?>
                          <button style="color:white;" onclick="RemovePackage(<?= $item->id; ?>,'<?= $item->trans_id ?>')" class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
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