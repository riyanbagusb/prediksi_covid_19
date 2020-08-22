<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-2">Bahan Pelatihan</h1>
					<p class="mb-4"><?= $data['produk']['kode_produk']; ?> (<?= $data['produk']['nama_produk']; ?>).</p>
				</div>
				<div class="col-md-2 align-self-end mb-4 d-flex justify-content-end">
					<a href="#" class="modalTambahBahan" data-toggle="modal" data-target="#modalBahan"><button class="btn btn-primary">Tambah</button></a>
				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold"><?= $data['produk']['nama_produk']; ?></h6>
				</div>
				<div class="card-body">
				<?php if($data['pelatihanByProduk'][0]['id'] != null):?>
					<div class="table-responsive">
						<table class="table table-bordered duaKolom" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>Bahan Pelatihan</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($data['pelatihanByProduk'] as $pelatihanByProduk) : ?>
									<?php if ($pelatihanByProduk['nama_bahan'] != ''): ?>
										<tr>
											<td align="center"><?= $no++; ?>.</td>
											<td><?= $pelatihanByProduk['nama_bahan']; ?></td>
											<td><?= $pelatihanByProduk['deskripsi']; ?></td>
											<td align="center">
												<a href="<?= base_url ?>assets/files/bahan_pelatihan/<?= $pelatihanByProduk['nama_file']; ?>" download><badge class="badge badge-primary mb-1">Unduh</badge></a>
												<a class="badge badge-danger mb-1 modalHapusBahan" href="<?= base_url ?>admin/hapus_bahan/<?= $pelatihanByProduk['id']; ?>/<?= $pelatihanByProduk['nama_file']; ?>">Hapus</a>
											</td>
										</tr>
									<?php endif ?>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<?php else:?>
						<div class="text-center font-weight-bold">Belum ada bahan pelatihan yang ditambahkan</div>
					<?php endif;?>
				</div>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">Syarat Mengikuti Pelatihan</h6>
				</div>
				<div class="card-body">
					<table class="table table-responsive-sm" width="100%" cellspacing="0">
						<form class="formPerusahaan" action="<?= base_url; ?>admin/ubah_syarat/<?= $data['produk']['id']; ?>" method="post">
							<tbody>
								<tr>
								<?php if ($data['produk']['syarat'] == "") {echo "<td class='h5 text-center'>Belum ada syarat & ketentuan.</td>";} else { echo '<td><pre>'.$data['produk']['syarat'].'</pre></td>';} ?>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<input type="hidden" id="id" name="id" value="<?= $data['produk']['id']; ?>">
											<label for="syarat">Syarat & Ketentuan:</label>
											<textarea type="text" class="form-control" id="syarat" name="syarat" data-placement="left" data-toggle="tooltip" title="Syarat & ketentuan untuk perusahaan mengikuti kegiatan pelatihan. (kosongkan untuk menghapus)"><?php if ($data['produk']['syarat'] != ""){ echo $data['produk']['syarat'];} ?></textarea>
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
		</div>
		<div class="modal fade" id="modalBahan" tabindex="-1" role="dialog" aria-labelledby="modalDetailProduk" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalDetailBahanLabel">Tambah Bahan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url; ?>admin/tambah_bahan" method="post" enctype='multipart/form-data'	>
						<input type="hidden" id="id" name="id">
						<div class="modal-body">
							<div class="form-group">
								<label for="nama_bahan">Nama Bahan</label>
								<input type="text" class="form-control" id="nama_bahan" name="nama_bahan" required>
							</div>
							<div class="form-group">
								<label for="deskripsi">Deskripsi File</label>
								<input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
								<input type="text" class="form-control" id="id_produk" name="id_produk" value="<?= $data['produk']['id']; ?>" hidden>
							</div>
							<div class="form-group">
								<label for="nama_file">Upload File</label>
								<input type="file" class="form-control-file" id="nama_file" name="nama_file">
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" value="submit" name="submit" class="btn btn-primary">Tambah</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>