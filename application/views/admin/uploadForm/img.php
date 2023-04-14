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
        <section class="col-lg-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0"><?= $title ?></h5>
            </div>
            <?php $this->load->view('message'); ?>
            <div class="card-body">
              <p id="msg"></p>
              <label for="link">Link Upload</label>
              <input type="text" id="link" class="form-control mb-2">
              <input type="file" id="file" name="file" />
              <button id="upload" class="btn btn-primary">Upload</button>
            </div>
          </div>
        </section>
        <!-- /.col-md-6 -->
        <section class="col-lg-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">Preview</h5>
            </div>
            <div class="card-body">
              <div id="img"></div>
            </div>
          </div>
        </section>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(e) {
      $('#upload').on('click', function() {
        var file_data = $('#file').prop('files')[0];
        console.log(file_data)
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
          url: '<?= admin_url('uploadimg/upload_file') ?>', // point to server-side controller method
          dataType: 'text', // what to expect back from the server
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(response) {
            $('#link').val(response);
            $('#file').val(null);
            $('#img').html('<img class="img-fluid" src="' + response + '"/>');
          },
          error: function(response) {
            $('#msg').html(response); // display error response from the server
          }
        });
      });
    });
  </script>