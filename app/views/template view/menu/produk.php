<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-2"><?= $data['page']; ?></h1>
					<p class="mb-4">Produk yang tersedia.</p>
				</div>
				<div class="col-md-2 align-self-end mb-4 d-flex justify-content-end">
					<a href="#" class="mr-2 modalTambahProduk" data-toggle="modal" data-target="#modalProduk"><button class="btn btn-primary">Tambah</button></a>
					<?php if($data['produk'] != null):?>
					<?php if($data['perusahaan'] != null):?>
					<a href="<?= base_url ?>admin/cetak_report"><button class="btn btn-secondary">Report</button></a>
					<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold"><?= $data['page']; ?></h6>
				</div>
				<div class="card-body">
				<?php if($data['produk'] != null):?>
					<div class="table-responsive">
						<table class="table table-bordered duaKolom" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr align="center">
									<th>No</th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($data['produk'] as $produk) : ?>
									<tr>
										<td align="center"><?= $no++; ?>.</td>
										<td><?= $produk['kode_produk']; ?></td>
										<td><?= $produk['nama_produk']; ?></td>
										<td align="center">
											<a href="<?= base_url ?>admin/ubah_produk/<?= $produk['id']; ?>" data-toggle="modal" data-target="#modalProduk"><badge class="badge badge-warning text-white mb-1 modalUbahProduk" data-id="<?= $produk['id']; ?>">Ubah</badge></a>
											<a class="badge badge-danger mb-1 modalHapusProduk" href="<?= base_url ?>admin/hapus_produk/<?= $produk['id']; ?>">Hapus</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<?php else:?>
						<div class="text-center font-weight-bold">Belum ada produk yang ditambahkan</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modalProduk" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalProdukLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form class="formProduk" action="<?= base_url; ?>admin/tambah_produk" method="post">
						<input type="hidden" id="id" name="id">
						<div class="modal-body">
							<div class="form-group">
								<label for="kode_produk">Kode Produk</label>
								<input type="text" class="form-control" id="kode_produk" name="kode_produk" required>
							</div>
							<div class="form-group">
								<label for="nama_produk">Nama Produk</label>
								<input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
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