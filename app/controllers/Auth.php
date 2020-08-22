<?php

class Auth extends Controller {

	public function index()
	{
		$data['title'] = 'Login | Sistem Prediksi Perkembangan COVID19';
		$data['login'] = $this->model('Auth_model')->login();
		$this->view('auth/layouts/header', $data);
		$this->view('auth/login', $data);
		$this->view('auth/layouts/footer');
	}

	public function logout()
	{
		$data['signout'] = $this->model('Auth_model')->logout();
	}
}