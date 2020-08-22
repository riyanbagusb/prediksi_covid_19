<div class="app">
	<section class="page-section bg-primary text-white" id="page-top">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<img class="mt-4" src="<?= base_url; ?>assets/images/logo.png" width="100px" alt="">
					<h1>Selamat Datang</h1>
					<hr class="divider light" />
					<h3 class="mt-0">Sistem Prediksi Perkembangan COVID-19</h3>
					<p class="mt-5">Sistem Prediksi Perkembangan Coronavirus disease 2019 (SPPCOV19) adalah sistem yang dikembangkan menggunakan pendekan machine learning dalam memprediksi perkembangan penyakit yang disebabkan SARS-CoV-2.</p>
				</div>
			</div>
		</div>
	</section>
	<section class="page-section" id="kasus">
		<div class="container">
			<div class="justify-content-center">
				<div class="text-center">
					<h2 class="mt-0">Kasus di Indonesia</h2>
					<hr class="divider my-4" />
					<div class="row">
						<div class="col-md-3 text-center mt-5">
							<i class="fas fa-lungs-virus fa-5x"></i>
							<h3 class="h4 text-dark mt-4 mb-2 counter" id="total_terkonfirmasi">0</h3>
							<p class="text-muted mb-0">Kasus Terkonfirmasi</p>
						</div>
						<div class="col-md-3 text-center mt-5">
						<i class="fas fa-dove fa-5x"></i>
							<h3 class="h4 text-dark mt-4 mb-2 counter" id="total_meninggal">0</h3>
							<p class="text-muted mb-0">Kasus Meninggal</p>
						</div>
						<div class="col-md-3 text-center mt-5">
							<i class="fas fa-virus-slash fa-5x"></i>
							<h3 class="h4 text-dark mt-4 mb-2 counter" id="total_sembuh">0</h3>
							<p class="text-muted mb-0">Kasus Sembuh</p>
						</div>
						<div class="col-md-3 text-center mt-5">
							<i class="fas fa-shield-virus fa-5x"></i>
							<h3 class="h4 text-dark mt-4 mb-2 counter" id="total_aktif">0</h3>
							<p class="text-muted mb-0">Kasus Aktif</p>
						</div>
						<div class="col-12 text-right mt-5">
							<!-- <span class="small text-muted">Sumber Data: Johns Hopkins University CSSE</span> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="page-section bg-dark text-white" id="negara">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<h2 class="mt-0">Prediksi Perkembangan COVID-19</h2>
					<hr class="divider my-4" />
					<div class="text-center">
						<select class="form-control form-control-sm select2" name="nama_negara" id="nama_negara">
						<?php foreach ($data['negara'] as $negara): ?>
							<option value="<?= $negara['negara'] ?>"><?= $negara['negara'] ?></option>
						<?php endforeach ?>
						</select>
					</div>
					<div class="row pt-3">
						<div class="col-12 pt-5 covidNegara">
							<h4 class="mb-3">Kasus COVID-19</h4>
							<canvas id="covidNegara"></canvas>
						</div>
						<!-- <div class="col-12 pt-5 covidDunia">
							<h4 class="mb-3">Prediksi Kasus</h4>
							<canvas id="covidDunia"></canvas>
						</div> -->
					</div>
				</div>
				<div class="col-12 text-right mt-5">
					<!-- <span class="small text-muted">Sumber Data: Johns Hopkins University CSSE</span> -->
				</div>
			</div>
		</div>
	</section>

	<section class="page-section bg-light" id="prediksi">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12 text-center">
					<h2 class="mt-0">Prediksi</h2>
					<hr class="divider my-4" />
					<div class="row pt-3">
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
						<div class="col-12 pt-5">
							<h4 class="mb-3">Rekomendasi</h4>
							<div class="mb-3 text-right text-muted small">Prediksi persentase kenaikan kasus mencapai <span id="persentase_kenaikan"></span>%</div>
							<ul class="list-group text-left" id="rekomendasi">
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-light pb-4">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<div class="text-muted small">Sistem ini dikembangkan menggunakan metode Support Vector Machine dan metode Prophet.</div>
				</div>
			</div>
		</div>
	</section>
</div>