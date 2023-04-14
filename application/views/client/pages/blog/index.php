  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
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
    <div class="container">
      <div class="row">
        <section class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <?php foreach ($data as $item) : ?>
                <div class="col-md-12">
                  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                      <strong class="d-inline-block mb-2 text-success"><?= getNameMemberById($item->member_id)->name ?></strong>
                      <h3 class="mb-0"><?= $item->title ?></h3>
                      <div class="mb-1 text-muted"><?= $item->updated_at ?></div>
                      <p class="mb-auto"><?= split_content($item->title, 150) ?>.</p>
                      <a href="<?= base_url() . 'blog/' . create_slug($item->title) . '-' . $item->id . '.html' ?>" class="stretched-link">Xem thêm</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                      <img src="<?= $item->thumb ?>" alt="<?= $item->title ?>" class="img-fluid">

                    </div>
                  </div>
                </div>
              <?php endforeach ?>
              <?php if (!empty($pagination)) : ?>
                <div class="pagination text-center">
                  <?php echo $pagination; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </section>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->