	<?php
	if (isset($_SESSION['username']) == 0) {
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
			<div class="row justify-content-end">
				<a href="<?= base_url; ?>" class="btn btn-primary mr-2">Kembali</a>
				<button class="btn btn-primary" onclick="window.print();">Cetak</button>
			</div>
			<form method="post">
				<div class="row pt-4">
					<span class="h2 col-12 text-center">Report Data Perusahaan</span>
					<div class="form-group col-6">
						<label for="bulan" class="form-check-label">Bulan</label>
						<select id="bulan" class="form-control">
							<option value="" disabled selected>--Semua--</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
					</div>
					<div class="form-group col-6">
						<label for="tahun" class="form-check-label">Tahun</label>
						<select id="tahun" class="form-control">
							<option value="" disabled selected>--Semua--</option>
							<?php for ($i = $data['first_year']['tahun']; $i <= $data['last_year']['tahun']; $i++) : ?>
								<option value="<?= $i; ?>"><?= $i; ?></option>
							<?php endfor ?>
						</select>
					</div>
					<div class="col-12">
						<div class="row justify-content-end">
							<div class="col-1">
								<input type="submit" value="Filter" class="btn bg-secondary btn-sm btn-block text-white">
							</div>
						</div>
					</div>
				</div>
			</form>
			<hr>
		</div>
		<?php if(count($data['produk']) != 0): ?>
		<div class="container-fluid" style="max-width: 287mm; padding: 3cm;">
			<div class="row">
				<div class="col-2 px-3">
					<img src="<?= base_url; ?>assets/images/sysindo.png" class="img-responsive p-4" style="max-width: 150px;">
				</div>
				<div class="col-10 pt-4">
					<p class="text-center h2">PT. Synergi Sukses Solusindo</p>
					<p class="text-center h6">Jl. Dr. Semeru No 29 C, Perintis Kemerdekaan, Bogor Tengah, Bogor, Indonesia 16125.</p>
				</div>
			</div>
			<form method="post">
			</form>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr align="center">
						<th>No</th>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Jumlah Perusahaan Yang Melakukan Sertifikasi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;setlocale(LC_ALL, 'id');
					foreach ($data['produk'] as $produk) :
					?>
						<tr>
							<td align="center"><?= $no++; ?>.</td>
							<td><?= $produk['kode_produk']; ?></td>
							<td><?= $produk['nama_produk']; ?></td>
							<td align="center"><?= $produk['total']; ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<?php else: ?>
			<div class="text-center font-weight-bold">Tidak Ada Rekap Data</div>
		<?php endif; ?>
		</div>
		<style type="text/css" media="print">
			@page {
				size: portrait;
			}
		</style>
		<script src="<?= base_url; ?>assets/vendor/jquery.min.js"></script>
		<script src="<?= base_url; ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
		<script src="<?= base_url; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?= base_url; ?>assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="<?= base_url; ?>assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?= base_url; ?>assets/js/javascript.js"></script>
		<script>
			$('#bulan').on('change', function () {
				$('#bulan').attr('name', 'bulan');
			});
			$('#tahun').on('change', function () {
				$('#tahun').attr('name', 'tahun');
			});
		</script>
	</body>