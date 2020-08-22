<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-9">
					<h1 class="h3 mb-2"><?= $data['perusahaan']['nama_perusahaan']; ?></h1>
					<p class="mb-4">Data peserta yang mengikuti kegiatan.</p>
				</div>
				<div class="col-md-3 align-self-end mb-4 d-flex justify-content-end">
					<a href="#informasi"><button class="btn btn-primary mr-2" data-toggle="tooltip" data-placement="left" title="Tambah informasi untuk peerusahaan mengenai kegiatan sertifikasi">Informasi</button></a>
					<a href="#" class="modalTambahPeserta" data-toggle="modal" data-target="#modalPeserta"><button class="btn btn-primary">Tambah</button></a>
				</div>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">Peserta Kegiatan</h6>
				</div>
				<div class="card-body">
				<?php if($data['peserta']['0']['nama_peserta'] != null):?>
					<div class="table-responsive">
						<table class="table table-bordered duaKolom" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>Nama Peserta</th>
									<th>Status Peserta</th>
									<!-- <th>Tanggal Kehadiran</th> -->
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								setlocale(LC_ALL, 'id');
								foreach ($data['peserta'] as $peserta) : ?>
									<tr>
										<td align="center"><?= $no++; ?>.</td>
										<td><?= $peserta['nama_peserta']; ?></td>
										<td class="text-center">
										<?php if ($peserta['status'] == '1'){ ?>
											<span class="badge badge-success">Lulus</span><br>
											<span class="badge badge-light"><?= dateId(date('d-m-Y', strtotime($peserta['tanggal_kegiatan'])));?></span>
										<?php }else if($peserta['status'] == '2'){ ?>
											<span class="badge badge-info">Belum Mengikuti Pelatihan</span>
										<?php }else{ ?>
											<span class="badge badge-danger">Tidak Lulus</span>
										<?php } ?>
										</td>
										<!-- <td><?= dateId(date('d-m-Y', strtotime($peserta['tanggal_kehadiran'])));?></td> -->
										<td align="center">
											<?php if ($peserta['status'] == '1') { ?>
												<a href="<?= base_url ?>admin/sertifikat/<?= $peserta['id']; ?>"><badge class="badge badge-primary mb-1">Cetak</badge></a>
											<?php } ?>
											<a href="<?= base_url ?>admin/ubah_peserta/<?= $peserta['id']; ?>" data-toggle="modal" data-target="#modalPeserta"><badge class="badge badge-warning text-white mb-1 modalUbahPeserta" data-id="<?= $peserta['id']; ?>">Ubah</badge></a>
											<a class="badge badge-danger mb-1 modalHapusPeserta" href="<?= base_url ?>admin/hapus_peserta/<?= $peserta['id']; ?>">Hapus</a>
										</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
					<?php else: ?>
						<div class="text-center font-weight-bold">Belum ada peserta</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="card shadow">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold">Informasi Untuk Perusahaan</h6>
			</div>
			<div class="card-body">
				<table class="table table-responsive-sm" width="100%" cellspacing="0">
					<form class="formPerusahaan" action="<?= base_url; ?>admin/ubah_informasi/<?= $data['perusahaan']['id']; ?>" method="post">
						<tbody>
							<tr>
								<td class="h5" align="center"><?php if ($data['perusahaan']['informasi'] == "") {echo "Tidak ada informasi.";} else { echo $data['perusahaan']['informasi'];} ?></td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<input type="hidden" id="id" name="id" value="<?= $data['perusahaan']['id']; ?>">
										<select id="id_perusahaan" name="id_perusahaan" class="form-control" hidden="on">
											<option value="<?= $data['perusahaan']['id']; ?>" selected><?= $data['perusahaan']['id']; ?></option>
										</select>
										<label for="informasi">Informasi untuk perusahaan:</label>
										<textarea type="text" class="form-control" id="informasi" name="informasi" data-placement="left" data-toggle="tooltip" title="Berikan informasi untuk perusahaan mengenai kegiatan sertifikasi. (kosongkan untuk menghapus)"><?php if ($data['perusahaan']['informasi'] != ""){ echo $data['perusahaan']['informasi'];} ?></textarea>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center"><button type="submit" class="btn btn-primary btn-block">Simpan</button></td>
							</tr>
						</tbody>
					</form>
				</table>
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
					<form class="formPeserta" action="<?= base_url; ?>admin/tambah_peserta/<?= $data['perusahaan']['id']; ?>" method="post">
						<input type="hidden" id="id_peserta" name="id_peserta">
						<div class="modal-body">
							<div class="form-group">
								<label for="nama_peserta">Nama Peserta</label>
								<input type="text" class="form-control" id="nama_peserta" name="nama_peserta" required>
								<select id="id_perusahaan" name="id_perusahaan" class="form-control" hidden="on">
									<option value="<?= $data['perusahaan']['id']; ?>" selected><?= $data['perusahaan']['id']; ?></option>
								</select>
								<select id="nomor_sertifikat" name="nomor_sertifikat" class="form-control" hidden="on">
									<option value="<?php foreach ($data['countPeserta'] as $countPeserta) { echo $countPeserta['COUNT(id)']+1; }; ?>" selected><?php foreach ($data['countPeserta'] as $countPeserta) { echo $countPeserta['COUNT(id)']+1; }; ?></option>
								</select>
							</div>
							<div class="form-group">
								<label for="status">Status</label>
								<select id="status" name="status" class="form-control">
									<option value="1">Lulus</option>
									<option value="0">Tidak Lulus</option>
									<option value="2">Belum Mengikuti Pelatihan</option>
								</select>
							</div>
							<!-- <div class="form-group">
								<label for="tanggal_kehadiran">Tanggal Kehadiran</label>
								<div class="input-group" id="group-tanggal">
									<input type="text" class="form-control datepicker" id="tanggal_kehadiran" name="tanggal_kehadiran" data-provide="datepicker" autocomplete="off" required>
									<div class="input-group-append">
										<label class="input-group-text" id="group-tanggal" for="tanggal_kehadiran"><i class="fas fa-fw fa-calendar"></i></label>
									</div>
								</div>
							</div> -->
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