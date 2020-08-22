<?php Flasher::flash(); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><?= $data['negara']['negara'] ?></h1>
	<button class="btn btn-sm btn-success btn-tambah" data-toggle="modal" data-target="#dtModal"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Tambah</button>
</div>
<table class="table table-sm table-bordered dataTable">
	<thead class="text-center">
		<tr>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Kasus</th>
			<th>Meninggal</th>
			<th>Sembuh</th>
			<th>Aktif</th>
			<th>Persentase Meninggal</th>
			<th>Persentase Sembuh</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data['data_training'] as $data_training): ?>
		<tr>
			<td></td>
			<td><span class="d-none"><?= strtotime($data_training['tanggal']) ?></span><?= tanggal(date('d-m-Y', strtotime($data_training['tanggal']))) ?></td>
			<td class="text-right"><?= $data_training['kasus'] ?></td>
			<td class="text-right"><?= $data_training['meninggal'] ?></td>
			<td class="text-right"><?= $data_training['sembuh'] ?></td>
			<td class="text-right"><?= $data_training['kasus'] - $data_training['meninggal'] - $data_training['sembuh'] ?></td>
			<td class="text-right"><?php echo $data_training['meninggal'] == 0 ? 0 : number_format(round($data_training['meninggal'] / $data_training['kasus'] * 100, 2),2) ;?></td>
			<td class="text-right"><?php echo $data_training['sembuh'] == 0 ? 0 : number_format(round($data_training['sembuh'] / $data_training['kasus'] * 100, 2),2) ;?></td>
			<td class="text-center">
				<a href="#" class="badge badge-warning p-1 btn-ubah" data-toggle="modal" data-target="#dtModal" data-id="<?= $data_training['id'] ?>" data-tanggal="<?= $data_training['tanggal'] ?>" data-kasus="<?= $data_training['kasus'] ?>" data-meninggal="<?= $data_training['meninggal'] ?>" data-sembuh="<?= $data_training['sembuh'] ?>">Ubah</a>
				<a href="#" class="badge badge-danger p-1 btn-hapus" data-toggle="modal" data-target="#dtModal" data-id="<?= $data_training['id'] ?>" data-tanggal="<?= $data_training['tanggal'] ?>" data-kasus="<?= $data_training['kasus'] ?>" data-meninggal="<?= $data_training['meninggal'] ?>" data-sembuh="<?= $data_training['sembuh'] ?>">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<div class="modal fade" id="dtModal" tabindex="-1" role="dialog" aria-labelledby="modalDt" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel"><span id="tag">Tambah</span> Tanggal</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form action="" method="POST">
			<div class="modal-body">
				<input type="hidden" name="_method" id="_method" value="POST">
				<input type="hidden" id="id">
				<div class="form-group">
					<label for="tanggal">Tanggal</label>
					<input type="text" name="tanggal" class="form-control datepicker" id="tanggal"  autocomplete="off" required>
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="kasus">Kasus</label>
						<input type="number" name="kasus" class="form-control" id="kasus" autocomplete="off" required>
					</div>
					<div class="col-md-4 mb-3">
						<label for="meninggal">Meninggal</label>
						<input type="number" name="meninggal" class="form-control" id="meninggal" autocomplete="off" required>
					</div>
					<div class="col-md-4 mb-3">
						<label for="sembuh">Sembuh</label>
						<input type="number" name="sembuh" class="form-control" id="sembuh" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-sm btn-success" id="btn-aksi">Simpan</button>
			</div>
		</form>
		</div>
	</div>
</div>