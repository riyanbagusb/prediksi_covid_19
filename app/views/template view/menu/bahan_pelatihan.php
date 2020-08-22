<div class="container-fluid d-sm-block">
	<div class="container">
		<div class="container-fluid pt-4 pb-4">
			<?php Flasher::flash(); ?>
			<div class="row">
				<div class="col-md-10">
					<h1 class="h3 mb-2"><?= $data['page']; ?></h1>
					<p class="mb-4">Syarat mengikuti pelatihan & bahan pelatihan berdasarkan produk yang diambil.</p>
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
											<a href="<?= base_url ?>admin/produk_pelatihan/<?= $produk['id']; ?>"><badge class="badge badge-primary mb-1">Detail</badge></a>
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
	</div>
</div>