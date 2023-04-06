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
                      <label>Tên banner:</label>
                      <input type="text" class="form-control name" name="name" value="<?= $banner_info->name ?>" placeholder=" Tên để nhận biết.">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Link:</label>
                      <input type="text" class="form-control" name="link" value="<?= $banner_info->link ?>" placeholder="Link khi click vào banner.">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Ảnh (Ưu tiên kích thước: 2048x560):</label>
                      <input type="text" class="form-control" name="thumb" value="<?= $banner_info->thumb ?>" placeholder="Link ảnh...">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <select class="form-control" name="status">
                        <option value="1" <?= ($banner_info->status == 1) ? 'selected' : '' ?>>Hiển thị</option>
                        <option value="0" <?= ($banner_info->status == 0) ? 'selected' : '' ?>>Ẩn</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="card-footer clearfix">
                  <button aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Sửa</button>
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