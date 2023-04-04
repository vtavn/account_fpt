  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Thêm gói cước mới</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= admin_url('dashboard') ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active">Thêm gói cước mới</li>
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
              <h5 class="m-0">Thêm gói cước mới</h5>
            </div>
            <?php
            $this->load->view('message');
            ?>
            <form action="<?= admin_url('package/create') ?>" method="post">
              <div class="card-body">
                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tên gói (*)</label>
                      <input type="text" class="form-control" name="name" placeholder="Gói cước 1 tháng..." required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Giá (*)</label>
                      <input type="text" class="form-control" name="price" placeholder="Giá gói..." required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Giá Sale</label>
                      <input type="text" class="form-control" name="sale_price" placeholder="Giá giảm nếu có..." required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Ảnh đại diện</label>
                      <input type="text" class="form-control" name="thumb" required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Mô tả ngắn</label>
                      <textarea name="short_content" id="short_content" cols="30" rows="10" class="form-control" placeholder="Mô tả ngắn..."></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Mô tả</label>
                      <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="Chi tiết gói"></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <select class="form-control" name="status">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="card-footer clearfix">
                  <button aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
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