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
              <p>Chọn 1 trong những ngân hàng phía dưới để nạp tiền.</p>
              <div class="row">
                <?php foreach ($list_banks as $bank) { ?>
                  <div class="shadow col-sm-6 col-md-6 col-lg-3 mt-3 mt-lg-0 mb-3">
                    <div type="button" onclick="openModalAmount(<?= $bank->id; ?>)" class="blur-shadow p-4 shadow-showcase text-center">
                      <img src="<?= $bank->thumb; ?>" width="200px" height="150px">
                    </div>
                  </div>
                <?php } ?>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nhập số tiền cần nạp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <input type="hidden" id="token" value="<?= $my_info->token; ?>" required>
          <input type="hidden" id="bank-id" required>
          <input type="number" id="amount" onchange="totalRecharge()" onkeyup="totalRecharge()" placeholder="Nhập số tiền bạn cần nạp vào hệ thống" class="form-control" required>
        </div>
        <p>
          <span class="float-left">Số tiền cần thanh toán<br><br><b id="payment" style="color: blue;">0</b></span>
          <span class="float-right">Số tiền nhận được<br><br><b id="received" style="color: red;">0</b></span>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" id="btnDepositOrder" class="btn btn-primary">Tạo hoá đơn</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function openModalAmount(id) {
    $("#bank-id").val(id);
    $("#exampleModal").modal();
  }

  function totalRecharge() {
    $('#total').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...');
    $("#received").html($("#amount").val().toString().replace(/(.)(?=(\d{3})+$)/g, '$1.'));
    $("#payment").html($("#amount").val().toString().replace(/(.)(?=(\d{3})+$)/g, '$1.'));
  }

  $("#btnDepositOrder").on("click", function() {
    $('#btnDepositOrder').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop(
      'disabled',
      true);
    $.ajax({
      url: "<?= base_url('payment/create') ?>",
      method: "POST",
      dataType: "JSON",
      data: {
        type: $("#bank-id").val(),
        amount: $("#amount").val(),
        token: $("#token").val()
      },
      success: function(respone) {
        if (respone.status == 'success') {
          cuteToast({
            type: "success",
            title: "Thành Công",
            message: respone.msg,
            timer: 5000
          });
          console.log('loadding');
          setTimeout("location.href = '<?= base_url('payment/invoice/') ?>" + respone.trans_id + "'", 500);
        } else {
          Swal.fire(
            'Thất bại',
            respone.msg,
            'error'
          );
        }
        $('#btnDepositOrder').html('Tạo hoá đơn').prop('disabled', false);
      },
      error: function() {
        cuteToast({
          type: "success",
          title: "Thất bại",
          message: 'Không thể xử lý',
          timer: 5000
        });
        $('#btnDepositOrder').html('Tạo hoá đơn').prop('disabled', false);
      }

    });
  });
</script>