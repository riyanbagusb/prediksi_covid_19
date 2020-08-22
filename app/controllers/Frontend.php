<?php

class Frontend extends Controller {

	public function index()
	{
		$data['title'] = 'Sistem Prediksi Perkembangan COVID-19';
		$data['negara'] = $this->model('Negara_model')->getNegara();
		$this->view('frontend/layouts/header', $data);
		$this->view('frontend/layouts/navbar', $data);
		$this->view('frontend/index', $data);
		$this->view('frontend/layouts/footer', $data);
	}
}