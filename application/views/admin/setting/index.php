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
            <?php $this->load->view('message'); ?>
            <div class="card-body">
              <form action="" method="post">
                <div class="row">
                  <?php
                  foreach ($data as $setting) :
                  ?>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label><?= $setting->name ?>:</label>
                        <?php if ($setting->textbox == 1) {
                        ?>
                          <textarea name="<?= $setting->name ?>" id="<?= $setting->name ?>" cols="20" rows="6" class="form-control"><?= $setting->value ?></textarea>
                        <?php } else { ?>
                          <input type="text" class="form-control" name="<?= $setting->name ?>" value="<?= $setting->value ?>" placeholder="<?= $setting->name ?>">
                        <?php } ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  <div class="card-footer clearfix">
                    <button aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu lại</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

  <script type="text/javascript">
    function postRemove(id) {
      $.ajax({
        url: "<?= admin_url('menu/remove'); ?>",
        type: 'POST',
        dataType: "JSON",
        data: {
          id: id
        },
        success: function(response) {
          if (response.status == 'success') {
            cuteToast({
              type: "success",
              title: "Thành Công",
              message: "Đã xóa thành công " + id,
              timer: 3000
            });
          } else {
            cuteToast({
              type: "error",
              title: "Lỗi",
              message: "Đã xảy ra lỗi khi xoá " + id,
              timer: 5000
            });
          }
        }
      });
    }

    function RemoveMenu(id, name) {
      cuteAlert({
        type: "question",
        title: "CẢNH BÁO",
        message: "Bạn có chắc chắn muốn xóa <b>" + id + "</b> - <b>" + name + "</b> không ?",
        confirmText: "Đồng Ý",
        cancelText: "Hủy"
      }).then((e) => {
        if (e) {
          postRemove(id)
          location.reload()
        }
      })
    }
  </script>
  </script>