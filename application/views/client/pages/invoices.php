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
            <div class="card-header">
              <h5 class="m-0"><?= $title ?></h5>
            </div>
            <div class="card-body">
              <div class="table-responsive p-0">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
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
                    <?php foreach ($list_invoices as $item) : ?>
                      <tr>
                        <td><?= $item->id ?></td>
                        <td><a href="<?= base_url('payment/invoice/') ?><?= $item->trans_id ?>"><i class="fas fa-file-alt"></i>
                            <?= $item->trans_id ?></b></a></td>
                        <td><b><?= $item->payment_method ?></b></td>
                        <td><b style="color: red;"><?= number_format($item->amount) ?>đ</b></td>
                        <td><b style="color: green;"><?= number_format($item->pay) ?>đ</b></td>
                        <td><?= display_invoice($item->status) ?></td>
                        <td><?= display_time($item->created_at) ?></td>
                        <td>
                          <a title="Chi tiết hoá đơn" target="_blank" aria-label="" href="<?= base_url('payment/invoice/') ?><?= $item->trans_id ?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
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
      </div>
      </section>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>