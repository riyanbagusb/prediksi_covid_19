<nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-transparent-100 justify-content-center mr-auto d-none d-sm-flex">
	<a class="navbar-brand mr-0" href="<?= base_url; ?>">
		<img class="mr-2" src="<?= base_url; ?>assets/images/sysindo.png" style="height: 2rem; width: 2rem">
		<span class="h5">PT Synergi Sukses Solusindo</span>
	</a>
	<div class="collapse navbar-collapse">
		<div class="navbar-nav ml-auto d-none d-sm-inline">
			<a class="nav-link" href="#" id="dropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="mr-2 small text-white"><?= $_SESSION['username'] ?></span>
				<img class="d-none d-sm-inline rounded-circle border" src="<?= base_url; ?>assets/images/sysindo.png" style="height: 2rem; width: 2rem">
			</a>
			<div class="dropdown-menu dropdown-menu-right p-2 mr-2 mt-2 bg-transparent-25" aria-labelledby="dropdownUser">
				<div class="text-center bg-transparent-0 p-2 rounded">
					<img class="rounded-circle border m-3" src="<?= base_url; ?>assets/images/sysindo.png" style="height: 4rem; width: 4rem">
					<a class="dropdown-item-text small text-white">Username : <?= $_SESSION['username'] ?></a>
					<a class="dropdown-item-text small text-white mb-4">Hak Akses : <?= $_SESSION['level'] ?></a>
					<!-- <button class="btn btn-sm bg-transparent-50 text-white" data-toggle="tooltip" data-placement="bottom" title="Pengaturan Akun"><i class="fas fa-fw fa-user-cog"></i> Edit Profil</button> -->
					<a href="<?= base_url; ?>auth/logout"><button class="btn btn-sm bg-red-50 text-white"><i class="fas fa-fw fa-sign-out-alt"></i> Keluar</button></a>
				</div>
			</div>
		</div>
	</div>
</nav>
