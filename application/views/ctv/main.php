<?php
$this->load->view('ctv/partials/header', $this->data);
$this->load->view('ctv/partials/sidebar');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php $this->load->view($temp, $this->data); ?>
</div>
<!-- /.content-wrapper -->
<?php
$this->load->view('ctv/partials/footer');
?>