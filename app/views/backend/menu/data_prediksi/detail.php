<?php Flasher::flash(); ?>
<div class="d-sm-flex align-items-center justify-content-between">
	<h1 class="h3 mb-0 text-gray-800"><?= $data['negara']['negara'] ?></h1>
	<form action="" method="POST">
		<input type="hidden" name="_method" id="_method" value="POST">
		<input type="submit" class="btn btn-sm btn-success" value="<?php echo ($data['last_update'])?'Perbaharui Prediksi':'Buat Prediksi'; ?>" data-toggle="modal" data-target="#staticBackdrop">
	</form>
	<script>
		
	</script>
</div>
<?php if($data['last_update']):?>
<p class="text-right small mt-2">Data Terbaru: <?php if($data['last_update']['updated_at'] == ''){ echo tanggal(date('d-m-Y H:i:s', strtotime($data['last_update']['created_at'])));}else{ echo tanggal(date('d-m-Y H:i:s', strtotime($data['last_update']['updated_at'])));}; ?></p>
<div class="row mt-4">
	<div class="col-lg-6">
		<h2 class="h4 text-gray-800 mb-3">SVM</h2>
		<table class="table table-sm table-bordered dataTable">
			<thead class="text-center">
				<tr>
					<th>No.</th>
					<th>Tanggal</th>
					<th>Kasus</th>
					<th>Meninggal</th>
					<th>Sembuh</th>
					<th>Aktif</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data['data_prediksi'] as $svm): ?>
				<tr>
					<td></td>
					<td><span class="d-none"><?= strtotime($svm['tanggal']) ?></span><?= tanggal(date('d-m-Y', strtotime($svm['tanggal']))) ?></td>
					<td class="text-right"><?= $svm['kasus_svm'];?></td>
					<td class="text-right"><?= $svm['meninggal_svm'];?></td>
					<td class="text-right"><?= $svm['sembuh_svm'];?></td>
					<td class="text-right"><?= $svm['aktif_svm'];?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div class="col-lg-6">
		<h2 class="h4 text-gray-800 mb-3">Prophet</h2>
		<table class="table table-sm table-bordered dataTable">
			<thead class="text-center">
				<tr>
					<th>No.</th>
					<th>Tanggal</th>
					<th>Kasus</th>
					<th>Meninggal</th>
					<th>Sembuh</th>
					<th>Aktif</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data['data_prediksi'] as $prophet): ?>
				<tr>
					<td></td>
					<td><span class="d-none"><?= strtotime($prophet['tanggal']) ?></span><?= tanggal(date('d-m-Y', strtotime($prophet['tanggal']))) ?></td>
					<td class="text-right"><?= $prophet['kasus_prophet']; ?></td>
					<td class="text-right"><?= $prophet['meninggal_prophet']; ?></td>
					<td class="text-right"><?= $prophet['sembuh_prophet']; ?></td>
					<td class="text-right"><?= $prophet['aktif_prophet']; ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div class="col-lg-6 mt-4">
		<div class="card text-white bg-primary">
			<div class="card-body">
				<table class="table table-sm text-white table-borderless">
					<h5 class="card-title">SVM | MAE (Mean Absolute Errror)</h5>
					<?php foreach ($data['error_svm1'] as $es1): ?>
					<tr>
						<td class="text-capitalize"><?= substr($es1['nama_error'], 4); ?></td>
						<td class="text-right"><?= $es1['MAE'] ?></td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
		<div class="card text-white bg-warning mt-4">
			<div class="card-body">
				<table class="table table-sm text-white table-borderless">
					<h5 class="card-title">SVM | MAPE (Mean Absolute Percentage Errror)</h5>
					<?php foreach ($data['error_svm2'] as $es2): ?>
					<tr>
						<td class="text-capitalize"><?= substr($es2['nama_error'], 4); ?></td>
						<td class="text-right"><?= $es2['MAPE'] ?></td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-lg-6 mt-4">
		<div class="card text-white bg-primary">
			<div class="card-body">
				<table class="table table-sm text-white table-borderless">
					<h5 class="card-title">Prophet | MAE (Mean Absolute Errror)</h5>
					<?php foreach ($data['error_prophet1'] as $ep1): ?>
					<tr>
						<td class="text-capitalize"><?= substr($ep1['nama_error'], 8); ?></td>
						<td class="text-right"><?= $ep1['MAE'] ?></td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
		<div class="card text-white bg-warning mt-4">
			<div class="card-body">
				<table class="table table-sm text-white table-borderless">
					<h5 class="card-title">Prophet | MAPE (Mean Absolute Percentage Errror)</h5>
					<?php foreach ($data['error_prophet2'] as $ep2): ?>
					<tr>
						<td class="text-capitalize"><?= substr($ep2['nama_error'], 8); ?></td>
						<td class="text-right"><?= $ep2['MAPE'] ?></td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content bg-transparent border-0">
			<div class="d-flex justify-content-center">
				<div class="spinner-border text-light" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
	</div>
</div>