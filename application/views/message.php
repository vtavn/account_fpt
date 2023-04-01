<?php if ((isset($message) && $message) || (isset($_SESSION['item']) && $_SESSION['item'])) : ?>
  <div class="message">
    <p><strong></strong><?php echo $message; ?></p>
  </div>
<?php endif; ?>

<!--success message -->
<?php if ($this->session->flashdata('success')) { ?>
  <p style="color:green"><?php echo $this->session->flashdata('success'); ?></p>
<?php } ?>

<!--error message -->
<?php if ($this->session->flashdata('error')) { ?>
  <p style="color:red"><?php echo $this->session->flashdata('error'); ?></p>
<?php } ?>