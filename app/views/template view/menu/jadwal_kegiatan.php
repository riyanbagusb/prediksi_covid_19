<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-2"><?= $data['page']; ?></h1>
					<p class="mb-4">Jadwal Kegiatan yang akan dan telah dilaksanakan.</p>
				</div>
				<!-- <div class="col-md-2 align-self-end mb-4 d-flex justify-content-end">
					<a href="#" class="modalTambahJadwal" data-toggle="modal" data-target="#modalJadwal"><button class="btn btn-primary">Tambah</button></a>
				</div> -->
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold"><?= $data['page']; ?></h6>
				</div>
				<div class="card-body">
				<?php if($data['perusahaan'] != null):?>
					<div class="table-responsive">
						<table class="table table-bordered tigaKolom" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>Tanggal Kegiatan</th>
									<th>Perusahaan</th>
									<!-- <th>Aksi</th> -->
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($data['jadwal'] as $jadwal) :
									$date = $jadwal['tanggal_kegiatan'];
									$timestamp = strtotime($date);
									$today = date('Ymd');
									$threeday = date('Ymd')+3;
									$day = date('Ymd', $timestamp);
									$tanggal = date('d-m-Y', $timestamp);?>
									<?php if ($day <= $threeday && $day > $today): ?>
										<tr class="bg-success text-white">
									<?php elseif ($day == $today) : ?>
										<tr class="bg-primary text-white">
									<?php elseif ($day < $today) : ?>
										<tr class="bg-light text-muted">
									<?php else: ?>
										<tr>
									<?php endif ?>
										<td align="center"><?= $no++; ?>.</td>
										<td><?= dateId($tanggal);?></td>
										<td>
											<div class="row">
												<div class="col-12 text-center p-1 font-weight-bold"><a class="text-dark" href="perusahaan_peserta/<?= $jadwal['id_perusahaan']; ?>"><?= $jadwal['nama_perusahaan']; ?></a></div>
												<div class="col-4 border-right"><a class="text-dark" href="produk_pelatihan/<?= $jadwal['id_produk']; ?>"><?= $jadwal['kode_produk']; ?></a></div>
												<div class="col-8"><?= $jadwal['nama_produk']; ?></div>
											</div>
										</td>
										<!-- <td align="center">
											<a href="<?= base_url ?>admin/ubah_jadwal/<?= $jadwal['id']; ?>" data-toggle="modal" data-target="#modalJadwal"><badge class="badge badge-warning text-white mb-1 modalUbahJadwal" data-id="<?= $jadwal['id']; ?>">Ubah</badge></a>
											<a class="badge badge-danger mb-1 modalHapusJadwal" href="<?= base_url ?>admin/hapus_jadwal/<?= $jadwal['id']; ?>">Hapus</a>
										</td> -->
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<div class="pt-3">
						<span>keterangan Warna :</span>
						<span class="badge badge-light border text-muted">Hari Sebelumnya</span>
						<span class="badge badge-primary">Hari ini</span>
						<span class="badge badge-success">3 Hari yang akan datang</span>
						<span class="badge border">Akan datang</span>
					</div>
					<?php else:?>
						<div class="text-center font-weight-bold">Belum ada perusahaan yang ditambahkan, tidak ada jadwal kegiatan</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalJadwal" tabindex="-1" role="dialog" aria-labelledby="modalJadwal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalJadwalLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form class="formJadwal" action="<?= base_url; ?>admin/tambah_jadwal" method="post">
						<input type="hidden" id="id" name="id">
						<div class="modal-body">
							<div class="form-group">
								<label for="nama_kegiatan">Nama Kegiatan</label>
								<!-- <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" required> -->
								<select id="nama_kegiatan" name="nama_kegiatan" class="form-control">
									<option>Pelatihan & Persiapan Implementasi ISO</option>
									<option>Audit Internal & Tinjauan Manajemen ISO</option>
									<option>Pengumuman Hasil Penilaian</option>
									<option>Pengambilan Sertifikat</option>
								</select>
							</div>
							<div class="form-group">
								<label for="tanggal_kegiatan">Tanggal Kegiatan</label>
								<div class="input-group" id="group-tanggal">
									<input type="text" class="form-control datepicker" id="tanggal_kegiatan" name="tanggal_kegiatan" data-provide="datepicker" autocomplete="off" required>
									<div class="input-group-append">
										<label class="input-group-text" id="group-tanggal" for="tanggal_kegiatan"><i class="fas fa-fw fa-calendar"></i></label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="id_perusahaan">Nama Perusahaan</label>
								<select id="id_perusahaan" name="id_perusahaan" class="form-control">
									<?php foreach ($data['perusahaan'] as $perusahaan) : ?>
										<option value="<?= $perusahaan['id']; ?>">(<?= $perusahaan['kode_produk']; ?>)</option>
									<?php endforeach ?>
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