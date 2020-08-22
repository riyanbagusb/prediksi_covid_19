<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-2"><?= $data['page']; ?></h1>
					<p class="mb-4">Jadwal Konsultasi dan Training Manajemen.</p>
				</div>
				<div class="col-md-2 align-self-end mb-4 d-flex justify-content-end">
					<a href="#" class="modalTambahProduk" data-toggle="modal" data-target="#modalProduk"><button class="btn btn-primary">Tambah</button></a>
				</div>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold"><?= $data['page']; ?></h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered duaKolomOnly" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>Nama Kegiatan</th>
									<th>Waktu Kegiatan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($data['jadwal'] as $jadwal) : 
									$date = $jadwal['tanggal_pelaksanaan'];
									$timestamp = strtotime($date);
									$tanggal = date('d-m-Y', $timestamp);?>
									<tr class="<?php if (date('ymd', $timestamp) == date('ymd')){echo "bg-success text-white";}elseif (date('ymd') > date('ymd')){echo "badge-warning text-secondary";}
									 elseif (date('ymd', $timestamp) < date('ymd')){echo "bg-transparent-25 text-secondary";}?>">
										<td align="center"><?= $no++; ?>.</td>
										<td><a href="<?= base_url ?>admin/detail_jadwal/<?= $jadwal['id']; ?>" class="<?php if (date('ymd', $timestamp) == date('ymd')){echo "text-white";}else{echo "text-dark";}?>"><?= $jadwal['nama_kegiatan']; ?></a></td>
										<td><?php echo dateId($tanggal);?></td>
										<td align="center">
											<a href="<?= base_url ?>admin/detail_jadwal/<?= $jadwal['id']; ?>"><badge class="badge badge-primary mb-1">Detail</badge></a>
											<a href="<?= base_url ?>admin/ubah_produk/<?= $jadwal['id']; ?>" data-toggle="modal" data-target="#modalProduk"><badge class="badge badge-warning text-white mb-1 modalUbahProduk" data-id="<?= $jadwal['id']; ?>">Ubah</badge></a>
											<a class="badge badge-danger mb-1 modalHapusProduk" href="<?= base_url ?>admin/hapus_produk/<?= $jadwal['id']; ?>">Hapus</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modalProduk" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalProdukLabel">Tambah <?= $data['page']; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form class="formProduk" action="<?= base_url; ?>admin/tambah_jadwal" method="post">
						<input type="hidden" id="id" name="id">
						<div class="modal-body">
							<div class="form-group">
								<label for="nama_kegiatan">Nama Kegiatan</label>
								<input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan">
							</div>
							<div class="form-group">
								<label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
								<div class="input-group" id="group-tanggal">
									<input type="text" class="form-control datepicker" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" data-provide="datepicker" autocomplete="off">
									<div class="input-group-append">
										<label class="input-group-text" id="group-tanggal" for="tanggal_pelaksanaan"><i class="fas fa-fw fa-calendar"></i></label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="kode_perusahaan">Nama Perusahaan</label>
								<select id="kode_perusahaan" name="kode_perusahaan" class="form-control">
									<?php foreach ($data['perusahaan'] as $perusahaan) : ?>
										<option value="<?= $perusahaan['id']; ?>"><?= $perusahaan['nama_perusahaan']; ?></option>
									<?php endforeach ?>
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