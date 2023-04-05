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
            <li class="breadcrumb-item active">Sửa gói cước</li>
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
              <h5 class="m-0">Sửa gói cước</h5>
            </div>
            <?php $this->load->view('message'); ?>
            <form action="" method="post">
              <div class="card-body">
                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tên gói (*)</label>
                      <input type="text" class="form-control" name="name" value="<?= $package_info->name ?>" placeholder="Gói cước 1 tháng..." required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Giá (*)</label>
                      <input type="text" class="form-control" name="price" value="<?= $package_info->price ?>" placeholder="Giá gói..." required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Giá Sale</label>
                      <input type="text" class="form-control" name="sale_price" value="<?= $package_info->sale_price ?>" placeholder="Giá giảm nếu có...">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Ảnh đại diện</label>
                      <input type="text" class="form-control" name="thumb" value="<?= $package_info->thumb ?>" required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Mô tả ngắn</label>
                      <textarea name="short_content" id="short_content" cols="30" rows="10" class="form-control" placeholder="Mô tả ngắn..."><?= $package_info->short_content ?></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Mô tả</label>
                      <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="Chi tiết gói"><?= $package_info->content ?></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <select class="form-control" name="status">
                        <option value="1" <?= ($package_info->status == 1) ? 'selected' : '' ?>>Hiển thị</option>
                        <option value="0" <?= ($package_info->status == 0) ? 'selected' : '' ?>>Ẩn</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="card-footer clearfix">
                  <button aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu</button>
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