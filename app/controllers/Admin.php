<?php

class Admin extends Controller {

	public function __construct()
	{
		if ($_SESSION['username'] == null){
			header('location: '. base_url . 'auth');
		}
	}

//INDEX

	public function index()
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';
		$data['negara'] = $this->model('Negara_model')->getNegara();
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/index', $data);
		$this->view('backend/layouts/footer');
	}

//MASTER DATA

	public function negara()
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';
		
		$this->model('Negara_model')->crudNegara($_POST);

		$data['negara'] = $this->model('Negara_model')->getNegara();
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/master_data/negara', $data);
		$this->view('backend/layouts/footer');
	}

	public function tes_koding()
	{
		$data['title'] = 'Tes Koding | Sistem Prediksi Perkembangan COVID19';
		
		$this->model('Negara_model')->crudNegara($_POST);

		$data['negara'] = $this->model('Tes_model')->getApa();
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/master_data/tes_koding', $data);
		$this->view('backend/layouts/footer');
	}

	public function tes_koding_detail($id)
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';

		$this->model('Data_training_model')->crudDataTraining($id, $_POST);

		$data['negara'] = $this->model('Negara_model')->getNegaraById($id);
		$data['last_kasus'] = $this->model('Tes_model')->getLastKasus($id);
		$data['last_kasus_row'] = $this->model('Tes_model')->getLastKasusRow($id);
		$data['tanggal_id'] = $this->model('Tanggal_model')->tanggalIndonesia();
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/master_data/tes_koding_detail', $data);
		$this->view('backend/layouts/footer');
	}

	public function rekomendasi()
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';
		
		$this->model('Rekomendasi_model')->crudRekomendasi($_POST);

		$data['rekomendasi'] = $this->model('Rekomendasi_model')->getRekomendasi();
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/master_data/rekomendasi', $data);
		$this->view('backend/layouts/footer');
	}

	public function tanggal()
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';

		$this->model('Tanggal_model')->crudTanggal($_POST);

		$data['tanggal'] = $this->model('Tanggal_model')->getTanggal();
		$data['tanggal_id'] = $this->model('Tanggal_model')->tanggalIndonesia();
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/master_data/tanggal', $data);
		$this->view('backend/layouts/footer');
	}

//DATA TRAINING

	public function data_training()
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';
		$data['negara'] = $this->model('Negara_model')->getNegara();
		$this->model('Data_training_model')->generateDataTraining($_POST);
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/data_training/data_training', $data);
		$this->view('backend/layouts/footer');
	}

	public function data_detail($id)
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';

		$this->model('Data_training_model')->crudDataTraining($id, $_POST);

		$data['negara'] = $this->model('Negara_model')->getNegaraById($id);
		$data['data_training'] = $this->model('Data_training_model')->getDataTraining($id);
		$data['tanggal_id'] = $this->model('Tanggal_model')->tanggalIndonesia();
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/data_training/detail', $data);
		$this->view('backend/layouts/footer');
	}

//DATA OLAH

	public function data_prediksi()
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';
		$data['negara'] = $this->model('Negara_model')->getNegara();
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/data_prediksi/data_prediksi', $data);
		$this->view('backend/layouts/footer');
	}

	public function prediksi_detail($id)
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';
		$data['negara'] = $this->model('Negara_model')->getNegaraById($id);
		$data['data_prediksi'] = $this->model('Data_prediksi_model')->getDataPrediksi($id);
		$data['error_prophet1'] = $this->model('Data_error_model')->getProphet($id);
		$data['error_prophet2'] = $this->model('Data_error_model')->getProphet($id);
		$data['error_svm1'] = $this->model('Data_error_model')->getSVM($id);
		$data['error_svm2'] = $this->model('Data_error_model')->getSVM($id);
		$this->model('Data_prediksi_model')->generateDataPrediksi($id);
		$data['last_update'] = $this->model('Data_prediksi_model')->checkLastUpdate($id);
		$data['tanggal_id'] = $this->model('Tanggal_model')->tanggalIndonesia();
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/data_prediksi/detail', $data);
		$this->view('backend/layouts/footer');
	}

//KONFIGURASI

	public function konfigurasi()
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';
		$this->view('backend/layouts/header', $data);
		$this->view('backend/layouts/sidebar');
		$this->view('backend/layouts/navbar');
		$this->view('backend/menu/konfigurasi/konfigurasi', $data);
		$this->view('backend/layouts/footer');
	}
}