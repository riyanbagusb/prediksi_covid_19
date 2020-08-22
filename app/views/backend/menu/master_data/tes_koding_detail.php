<?php Flasher::flash(); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><?= $data['negara']['negara'] ?></h1>
</div>
<table class="table table-bordered">
	<thead class="text-center">
		<tr>
			<th>Kasus 3 Bulan Terakhir</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data['last_kasus'] as $data_training): ?>
		<tr>
			<td class="text-center"><?= $data_training['kasus'] ?> Kasus</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<table class="table table-bordered">
	<thead class="text-center">
		<tr>
			<th>Rata-rata Kasus</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data['last_kasus'] as $data_training): ?>
		<tr>
			<td class="text-center"><?= round($data_training['kasus']/$data['last_kasus_row'])  ?> Kasus</td>
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