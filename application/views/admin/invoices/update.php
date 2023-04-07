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
              <?php
              $this->load->view('message');
              ?>
              <form action="" method="post">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Payment Method</label>
                          <input type="text" class="form-control" value="<?= $invoice_info->payment_method ?>" placeholder="Phương thức thanh toán." disabled>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Số tiền phải trả</label>
                          <input type="text" class="form-control" value="<?= number_format($invoice_info->amount) ?>đ" placeholder="Giá phải trả" disabled>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Số tiền đã trả</label>
                          <?php if ($invoice_info->amount <= $invoice_info->pay) : ?>
                            <input type="text" class="form-control" value="<?= number_format($invoice_info->amount) ?>đ" disabled>
                          <?php else : ?>
                            <input type="text" class="form-control" value="<?= $invoice_info->amount ?>" name="pay" placeholder="Số tiền đã trả.">
                            <i>* nhập số tiền thành viên đã nạp thành công. Chú ý số tiền này sẽ được cộng vào tài khoản của người dùng.</i>
                          <?php endif ?>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Thời gian tạo</label>
                          <input type="text" class="form-control" value="<?= display_time($invoice_info->created_at) ?>" disabled>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Sửa gần đây</label>
                          <input type="text" class="form-control sale_price" value="<?= display_time($invoice_info->updated_at) ?>" disabled>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Trạng thái</label>
                          <?php if ($invoice_info->amount <= $invoice_info->pay) : ?>
                            <?= display_invoice($invoice_info->status) ?>
                          <?php else : ?>
                            <select class="form-control" name="status">
                              <option value="0" <?= ($invoice_info->status == 0) ? 'selected' : '' ?>>Đang chờ thanh toán</option>
                              <option value="1" <?= ($invoice_info->status == 1) ? 'selected' : '' ?>>Đã thanh toán</option>
                              <option value="2" <?= ($invoice_info->status == 2) ? 'selected' : '' ?>>Đã Huỷ</option>
                            </select>
                          <?php endif ?>
                        </div>
                      </div>

                    </div>
                    <div class="card-footer ">
                      <?php if ($invoice_info->amount <= $invoice_info->pay) : ?>
                        <a href="<?= admin_url('invoices') ?>" class="btn btn-info m-b-10" type="submit">Quay lại</a>
                      <?php else : ?>
                        <button aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Xác nhận</button>

                      <?php endif ?>
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

    <script>
      $(document).ready(function() {
        $(".all-package").change(function() {
          var idPackSelected = $('.all-package').find(":selected").val();
          var name = $('.all-package').find(":selected").data('name');
          var price = $('.all-package').find(":selected").data('price');
          var price_sale = $('.all-package').find(":selected").data('sale');
          $(".name").val(name);
          $(".price").val(price);
          $(".sale_price").val(price_sale);
        });
      });
    </script>