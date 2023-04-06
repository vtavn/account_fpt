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
                    <th style="width: 20%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $bank) { ?>
                    <tr>
                      <td><?= $bank->id; ?></td>
                      <td><?= $bank->name; ?></td>
                      <td><?= $bank->accountNumber; ?></td>
                      <td><?= $bank->accountName; ?></td>
                      <td><a aria-label="" href="<?= admin_url('bank/update/') ?><?= $bank->id ?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                          <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                        </a>
                        <button style="color:white;" onclick="RemoveRow('<?= $bank->id; ?>')" class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
                          <i class="fas fa-trash mr-1"></i><span class="">Delete</span>
                        </button>
                      </td>
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
            <form action="<?= admin_url('bank/create') ?>" method="POST" enctype="multipart/form-data">
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

    function RemoveRow(id) {
      cuteAlert({
        type: "question",
        title: "Xác Nhận Xóa Ngân Hàng",
        message: "Bạn có chắc chắn muốn xóa ngân hàng ID " + id + " không ?",
        confirmText: "Đồng Ý",
        cancelText: "Hủy"
      }).then((e) => {
        if (e) {
          $.ajax({
            url: "<?= admin_url("bank/remove"); ?>",
            method: "POST",
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
                location.reload();
              } else {
                cuteToast({
                  type: "error",
                  title: "Lỗi",
                  message: "Đã xảy ra lỗi khi xoá tài khoản " + id,
                  timer: 5000
                });
                location.reload();
              }
            }
          });
        }
      })
    }
  </script>