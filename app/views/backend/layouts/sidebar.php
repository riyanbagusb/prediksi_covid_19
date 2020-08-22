<ul class="navbar-nav bg-success sidebar sidebar-dark accordion toggled-sm" id="accordionSidebar">
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
	</a>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url; ?>admin">
		<i class="fas fa-fw fa-home text-white"></i>
		<span>Home</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-hdd text-white"></i>
			<span>Master Data</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="<?= base_url; ?>admin/negara">Negara</a>
				<a class="collapse-item" href="<?= base_url; ?>admin/rekomendasi">Rekomendasi</a>
				<!-- <a class="collapse-item" href="<?= base_url; ?>admin/tanggal">Tanggal</a> -->
			</div>
		</div>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url; ?>admin/data_training">
			<i class="fas fa-fw fa-laptop text-white"></i>
			<span>Data Training</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url; ?>admin/data_prediksi">
			<i class="fas fa-fw fa-laptop-code text-white"></i>
			<span>Data Prediksi</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url; ?>admin/tes_koding">
			<i class="fas fa-fw fa-laptop-code text-white"></i>
			<span>Negara dan Kasus</span>
		</a>
	</li>
	<!-- <li class="nav-item">
		<a class="nav-link" href="<?= base_url; ?>admin/konfigurasi">
			<i class="fas fa-fw fa-cog text-white"></i>
			<span>ML Configuration</span>
		</a>
	</li> -->
	<div class="text-center d-none d-md-inline pt-5">
		<button class="rounded-circle border" id="sidebarToggle"></button>
	</div>
</ul>
<!-- Batas Sidebar -->
<div id="content-wrapper" class="d-flex flex-column mt-5 pt-5">
	<div id="content">