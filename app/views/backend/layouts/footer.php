						<!-- Batas Navbar -->
						</div>
					</div>
				<!-- Batas Sidebar -->
				</div>
				<footer class="sticky-footer py-0 mt-4">
					<div class="container my-3">
						<div class="copyright text-center">
							<span>© <?php if(date('Y') == '2020'):echo date('Y'); else:echo '2020 - '.date('Y'); endif ?> Sistem Prediksi Perkembangan COVID-19</span>
						</div>
					</div>
				</footer>
			</div>
		<!-- Batas Header -->
		</div>
	</div>
	<script src="<?= base_url; ?>assets/vendor/jquery.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/jquery.easing.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/chart.js/Chart.bundle.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/sbadmin2/js/sb-admin-2.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/sweetalert2/js/sweetalert2.all.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
	<script src="<?= base_url; ?>assets/vendor/select2/js/select2.min.js"></script>
	<script src="<?= base_url; ?>assets/js/backend/scripts.js"></script>
	<?php
		$url = base_url.'admin/index';
		if($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == 'localhost/php/prediksi_covid_19/admin'):?>
			<script src="<?= base_url; ?>assets/js/backend/covidNegara.js"></script>
	<?php endif ?>
</body>