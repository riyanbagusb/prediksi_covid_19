<nav class="navbar navbar-expand navbar-light bg-white text-dark fixed-top shadow-sm">
	<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
		<i class="fa fa-bars"></i>
	</button>
	<div class="ml-5 d-none d-md-block">
		<a href="<?= base_url; ?>admin" class="navbar-brand align-middle">
			<img src="<?= base_url; ?>assets/images/logo.png" width="30" height="30" class="d-inline-block align-top">
			<span class="font-weight-bold text-dark">SPPCOV19</span>
		</a>
	</div>
	<ul class="navbar-nav ml-auto">
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="mr-2 text-dark small text-uppercase"><?= $_SESSION['username']; ?> <i class="fas fa-user fa-sm"></i></span>
			</a>
			<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="<?= base_url; ?>auth/logout">Logout</a>
			</div>
		</li>
	</ul>
</nav>
<!-- Batas Navbar -->
<div class="container-fluid">
	<div class="container">