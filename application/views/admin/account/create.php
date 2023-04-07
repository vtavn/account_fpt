  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Thêm tài khoản mới</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= admin_url('dashboard') ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active">Thêm tài khoản mới</li>
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
              <h5 class="m-0">Thêm tài khoản mới</h5>
            </div>
            <?php
            $this->load->view('message');
            ?>
            <form action="<?= admin_url('account/create') ?>" method="post">
              <div class="card-body">
                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Gói</label>
                      <select class="form-control all-package" name="package_id">
                        <option value="">Chọn gói</option>
                        <?php foreach ($all_packages as $pack) : ?>
                          <option value="<?= $pack->id ?>" data-name="<?= $pack->name ?>" data-price="<?= $pack->price ?>" data-sale="<?= $pack->sale_price ?>" data-duration="<?= $pack->duration ?>"><?= $pack->name ?></option>
                        <?php endforeach ?>
                      </select>
                      <?= (form_error('package_id')) ? form_error('package_id', "<p style='color:red'>", "</p>") : '' ?>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tên tài khoản</label>
                      <input type="text" class="form-control name" name="name" placeholder="Mặc định sẽ lấy theo tên gói.">
                      <i>* tên tài khoản sẽ được tự động tạo theo tên gói chọn.</i>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Thời hạn (*)</label>
                      <input type="text" class="form-control duration" name="duration" placeholder="Thời hạn..." required>
                      <i>* bỏ trống thời hạn sẽ được tự động lấy theo gói đã chọn.</i>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Giá (*)</label>
                      <input type="text" class="form-control price" name="price" placeholder="Giá gói..." required>
                      <i>* bỏ trống giá gói sẽ được tự động lấy theo gói đã chọn.</i>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Giá Sale</label>
                      <input type="text" class="form-control sale_price" name="sale_price" placeholder="Giá giảm nếu có...">
                      <i>* bỏ trống giá sale sẽ được tự động lấy theo gói đã chọn.</i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tài khoản: (phone|pass)</label>
                      <textarea name="account" id="account" cols="30" rows="10" class="form-control" placeholder="phone|pass"></textarea>
                      <i>* 1 dòng cho 1 tài khoản</i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <select class="form-control" name="status">
                        <option value="1">Đang Bán</option>
                        <option value="2">Hết Hàng</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="card-footer clearfix">
                  <button aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Thêm tài khoản</button>
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
        var duration = $('.all-package').find(":selected").data('duration');
        $(".name").val(name);
        $(".price").val(price);
        $(".sale_price").val(price_sale);
        $(".duration").val(duration);
      });
    });
  </script>