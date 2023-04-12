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
                    <div class="form-group">
                      <label>Gói</label>
                      <select class="form-control all-package" name="package_id">
                        <option value="">Chọn gói</option>
                        <?php foreach ($all_packages as $pack) : ?>
                          <option value="<?= $pack->id ?>" data-name="<?= $pack->name ?>" data-price="<?= $pack->price ?>" data-sale="<?= $pack->sale_price ?>" <?= ($account_info->package_id == $pack->id) ? 'selected' : '' ?>><?= $pack->name ?></option>
                        <?php endforeach ?>
                      </select>
                      <?= (form_error('package_id')) ? form_error('package_id', "<p style='color:red'>", "</p>") : '' ?>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tên tài khoản</label>
                      <input type="text" class="form-control name" name="name" value="<?= $account_info->name ?>" placeholder="Mặc định sẽ lấy theo tên gói.">
                      <i>* tên tài khoản sẽ được tự động tạo theo tên gói chọn.</i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Giá (*)</label>
                      <input type="text" class="form-control price" name="price" value="<?= $account_info->price ?>" placeholder="Giá gói..." required>
                      <i>* bỏ trống giá gói sẽ được tự động lấy theo gói đã chọn.</i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Giá Sale</label>
                      <input type="text" class="form-control sale_price" value="<?= $account_info->sale_price ?>" name="sale_price" placeholder="Giá giảm nếu có...">
                      <i>* bỏ trống giá sale sẽ được tự động lấy theo gói đã chọn.</i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tài khoản: (phone|pass)</label>
                      <input type="text" class="form-control" name="account" value="<?= $account_info->account ?>">
                      <i>* chỉ điền duy nhất 1 tài khoản</i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <select class="form-control" name="status">
                        <option value="1" <?= ($account_info->status == 1) ? 'selected' : '' ?>>Đang Bán</option>
                        <option value="2" <?= ($account_info->status == 2) ? 'selected' : '' ?>>Hết Hàng</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="card-footer clearfix">
                  <button aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu lại</button>
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