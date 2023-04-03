<?php if ((isset($message) && $message) || (isset($_SESSION['item']) && $_SESSION['item'])) : ?>
  <div class="message">
    <p><strong></strong><?php echo $message; ?></p>
  </div>
<?php endif; ?>

<!--success message -->
<?php if ($this->session->flashdata('success')) { ?>
  <div class="m-3 alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php } ?>

<!--error message -->
<?php if ($this->session->flashdata('error')) { ?>
  <div class="m-3 alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
<?php } ?>