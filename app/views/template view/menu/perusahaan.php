<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-2"><?= $data['page']; ?></h1>
					<p class="mb-4">Perusahaan yang terdaftar.</p>
				</div>
				<?php if($data['produk'] != null):?>
				<div class="col-md-2 align-self-end mb-4 d-flex justify-content-end">
					<a href="#" class="modalTambahPerusahaan" data-toggle="modal" data-target="#modalPerusahaan"><button class="btn btn-primary">Tambah</button></a>
				</div>
				<?php endif;?>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold"><?= $data['page']; ?></h6>
				</div>
				<div class="card-body">
				<?php if($data['perusahaan'] != null):?>
					<div class="table-responsive">
						<table class="table table-bordered duaKolom" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>Nama Perusahaan</th>
									<th>Nama Produk</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($data['perusahaan'] as $perusahaan) : ?>
									<tr>
										<td align="center"><?= $no++; ?>.</td>
										<td><?= $perusahaan['nama_perusahaan']; ?></td>
										<td>
											<div class="row">
												<div class="col-4 border-right"><?= $perusahaan['kode_produk']; ?></div>
												<div class="col-8"><?= $perusahaan['nama_produk']; ?></div>
											</div>
										</td>
										<td align="center">
											<a href="<?= base_url ?>admin/perusahaan_peserta/<?= $perusahaan['id']; ?>"><badge class="badge badge-primary mb-1">Detail</badge></a>
											<a href="<?= base_url ?>admin/ubah_perusahaan/<?= $perusahaan['id']; ?>" data-toggle="modal" data-target="#modalPerusahaan"><badge class="badge badge-warning text-white mb-1 modalUbahPerusahaan" data-id="<?= $perusahaan['id']; ?>">Ubah</badge></a>
											<a class="badge badge-danger mb-1 modalHapusPerusahaan" href="<?= base_url ?>admin/hapus_perusahaan/<?= $perusahaan['id']; ?>">Hapus</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<?php else:?>
						<div class="text-center font-weight-bold">Belum ada <?php if($data['produk'] != null):?>perusahaan yang ditambahkan<?php else:?>produk, tidak dapat menambahkan perusahaan<?php endif;?></div>
					<?php endif;?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalPerusahaan" tabindex="-1" role="dialog" aria-labelledby="modalPerusahaan" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalPerusahaanLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form class="formPerusahaan" action="<?= base_url; ?>admin/tambah_perusahaan" method="post">
						<input type="hidden" id="id" name="id">
						<div class="modal-body">
							<div class="form-group">
								<label for="nama_perusahaan">Nama Perusahaan</label>
								<input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
							</div>
							<div class="form-group">
								<label for="id_produk">Produk</label>
								<select id="id_produk" name="id_produk" class="form-control">
									<?php foreach ($data['produk'] as $produk) : ?>
										<option value="<?= $produk['id']; ?>"><?= $produk['kode_produk']; ?> (<?= $produk['nama_produk']; ?>)</option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="tanggal_kegiatan">Tanggal Training</label>
								<div class="input-group" id="group-tanggal">
									<input type="text" class="form-control datepicker" id="tanggal_kegiatan" name="tanggal_kegiatan" data-provide="datepicker" autocomplete="off" required>
									<div class="input-group-append">
										<label class="input-group-text" id="group-tanggal" for="tanggal_kegiatan"><i class="fas fa-fw fa-calendar"></i></label>
									</div>
								</div>
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