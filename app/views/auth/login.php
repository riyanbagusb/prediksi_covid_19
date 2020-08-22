<div class="container">
	<?php Flasher::flash(); ?>
	<form class="text-center user" method="POST" action="">
		<img src="<?= base_url; ?>assets/images/logo.png" width="100px" alt="">
		<h3 class="mb-5 mt-4 text-uppercase">Sistem Prediksi Perkembangan COVID-19</h3>
		<h1 class="mb-5 font-weight-light text-uppercase">Login</h1>
		<div class="form-group">
			<input id="username" type="username" class="form-control rounded-pill form-control <?php isInvalid::get_error('username'); ?>" name="username" placeholder="Username" required autocomplete="off" autofocus>
			<span class="invalid-feedback text-left ml-2" role="alert">
				<strong>Username yang anda masukkan salah!</strong>
			</span>
		</div>
		<div class="form-group">
			<input id="password" type="password" class="form-control rounded-pill form-control <?php isInvalid::get_error('password'); ?>" name="password" placeholder="Password" required autocomplete="password">
			<span class="invalid-feedback text-left ml-2" role="alert">
			<strong>Password yang anda masukkan salah!</strong>
			</span>
		</div>
		<input type="submit" name="login" class="btn btn-outline-secondary mt-5 rounded-pill btn-lg btn-ruswin btn-block text-uppercase font-weight-bold" value="Login"></input>
	</form>
</div>