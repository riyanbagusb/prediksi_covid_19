<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-2"><?= $data['page']; ?></h1>
					<p class="mb-4">Peserta yang terdaftar.</p>
				</div>
				<div class="col-md-2 align-self-end mb-4 d-flex justify-content-end">
					<a href="#" class="modalTambahPeserta" data-toggle="modal" data-target="#modalPeserta"><button class="btn btn-primary">Tambah</button></a>
				</div>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold"><?= $data['page']; ?></h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered duaKolom" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>Nama Peserta</th>
									<th>Nama Perusahaan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($data['peserta'] as $peserta) : ?>
									<tr>
										<td align="center"><?= $no++; ?>.</td>
										<td><a href="<?= base_url ?>admin/detail_peserta/<?= $peserta['id']; ?>" class="text-dark"><?= $peserta['nama_peserta']; ?></a></td>
										<td><?= $peserta['nama_perusahaan']; ?></td>
										<td align="center">
											<a href="<?= base_url ?>admin/detail_peserta/<?= $peserta['id']; ?>"><badge class="badge badge-primary mb-1">Detail</badge></a>
											<a href="<?= base_url ?>admin/ubah_peserta/<?= $peserta['id']; ?>" data-toggle="modal" data-target="#modalPeserta"><badge class="badge badge-warning text-white mb-1 modalUbahPeserta" data-id="<?= $peserta['id']; ?>">Ubah</badge></a>
											<a class="badge badge-danger mb-1 modalHapusPeserta" href="<?= base_url ?>admin/hapus_peserta/<?= $peserta['id']; ?>">Hapus</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalPeserta" tabindex="-1" role="dialog" aria-labelledby="modalPeserta" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalPesertaLabel">Tambah <?= $data['page']; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form class="formPeserta" action="<?= base_url; ?>admin/tambah_peserta" method="post">
						<input type="hidden" id="id" name="id">
						<div class="modal-body">
							<div class="form-group">
								<label for="nama_peserta">Nama Peserta</label>
								<input type="text" class="form-control" id="nama_peserta" name="nama_peserta">
							</div>
							<div class="form-group">
								<label for="nama_peserta">Nama Peserta</label>
								<select id="kode_perusahaan" name="kode_perusahaan" class="form-control">
									<?php foreach ($data['perusahaan'] as $perusahaan) : ?>
										<option value="<?= $perusahaan['id']; ?>"><?= $perusahaan['nama_perusahaan']; ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="nama_peserta">Nomor Peserta</label>
								<select id="nomor_sertifikat" name="nomor_sertifikat" class="form-control">
									<?php foreach ($data['countPeserta'] as $countPeserta) { ?>
										<option type="text"   value="<?= $countPeserta['COUNT(id)']+1; ?>"><?= $countPeserta['COUNT(id)']+1; ?></option>
									<?php }; ?>
								</select>
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