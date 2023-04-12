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
            <li class="breadcrumb-item"><a href="<?= ctv_url('dashboard') ?>">Trang chủ</a></li>
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
              <div class="card-body">
                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Bank</label>
                      <select class="form-control list-bank" name="bank-id" id="bank-id">
                        <option value="">Chọn phương thức nhận tiền</option>
                        <?php foreach ($data as $pack) : ?>
                          <option value="<?= $pack->id ?>"><?= $pack->name ?> - <?= $pack->accountName ?> - <?= $pack->accountNumber ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Số tiền rút:</label>
                      <input type="number" name="amount" id="amount" class="form-control" placeholder="Số tiền rút">
                      <i>* nhập đúng số tiền rút và chú ý tài khoản nhận tiền.</i>
                    </div>
                  </div>
                </div>
                <div class="card-footer clearfix">
                  <button id="btnWithdrawOrder" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Tạo hoá đơn</button>
                </div>
              </div>
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

<script>
  $(document).ready(function() {
    $("#btnWithdrawOrder").on("click", function() {
      $('#btnWithdrawOrder').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop(
        'disabled',
        true);
      $.ajax({
        url: "<?= ctv_url('payment/create') ?>",
        method: "POST",
        dataType: "JSON",
        data: {
          type: $("#bank-id").val(),
          amount: $("#amount").val(),
        },
        success: function(respone) {
          if (respone.status == 'success') {
            cuteToast({
              type: "success",
              title: "Thành Công",
              message: respone.msg,
              timer: 5000
            });
            setTimeout("location.href = '<?= ctv_url('payment') ?>'", 500);
          } else {
            Swal.fire(
              'Thất bại',
              respone.msg,
              'error'
            );
          }
          $('#btnWithdrawOrder').html('Tạo hoá đơn').prop('disabled', false);
        },
        error: function() {
          cuteToast({
            type: "success",
            title: "Thất bại",
            message: 'Không thể xử lý',
            timer: 5000
          });
          $('#btnWithdrawOrder').html('Tạo hoá đơn').prop('disabled', false);
        }

      });
    });
  });
</script>