  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= ctv_url('dashboard') ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="content">
    <div class="container-fluid">
      <?php $this->load->view('message'); ?>
      <div class="row">
        <section class="col-lg-7 connectedSortable">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-university mr-1"></i>
                THÔNG TIN THANH TOÁN NGÂN HÀNG & VÍ ĐIỆN TỬ
              </h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 5%">ID</th>
                    <th>ShortName</th>
                    <th>Account Number</th>
                    <th>Account Name</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($data as $bank) { ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $bank->name; ?></td>
                      <td><?= $bank->accountNumber; ?></td>
                      <td><?= $bank->accountName; ?></td>
                      <td><?= display_status($bank->status); ?></td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
        <section class="col-lg-5 connectedSortable">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-university mr-1"></i>
                THÊM NGÂN HÀNG
              </h3>
            </div>
            <form action="<?= ctv_url('bank/create') ?>" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Ngân hàng</label>
                  <select class="form-control select2bs4" name="name" required>
                    <option value="">Chọn ngân hàng</option>
                    <?php foreach ($listBankDefault as $key => $value) { ?>
                      <option value="<?= $key; ?>"><?= $value; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Image</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="thumb" required>
                        <div class="input-group-append">
                          <span class="input-group-text">Link</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Số tài khoản</label>
                  <input type="text" class="form-control" name="accountNumber" placeholder="Nhập số tài khoản" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên chủ tài khoản</label>
                  <input type="text" class="form-control" name="accountName" placeholder="Nhập tên chủ tài khoản" required>
                </div>
              </div>
              <div class="card-footer clearfix">
                <button class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-plus mr-1"></i>Thêm Ngay</button>
              </div>
            </form>
          </div>
        </section>

      </div>
    </div>
  </div>

  <script>
    $(function() {
      $(".select2").select2()
      $(".select2bs4").select2({
        theme: "bootstrap4"
      });
    });
  </script>