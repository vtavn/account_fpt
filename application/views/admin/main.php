<?php
$this->load->view('admin/partials/header', $this->data);
$this->load->view('admin/partials/sidebar');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php $this->load->view($temp, $this->data); ?>
</div>
<!-- /.content-wrapper -->
<?php
$this->load->view('admin/partials/footer');
?>