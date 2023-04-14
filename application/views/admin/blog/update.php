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
              <h5 class="m-0">Sửa: <?= $post_info->title ?></h5>
            </div>
            <?php
            $this->load->view('message');
            ?>
            <form action="" method="post">
              <div class="card-body">
                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tiêu đề</label>
                      <input type="text" class="form-control" name="title" placeholder="Tiêu đề bài viết" required value="<?= $post_info->title ?>">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Ảnh đại diện <a href="<?= admin_url('imagemanager') ?>" target="_blank">Upload Ảnh</a></label>
                      <input type="text" class="form-control" name="thumb" placeholder="Ảnh đại diện" required value="<?= $post_info->thumb ?>">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nội dung bài viết</label>
                      <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="Nội dung bài viết"><?= $post_info->content ?></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <select class="form-control" name="status">
                        <option value="1" <?= ($post_info->status == 1) ? 'selected' : '' ?>>Đăng bài</option>
                        <option value="0" <?= ($post_info->status == 0) ? 'selected' : '' ?>>Ẩn</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="card-footer clearfix">
                  <button aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Sửa bài</button>
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
      CKEDITOR.replace('content');
    });
  </script>