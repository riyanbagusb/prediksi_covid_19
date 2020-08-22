<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-2"><?= $data['jadwal']['nama_kegiatan']; ?></h1>
					<p class="mb-4"><?php $date = $data['jadwal']['tanggal_pelaksanaan']; $timestamp = strtotime($date); $tanggal = date('d-m-Y', $timestamp); echo dateId($tanggal); ?>.</p>
				</div>
				<div class="col-md-2 align-self-end mb-4 d-flex justify-content-end">
					<a href="#" class="modalTambahPerusahaan" data-toggle="modal" data-target="#modalPerusahaan"><button class="btn btn-primary">Tambah</button></a>
				</div>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold"><?= $data['jadwal']['nama_kegiatan']; ?></h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered duaKolom" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>Nama Perusahaan</th>
									<th>Nama Perusahaan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($data['perusahaanByJadwal'] as $perusahaanByJadwal) : ?>
									<tr>
										<td align="center"><?= $no++; ?>.</td>
										<td><a href="<?= base_url ?>admin/detail_jadwal/<?= $perusahaanByJadwal['id']; ?>" class="text-dark"><?= $perusahaanByJadwal['nama_perusahaan']; ?></a></td>
										<td><?= $perusahaanByJadwal['kode_perusahaan']; ?></td>
										<td align="center">
											<a href="<?= base_url ?>admin/detail_jadwal/<?= $perusahaanByJadwal['id']; ?>"><badge class="badge badge-primary mb-1">Detail</badge></a>
											<a href="<?= base_url ?>admin/ubah_perusahaan/<?= $perusahaanByJadwal['id']; ?>" data-toggle="modal" data-target="#modalPerusahaan"><badge class="badge badge-warning text-white mb-1 modalUbahPerusahaan" data-id="<?= $perusahaanByJadwal['id']; ?>">Ubah</badge></a>
											<a class="badge badge-danger mb-1 modalHapusPerusahaan" href="<?= base_url ?>admin/hapus_perusahaan/<?= $perusahaanByJadwal['id']; ?>">Hapus</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalPerusahaan" tabindex="-1" role="dialog" aria-labelledby="modalDetailProduk" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalDetailProdukLabel">Tambah Perusahaan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url; ?>admin/tambah_perusahaan" method="post">
						<input type="hidden" id="id" name="id">
						<div class="modal-body">
							<div class="form-group">
								<label for="kode_perusahaan">Kode Perusahaan</label>
								<input type="text" class="form-control" id="kode_perusahaan" name="kode_perusahaan">
							</div>
							<div class="form-group">
								<label for="nama_perusahaan">Nama Perusahaan</label>
								<input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn text-white" data-dismiss="modal">Keluar</button>
							<button type="submit" class="btn btn-primary">Tambah</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>