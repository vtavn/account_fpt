<div class="modal fade" id="modalBuy" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content" style="background-image:url('https://i.ibb.co/VgrDF4K/bg-buy.png');">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xác nhận mua tài khoản</h5>
        <button type="button" class="close" style="color: red;" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-window-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-3">
          <label>Tên gói:</label>
          <input type="text" class="form-control" id="name" readonly />
        </div>
        <div class="form-group mb-3">
          <input type="hidden" value="" readonly class="form-control" id="account-id">
          <input class="form-control" type="hidden" id="token" value="<?= (isset($my_info)) ? $my_info->token : '' ?>">
        </div>
        <div class="mb-3 text-center" style="font-size: 20px;"><?= ('Tổng tiền cần thanh toán'); ?>: <b id="total" style="color:red;">0</b></div>
        <div class="text-center mb-3">
          <button type="submit" id="btnBuy" onclick="buyProduct()" class="btn btn-primary btn-block"><i class="fas fa-credit-card mr-1"></i><?= ('Thanh Toán'); ?></span></button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function modalBuy(id, name) {
    $("#account-id").val(id);
    $("#name").val(name);
    $("#modalBuy").modal();
    totalPayment();
  }

  function totalPayment() {
    $('#total').html('<i class="fa fa-spinner fa-spin"></i> <?= ('Đang xử lý...'); ?>');
    $.ajax({
      url: "<?= base_url('payment/totalPayment') ?>",
      method: "POST",
      data: {
        id: $("#account-id").val(),
        token: $("#token").val(),
        type: 'account'
      },
      success: function(data) {
        $("#total").html(data);
      },
      error: function() {
        cuteToast({
          type: "error",
          message: 'Không thể tính kết quả thanh toán',
          timer: 5000
        });
      }
    });
  }

  function buyProduct() {
    var id = $("#account-id").val();
    var token = $("#token").val();
    $('#btnBuy').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled', true);
    $.ajax({
      url: "<?= base_url("payment/buyProduct"); ?>",
      method: "POST",
      dataType: "JSON",
      data: {
        token: token,
        id: id
      },
      success: function(data) {
        $('#btnBuy').html('<i class="fas fa-credit-card mr-1"></i> Thanh Toán').prop(
          'disabled', false);
        if (data.status == 'success') {
          cuteToast({
            title: 'Thành công',
            type: "success",
            message: data.msg,
            timer: 5000
          });
          $urlReturn = '<?= base_url('orders/show/'); ?>' + data.trans_id;
          setTimeout("location.href = '" + $urlReturn + "';", 1000);
        } else {
          Swal.fire({
            title: 'Thất bại',
            html: data.msg,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK!'
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = data.url;
            }
          })
        }
      },
      error: function() {
        $('#btnBuy').html('<i class="fas fa-credit-card mr-1"></i> Thanh Toán').prop(
          'disabled', false);
        cuteToast({
          type: "error",
          title: 'Lỗi',
          message: 'Không thể xử lý',
          timer: 5000
        });
      }
    });
  }
</script>