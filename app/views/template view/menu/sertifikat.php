<?php
if (isset($_SESSION['username']) == 0){
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
	<link rel="stylesheet" href="<?= base_url; ?>assets/css/style.css">
</head>
<body>
	<div class="container py-3 d-print-none">
		<button class="btn btn-primary btn-block" onclick="window.print();">Cetak</button>
		<hr>
	</div>
	<div class="container-fluid p-1 sertifikat-background" style="border-style: solid; border-color: black; max-width: 287mm; min-height: 195mm;">
		<div class="container-fluid text-center" style="border-style: dashed; border-color: black; max-width: 287mm; min-height: 192mm;">
			<div class="mt-5 h1 font-weight-bold">Certificate Accomplishment</div>
			<div class="h4 font-weight-normal">This certificate is presented to:</div>
			<div class="mt-5 h2 font-weight-bold"><?= $data['pesertaById']['nama_peserta']; ?></div>
			<div class="mx-4">
				<div class="mx-5">
					<hr class="m-0 border-dark border mx-5" style="border: 2px solid !important;">
				</div>
			</div>
			<div class="h5 font-weight-normal">Who has successfully completed awareness & Internal Auditor Training</div>
			<div class="h3 font-weight-bold pt-4"><?= $data['pesertaById']['kode_produk']; ?></div>
			<div class="h3 font-weight-normal"><?= $data['pesertaById']['nama_produk']; ?></div>
			<div class="h3 font-weight-bold pt-3 pb-5"><?= $data['pesertaById']['nama_perusahaan']; ?></div>
			<div class="row pl-4 pt-2">
				<div class="col-5 pt-5">
					<div class="h6 text-left pt-5">Organized by:</div>
					<div class="row">
						<div class="col-3">
							<img src="<?= base_url; ?>assets/images/sysindo.png" height="50px">
						</div>
						<div class="col-9">
							<div class="h6">Sysindo Konsultan</div>
							<hr class="p-0 m-0 border-dark">
							<div class="h6">PT. Sinergy Sukses Solusindo</div>
						</div>
						<div class="col-12 pt-2">
							<div class="h6 font-weight-bold text-left">NO: GYSS/TR/<?= date('y'); ?>/<?= dateRomawi(date('d-m-y')); ?>/<?= $data['pesertaById']['nomor_sertifikat']; ?></div>
						</div>
					</div>
				</div>
				<div class="col-3">
				</div>
				<div class="col-4 pt-5">
					<div class="text-white"><?php $tanggal = $data['pesertaById']['tanggal_kegiatan']; $timestamp = strtotime($tanggal); ?><?= date('F, j<\s\up>S</\s\up> ', $timestamp).date('Y', $timestamp); ?></div>
					<div class="p-5"></div>
					<?php foreach ($data['sertifikat'] as $sertifikat) : ?>
						<div class="h6 font-weight-bold text-white"><?= $sertifikat['penandatangan']; ?></div>
						<hr class="m-0 mx-5" style="border: 1px solid #fff !important;">
						<div class="h6 font-weight-normal text-white"><?= $sertifikat['jabatan']; ?></div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css" media="print">
		@page { size: landscape; }
	</style>
	<script src="<?= base_url; ?>assets/vendor/jquery.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url; ?>assets/js/javascript.js"></script>
</body>