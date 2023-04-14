<div class="container">
  <div class="row pt-3">
    <div class="col-lg-12">
      <div class="card p-3 posts-detail">
        <h1><?= $post_info->title ?></h1>
        <p>Tác giả: <b><?= getNameMemberById($post_info->member_id)->name ?></b> - Đăng lúc: <?= thoigiantinh($post_info->title) ?></p>
        <div class="content mt-3">
          <?= $post_info->content ?>

          <p class="d-flex justify-content-center rounded"><img src="<?= $post_info->thumb ?>" alt="<?= $post_info->title ?>" class="img-fluid rounded"></p>

          <a href="<?= base_url('blog') ?>" class="btn btn-buy-auto">Xem thêm bài viết khác</a>
        </div>

      </div>
    </div>

    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->