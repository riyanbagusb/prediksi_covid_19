<h1 class="h3 text-gray-800 text-center">Selamat Datang</h1>
<h2 class="h5 text-center">Di Sistem Prediksi Perkembangan COVID-19</h2>

<div class="row justify-content-center mt-5">
	<div class="col-8 covidNegara">
	<h4 class="mb-3 text-center">Kasus di:</h4>
		<select class="form-control form-control-sm select2 text-center" name="nama_negara" id="nama_negara">
		<?php foreach ($data['negara'] as $negara): ?>
			<option value="<?= $negara['negara'] ?>"><?= $negara['negara'] ?></option>
		<?php endforeach ?>
		</select>
		<canvas class="mt-4" id="covidNegara"></canvas>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-12">
		<hr class="divider my-5" />
		<h4 class="mb-3 text-center">Selisih Hasil Prediksi dengan Data Faktual</h4>
		<table class="table table-sm table-bordered table-hover text-center">
				<tr>
					<th rowspan="2" class="align-middle">Data</th>
					<th rowspan="2" class="align-middle">Faktual</th>
					<th colspan="2">Prophet</th>
					<th colspan="2">SVM</th>
				</tr>
				<tr>
					<th>Angka</th>
					<th>Persen</th>
					<th>Angka</th>
					<th>Persen</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th rowspan="2" class="align-middle">Kasus</th>
					<td rowspan="2" class="align-middle" id="f_kasus">0</td>
					<td colspan="2" id="p_kasus">0</td>
					<td colspan="2" id="s_kasus">0</td>
				</tr>
				<tr>
					<td id="pa_kasus">0</td>
					<td id="pp_kasus">0</td>
					<td id="sa_kasus">0</td>
					<td id="sp_kasus">0</td>
				</tr>
				<tr>
					<th rowspan="2" class="align-middle">Meninggal</th>
					<td rowspan="2" class="align-middle" id="f_meninggal">0</td>
					<td colspan="2" id="p_meninggal">0</td>
					<td colspan="2" id="s_meninggal">0</td>
				</tr>
				<tr>
					<td id="pa_meninggal">0</td>
					<td id="pp_meninggal">0</td>
					<td id="sa_meninggal">0</td>
					<td id="sp_meninggal">0</td>
				</tr>
				<tr>
					<th rowspan="2" class="align-middle">Sembuh</th>
					<td rowspan="2" class="align-middle" id="f_sembuh">0</td>
					<td colspan="2" id="p_sembuh">0</td>
					<td colspan="2" id="s_sembuh">0</td>
				</tr>
				<tr>
					<td id="pa_sembuh">0</td>
					<td id="pp_sembuh">0</td>
					<td id="sa_sembuh">0</td>
					<td id="sp_sembuh">0</td>
				</tr>
				<tr>
					<th rowspan="2" class="align-middle">Aktif</th>
					<td rowspan="2" class="align-middle" id="f_aktif">0</td>
					<td colspan="2" id="p_aktif">0</td>
					<td colspan="2" id="s_aktif">0</td>
				</tr>
				<tr>
					<td id="pa_aktif">0</td>
					<td id="pp_aktif">0</td>
					<td id="sa_aktif">0</td>
					<td id="sp_aktif">0</td>
				</tr>
				<tr>
					<th colspan="6" class="text-right">Tanggal Data Faktual: <span id="f_tanggal"></span></th>
					
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-lg-12 text-center">
		<hr class="divider mt-5" />
		<div class="row">
			<div class="col-6 pt-5 covidKasus">
				<h4 class="mb-3">Prediksi Kasus</h4>
				<canvas id="covidKasus"></canvas>
			</div>
			<div class="col-6 pt-5 covidMeninggal">
				<h4 class="mb-3">Prediksi Meninggal</h4>
				<canvas id="covidMeninggal"></canvas>
			</div>
			<div class="col-6 pt-5 covidSembuh">
				<h4 class="mb-3">Prediksi Sembuh</h4>
				<canvas id="covidSembuh"></canvas>
			</div>
			<div class="col-6 pt-5 covidAktif">
				<h4 class="mb-3">Prediksi Aktif</h4>
				<canvas id="covidAktif"></canvas>
			</div>
		</div>
	</div>
</div>

