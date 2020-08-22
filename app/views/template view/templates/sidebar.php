<div class="d-flex" id="wrapper">
	<div class="sidebar-wrapper bg-light border-right bg-light min-vh-100" id="sidebar-wrapper">
		<div class="sidebar-heading font-weight-bold text-center">Menu</div>
		<div class="list-group list-group-flush">
			<a href="<?= base_url;?>admin" class="list-group-item list-group-item-action bg-light"><i class="fas fa-fw fa-tachometer-alt pr-4"></i>Dashboard</a>
			<a href="<?= base_url;?>admin/produk" class="list-group-item list-group-item-action bg-light"><i class="fas fa-fw fa-project-diagram pr-4"></i>Produk</a>
			<a href="<?= base_url;?>admin/perusahaan" class="list-group-item list-group-item-action bg-light"><i class="fas fa-fw fa-building pr-4"></i>Perusahaan</a>
			<a href="<?= base_url;?>admin/bahan_pelatihan" class="list-group-item list-group-item-action bg-light"><i class="fas fa-fw fa-tasks pr-4"></i>Syarat & Bahan Pelatihan</a>
			<a href="<?= base_url;?>admin/jadwal_kegiatan" class="list-group-item list-group-item-action bg-light"><i class="fas fa-fw fa-calendar pr-4"></i>Jadwal Kegiatan</a>
			<a href="<?= base_url;?>admin/pengaturan" class="list-group-item list-group-item-action bg-light mt-5"><i class="fas fa-fw fa-cog pr-4"></i>Pengaturan</a>
			<a href="<?= base_url;?>auth/logout" class="list-group-item list-group-item-action bg-danger text-white"><i class="fas fa-fw fa-sign-out-alt pr-4"></i>Keluar</a>
		</div>
	</div>
	<div id="page-content-wrapper">
		<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-radius">
			<a class="btn btn-light" id="menu-toggle"><i class="fas fa-bars"></i></a>
			<a class="navbar-brand d-sm-none text-center m-auto" href="#" id="logo-sysindo">
				<img class="ml-2" src="<?= base_url; ?>assets/images/sysindo.png" style="height: 2rem; width: 2rem">
				<span class="small font-weight-lighter">Sysindo Konsultan</span>
			</a>
			<ol class="breadcrumb ml-auto small mb-0 d-none d-md-flex">
				<li class="breadcrumb-item active" aria-current="page" data-toggle="tooltip" data-placement="bottom" title="Anda sedang berada di halaman <?= $data['page']; ?>"><?= $data['page']; ?></li>
			</ol>
		</nav>