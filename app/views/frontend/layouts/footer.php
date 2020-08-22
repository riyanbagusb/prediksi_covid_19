	<footer class="bg-light py-4">
		<div class="container text-center">
			<div class="small text-muted font-weight-bold">© <?php if(date('Y') == '2020'){ echo date('Y');} else echo '2020 - '.date('Y'); ?> <?= $data['title']; ?></div>
		</div>
	</footer>
	<script src="<?= base_url; ?>assets/vendor/jquery.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/jquery.easing.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/jquery.waypoints.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/chart.js/Chart.bundle.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/select2/js/select2.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/counterup2/index.js"></script>
	<script src="<?= base_url; ?>assets/js/frontend/scripts.js"></script>
	<!-- <script src="<?= base_url; ?>assets/js/frontend/covidIndonesia.js"></script> -->
	<!-- <script src="<?= base_url; ?>assets/js/frontend/covidDunia.js"></script> -->
	<script src="<?= base_url; ?>assets/js/frontend/covidNegara.js"></script>
</body>