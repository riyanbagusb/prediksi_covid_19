<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10 mb-4">
					<h1 class="h3 mb-2"><?= $data['page']; ?></h1>
				</div>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">Pengaturan Sertifikat</h6>
				</div>
				<div class="card-body">
					<table class="table table-responsive-sm satuKolom" width="100%" cellspacing="0">
						<thead>
							<tr align="center">
								<th>Penandatangan</th>
								<th>Jabatan</th>
							</tr>
						</thead>
						<form class="formPerusahaan" action="<?= base_url; ?>admin/ubah_sertifikat/<?php foreach ($data['sertifikat'] as $sertifikat) : ?><?= $sertifikat['id']; ?><?php endforeach ?>" method="post">
							<tbody>
								<tr>
									<?php foreach ($data['sertifikat'] as $sertifikat) : ?>
										<tr>
											<td class="h5" align="center"><?= $sertifikat['penandatangan']; ?></td>
											<td align="center"><?= $sertifikat['jabatan']; ?></td>
										</tr>
									<?php endforeach ?>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<input type="hidden" id="id" name="id" value="<?php foreach ($data['sertifikat'] as $sertifikat) : ?><?= $sertifikat['id']; ?><?php endforeach ?>">
											<label for="penandatangan">Nama Penandatangan</label>
											<input type="text" class="form-control" id="penandatangan" name="penandatangan" required>
										</div>
									</td>
									<td>
										<div class="form-group">
											<label for="jabatan">Jabatan</label>
											<input type="text" class="form-control" id="jabatan" name="jabatan" required>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center"><button type="submit" class="btn btn-primary btn-block">Ubah</button></td>
								</tr>
							</tbody>
						</form>
					</table>
				</div>
			</div>
			<div class="card shadow mt-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">Tambah User</h6>
				</div>
				<div class="card-body">
					<form action="" method="post">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label for="confirmPassword">Confirm Password</label>
							<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label for="level">Level</label>
							<select id="level" name="level" class="form-control">
								<option value="Admin">Admin</option>
								<option value="Panitia">Panitia</option>
								<option value="Perusahaan" id="perusahaan">Perusahaan</option>
							</select>
						</div>
						<div class="form-group" id="pilih_perusahaan">
							<label for="id_perusahaan">Perusahaan</label>
							<select id="id_perusahaan" name="id_perusahaan" class="form-control">
								<option value="" id="notPerusahaan"></option>
								<?php foreach ($data['perusahaan'] as $perusahaan) : ?>
									<option value="<?= $perusahaan['id']; ?>"><?= $perusahaan['nama_perusahaan']; ?> (<?= $perusahaan['kode_produk']; ?>)</option>
								<?php endforeach ?>
							</select >
						</div>
						<div class="modal-footer border-0">
							<button type="submit" class="btn btn-primary">Tambahkan</button>
						</div>
					</form>
				</div>
			</div>
			<div class="card shadow mt-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">User</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered duaKolom" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>User</th>
									<th>Level</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($data['user'] as $user) : ?>
									<tr>
										<td align="center"><?= $no++; ?>.</td>
										<td>
											<div class="row text-center">
												<?php if ($user['level'] != 'Perusahaan') : ?>
													<div class="col-12 text-center">
														<?= $user['username']; ?>
													</div>
												<?php endif; ?>	
												<?php if ($user['level'] == 'Perusahaan') : ?>
													<div class="col-3">
														<?= $user['username']; ?>
													</div>
													<div class="col-6 border-left border-right">
														<?php if ($user['level'] == 'Perusahaan') {echo $user['nama_perusahaan']; }?>
													</div>
													<div class="col-3">
														<?php if ($user['level'] == 'Perusahaan') {echo $user['kode_produk'];} ?>
													</div>
												<?php endif; ?>
											</div>
										</td>
										<td><?= $user['level']; ?></td>
										<td align="center">
											<!-- <a class="badge badge-warning text-white mb-1" href="">Ubah</badge></a> -->
											<a class="badge badge-danger mb-1" href="<?= base_url ?>admin/hapus_user/<?= $user['id']; ?>">Hapus</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>