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
                      <label>Tên:</label>
                      <input type="text" class="form-control name" name="name" value="<?= $menu_info->name ?>" placeholder="Tên để nhận biết.">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Link:</label>
                      <input type="text" class="form-control" name="link" value="<?= $menu_info->link ?>" placeholder="Link khi click vào.">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Cha</label>
                      <select class="form-control" name="parent_id">
                        <option value="0">Cha</option>
                        <?php showCategories($listMenu, $menu_info->parent_id, $menu_info->id) ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <select class="form-control" name="status">
                        <option value="1" <?= ($menu_info->status == 1) ? 'selected' : '' ?>>Hiển thị</option>
                        <option value="0" <?= ($menu_info->status == 0) ? 'selected' : '' ?>>Ẩn</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Ưu tiên:</label>
                      <input type="number" class="form-control" value="<?= $menu_info->position ?>" name="position" placeholder="Ưu tiên hiển thị.">
                      <i>* Giá trị số càng cao thì hiển thị hàng đầu.</i>
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