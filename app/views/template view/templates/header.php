<?php
	if ($_SESSION['level'] != 'Admin'){
		header('location: ' . base_url);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $data['title']; ?></title>
	<link rel="icon" href="<?= base_url; ?>assets/images/favicon.ico" type="image/gif">
	<link rel="stylesheet" href="<?= base_url; ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>assets/vendor/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>assets/vendor/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>assets/vendor/datepicker/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>assets/css/style.css">
</head>
<body class="main-background">