<?php

class Api extends Controller {

	public function __construct()
	{

	}
	
	public function index()
	{
		$data['url'] = ['negara(id/name)', 'prediksi(id/name)', 'counter(id/name)', 'error(id/name)'];
		$response = $this->model('Api_model')->response(200, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		return $response;
	}

	public function negara($id=0)
	{
		if(is_numeric($id)){
			if($id == 0){
				$data = $this->model('Negara_model')->getNegara();
			}else{
				$data = $this->model('Data_training_model')->getDataTraining($id);
			}
		}else{
			$data = $this->model('Data_training_model')->getDataTrainingByName($id);
		}
		if(empty($data)){
			$response = $this->model('Api_model')->response(404, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}else{
			$response = $this->model('Api_model')->response(200, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}
		return $response;
	}

	public function counter($id=0)
	{
		if(is_numeric($id)){
			if($id == 0){
				$data = $this->model('Negara_model')->getNegara();
			}else{
				$data = $this->model('Data_training_model')->sumDataTraining($id);
			}
		}else{
			$data = $this->model('Data_training_model')->sumDataTrainingByName($id);
		}
		if(empty($data[0]['id'] != null)){
			$response = $this->model('Api_model')->response(404, 'Selamat Datang di Sistem Prediksi COVID-19', $data = []);
		}else{
			$response = $this->model('Api_model')->response(200, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}
		return $response;
	}

	public function prediksi($id=0)
	{
		if(is_numeric($id)){
			if($id == 0 || $id > 100){
				$data = $this->model('Negara_model')->getNegara();	
			}else{
				$data = $this->model('Data_prediksi_model')->getDataPrediksi($id);
			}
		}else{
			$data = $this->model('Data_prediksi_model')->getDataPrediksiByName($id);
		}
		if(empty($data)){
			$response = $this->model('Api_model')->response(404, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}else{
			$response = $this->model('Api_model')->response(200, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}
		return $response;
	}

	public function selisih_prediksi($negara = 'indonesia', $tanggal = '2020-04-03')
	{
		$data = $this->model('Data_prediksi_model')->getDataPrediksiByTanggal($negara, $tanggal);
		if(empty($data)){
			$response = $this->model('Api_model')->response(404, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}else{
			$response = $this->model('Api_model')->response(200, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}
		return $response;
	}

	public function rekomendasi($id=0)
	{
		if(is_numeric($id)){
			if($id == 0){
				$data = $this->model('Negara_model')->getNegara();
			}else{
				$data['data_faktual'] = $this->model('Data_training_model')->sumDataTraining($id);
				$data['data_prediksi']['awal'] = $this->model('Data_prediksi_model')->getFirstPrediksiByName($id);
				$data['data_prediksi']['akhir'] = $this->model('Data_prediksi_model')->getLastPrediksiByName($id);
				$data['error'] = $this->model('Data_error_model')->getKasusError($id);
			}
		}else{
			$data['data_faktual'] = $this->model('Data_training_model')->sumDataTrainingByName($id);
			$data['data_prediksi']['awal'] = $this->model('Data_prediksi_model')->getFirstPrediksiByName($id);
			$data['data_prediksi']['akhir'] = $this->model('Data_prediksi_model')->getLastPrediksiByName($id);
			$data['error'] = $this->model('Data_error_model')->getKasusErrorByName($id);
		}
		if(empty($data)){
			$response = $this->model('Api_model')->response(404, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}else{
			$response = $this->model('Api_model')->response(200, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}
		return $response;
	}

	public function data_rekomendasi($id=0)
	{
		if($id == 0){
			$data = $this->model('Rekomendasi_model')->getRekomendasi($id);
		}else{
			$data = $this->model('Rekomendasi_model')->getRekomendasiByKondisi($id);
		}

		if(empty($data)){
			$response = $this->model('Api_model')->response(404, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}else{
			$response = $this->model('Api_model')->response(200, 'Selamat Datang di Sistem Prediksi COVID-19', $data);
		}
		return $response;
	}

}