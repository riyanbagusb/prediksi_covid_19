<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-2"><?= $data['produk']['kode_produk']; ?></h1>
					<p class="mb-4"><?= $data['produk']['nama_produk']; ?>.</p>
				</div>
				<div class="col-md-2 align-self-end mb-4 d-flex justify-content-end">
					<a href="#" class="modalTambahJadwal" data-toggle="modal" data-target="#modalJadwal"><button class="btn btn-primary">Tambah</button></a>
				</div>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold"><?= $data['produk']['kode_produk']; ?></h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered duaKolom" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>Tanggal</th>
									<th>Kegiatan</th>
									<th>Perusahaan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($data['perusahaanByProduk'] as $perusahaanByProduk) : ?>
									<tr>
										<td align="center"><?= $no++; ?>.</td>
										<td><a href="<?= base_url ?>admin/detail_perusahaan/<?= $perusahaanByProduk['id']; ?>" class="text-dark"><?= $perusahaanByProduk['nama_perusahaan']; ?></a></td>
										<td><?= $perusahaanByProduk['nama_produk']; ?></td>
										<td align="center">
											<a href="<?= base_url ?>admin/detail_perusahaan/<?= $perusahaanByProduk['id']; ?>"><badge class="badge badge-primary mb-1">Detail</badge></a>
											<a href="<?= base_url ?>admin/ubah_perusahaan/<?= $perusahaanByProduk['id']; ?>" data-toggle="modal" data-target="#modalPerusahaan"><badge class="badge badge-warning text-white mb-1 modalUbahPerusahaan" data-id="<?= $perusahaanByProduk['id']; ?>">Ubah</badge></a>
											<a class="badge badge-danger mb-1 modalHapusPerusahaan" href="<?= base_url ?>admin/hapus_perusahaan/<?= $perusahaanByProduk['id']; ?>">Hapus</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalJadwal" tabindex="-1" role="dialog" aria-labelledby="modalDetailJadwal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalDetailJadwal">Tambah Perusahaan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url; ?>admin/tambah_perusahaan_produk/<?= $data['produk']['id']?>" method="post">
						<input type="hidden" id="id" name="id">
						<div class="modal-body">
							<div class="form-group">
								<label for="nama_perusahaan">Nama Perusahaan</label>
								<input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan">
							</div>
							<div class="form-group">
								<label for="kode_produk">Produk</label>
								<select id="kode_produk" name="kode_produk" class="form-control">
									<option value="<?= $data['produk']['id']; ?>" selected><?= $data['produk']['kode_produk']; ?></option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Tambah</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>