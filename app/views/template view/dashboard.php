<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-4">Dashboard</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mb-4">
					<div class="card shadow">
						<div class="card-header text-center py-3">
							<h6 class="m-0 font-weight-bold">Kegiatan Hari Ini (<?= dateId(date('d-m-Y')); ?>)</h6>
						</div>
						<div class="card-body text-center">
								<?php
								if($data['jadwal'] != null):
								foreach ($data['jadwal'] as $jadwal) : 
									$date = $jadwal['tanggal_kegiatan'];
									$timestamp = strtotime($date);
									$tanggal = date('d-m-Y', $timestamp);
									if (date('ymd', $timestamp) == date('ymd')){
										echo '<div class="h6 py-1">'.$jadwal['nama_perusahaan'].' - '.$jadwal['kode_produk'].'</div>';
									}
								endforeach;
								else:
									echo "<div class='h6'>Tidak ada kegiatan hari ini</div>";
								endif;
								?>
						</div>
					</div>
				</div>
				<div class="col-md-4 mb-4">
					<div class="card shadow">
						<div class="card-header text-center py-3">
							<h6 class="m-0 font-weight-bold">Jumlah Produk</h6>
						</div>
						<div class="card-body">
							<h1 class="h2 text-center font-weight-bold">
								<?php foreach ($data['countProduk'] as $countProduk) { echo $countProduk['COUNT(id)']; }; ?>
							</h1>
						</div>
					</div>
				</div>
				<div class="col-md-4 mb-4">
					<div class="card shadow">
						<div class="card-header text-center py-3">
							<h6 class="m-0 font-weight-bold">Jumlah Perusahaan</h6>
						</div>
						<div class="card-body">
							<h1 class="h2 text-center font-weight-bold">
								<?php foreach ($data['countPerusahaan'] as $countPerusahaan) { echo $countPerusahaan['COUNT(id)']; }; ?>
							</h1>
						</div>
					</div>
				</div>
				<div class="col-md-4 mb-4">
					<div class="card shadow">
						<div class="card-header text-center py-3">
							<h6 class="m-0 font-weight-bold">Jumlah Peserta</h6>
						</div>
						<div class="card-body">
							<h1 class="h2 text-center font-weight-bold">
								<?php foreach ($data['countPeserta'] as $countPeserta) { echo $countPeserta['COUNT(id)']; }; ?>
							</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>