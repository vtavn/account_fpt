<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Hello</title>
</head>

<body>
	<?php
	echo ($this->session->userdata('uid'));
	echo '<br>';
	echo ($this->session->userdata('urole'));
	?>
	<?php if (is_admin()) : ?>
		<br><a href="<?= base_url('admin/dashboard') ?>">Administrator</a>
	<?php endif ?>

	<?php if (is_login()) : ?>
		<br><a href="<?= base_url('auth/logout') ?>">Logout</a>
	<?php endif ?>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.</p>
</body>

</html>