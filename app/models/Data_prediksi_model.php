<?php

class Data_prediksi_model {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getDataPrediksi($id){
		$this->db->query("SELECT data_prediksi.*, negara.negara FROM data_prediksi JOIN negara ON negara_id = negara.id WHERE negara_id= :id ORDER BY tanggal");
		$this->db->bind('id', $id);
		return $this->db->get();
	}

	public function getDataPrediksiByName($name){
		$this->db->query("SELECT data_prediksi.*, negara.negara FROM data_prediksi JOIN negara ON negara_id = negara.id WHERE negara= :negara ORDER BY tanggal");
		$this->db->bind('negara', $name);
		return $this->db->get();
	}

	public function getFirstPrediksiByName($name){
		$this->db->query("SELECT data_prediksi.*, negara.negara FROM data_prediksi JOIN negara ON negara_id = negara.id WHERE negara = :negara AND NOT EXISTS (SELECT * FROM data_training WHERE data_training.tanggal = data_prediksi.tanggal) ORDER BY tanggal ASC LIMIT 1");
		$this->db->bind('negara', $name);
		return $this->db->get();
	}

	public function getLastPrediksiByName($name){
		$this->db->query("SELECT data_prediksi.*, negara.negara FROM data_prediksi JOIN negara ON negara_id = negara.id WHERE negara = :negara AND NOT EXISTS (SELECT * FROM data_training WHERE data_training.tanggal = data_prediksi.tanggal) ORDER BY tanggal DESC LIMIT 1");
		$this->db->bind('negara', $name);
		return $this->db->get();
	}

	public function getDataPrediksiByTanggal($negara, $tanggal){
		$this->db->query("SELECT data_prediksi.*, negara.negara FROM data_prediksi JOIN negara ON negara_id = negara.id WHERE negara = :negara AND tanggal = :tanggal ORDER BY tanggal");
		$this->db->bind('negara', $negara);
		$this->db->bind('tanggal', $tanggal);
		return $this->db->get();
	}

	public function generateDataPrediksi($id){
		// ignore_user_abort(true);
		// set_time_limit(0);
		if (isset($_POST['_method'])){
			if($_POST['_method'] == 'POST'){

				$data = file_get_contents("http://127.0.0.1:5000/api/negara/".$id."/prediksi/");
				if($data){
				
					$data = json_decode($data);

					foreach ($data->error_data as $error_data) {
						$this->db->query('SELECT * FROM data_error WHERE negara_id = :negara_id AND nama_error = :nama_error');
						$this->db->bind('negara_id', $id);
						$this->db->bind('nama_error', $error_data->index);
						$this->db->execute();
						$isErrorExist = $this->db->rowCount();
						if($isErrorExist == 0){
							$query = "INSERT INTO data_error(negara_id, MAE, MAPE, MSE, nama_error, created_at) VALUES (:negara_id, :MAE, :MAPE, :MSE, :nama_error, :created_at)";
							$this->db->query($query);
							$this->db->bind('negara_id', $id);
							$this->db->bind('MAE', $error_data->MAE);
							$this->db->bind('MAPE', $error_data->MAPE);
							$this->db->bind('MSE', $error_data->MSE);
							$this->db->bind('nama_error', $error_data->index);
							$this->db->bind('created_at', date('Y-m-d H:i:s'));
							$this->db->execute();
						}else{
							$isErrorChange = $this->db->show();
							if($isErrorChange['MAE'] != $error_data->MAE || $isErrorChange['MAPE'] != $error_data->MAPE || $isErrorChange['MSE'] != $error_data->MSE){
								$query = "UPDATE data_error SET MAE = :MAE, MAPE = :MAPE, MSE = :MSE, updated_at = :updated_at WHERE negara_id = :negara_id AND nama_error = :nama_error";
								$this->db->query($query);
								$this->db->bind('negara_id', $id);
								$this->db->bind('MAE', $error_data->MAE);
								$this->db->bind('MAPE', $error_data->MAPE);
								$this->db->bind('MSE', $error_data->MSE);
								$this->db->bind('nama_error', $error_data->index);
								$this->db->bind('updated_at', date('Y-m-d H:i:s'));
								$this->db->execute();
							}
						}
					}

					foreach ($data->data as $data) {
						$this->db->query('SELECT * FROM data_prediksi WHERE negara_id = :negara_id AND tanggal = :tanggal');
						$this->db->bind('negara_id', $id);
						$this->db->bind('tanggal', $data->tanggal);
						$this->db->execute();
						$isExist = $this->db->rowCount();
						if($isExist == 0){
							$query = "INSERT INTO data_prediksi(negara_id, tanggal, kasus_prophet, meninggal_prophet, sembuh_prophet, aktif_prophet, kasus_svm, meninggal_svm, sembuh_svm, aktif_svm, created_at) VALUES (:negara_id, :tanggal, :kasus_prophet, :meninggal_prophet, :sembuh_prophet, :aktif_prophet, :kasus_svm, :meninggal_svm, :sembuh_svm, :aktif_svm, :created_at)";
							$this->db->query($query);
							$this->db->bind('negara_id', $id);
							$this->db->bind('tanggal', $data->tanggal);
							$this->db->bind('kasus_prophet', $data->prophet_kasus);
							$this->db->bind('meninggal_prophet', $data->prophet_meninggal);
							$this->db->bind('sembuh_prophet', $data->prophet_sembuh);
							$this->db->bind('aktif_prophet', $data->prophet_aktif);
							$this->db->bind('kasus_svm', $data->svm_kasus);
							$this->db->bind('meninggal_svm', $data->svm_meninggal);
							$this->db->bind('sembuh_svm', $data->svm_sembuh);
							$this->db->bind('aktif_svm', $data->svm_aktif);
							$this->db->bind('created_at', date('Y-m-d H:i:s'));
							$this->db->execute();
						}else{
							$isChange = $this->db->show();
							if($isChange['kasus_prophet'] != $data->prophet_kasus || $isChange['meninggal_prophet'] != $data->prophet_meninggal || $isChange['sembuh_prophet'] != $data->prophet_sembuh || $isChange['aktif_prophet'] != $data->prophet_aktif || $isChange['kasus_svm'] != $data->svm_kasus || $isChange['meninggal_svm'] != $data->svm_meninggal || $isChange['sembuh_svm'] != $data->svm_sembuh || $isChange['aktif_svm'] != $data->svm_aktif){
								$query = "UPDATE data_prediksi SET kasus_prophet = :kasus_prophet, meninggal_prophet = :meninggal_prophet, sembuh_prophet = :sembuh_prophet, aktif_prophet = :aktif_prophet, kasus_svm = :kasus_svm, meninggal_svm = :meninggal_svm, sembuh_svm = :sembuh_svm, aktif_svm = :aktif_svm, updated_at = :updated_at WHERE negara_id = :negara_id AND tanggal = :tanggal";
								$this->db->query($query);
								$this->db->bind('negara_id', $id);
								$this->db->bind('tanggal', $data->tanggal);
								$this->db->bind('kasus_prophet', $data->prophet_kasus);
								$this->db->bind('meninggal_prophet', $data->prophet_meninggal);
								$this->db->bind('sembuh_prophet', $data->prophet_sembuh);
								$this->db->bind('aktif_prophet', $data->prophet_aktif);
								$this->db->bind('kasus_svm', $data->svm_kasus);
								$this->db->bind('meninggal_svm', $data->svm_meninggal);
								$this->db->bind('sembuh_svm', $data->svm_sembuh);
								$this->db->bind('aktif_svm', $data->svm_aktif);
								$this->db->bind('updated_at', date('Y-m-d H:i:s'));
								$this->db->execute();
							}
						}
					}
					Flasher::setFlash('Data prediksi berhasil ditambahkan/diperbaharui', 'success');
				}else{
					Flasher::setFlash('Machine Learning Tidak Terhubung', 'danger');
				}
				header('Location: '. base_url . 'admin/prediksi_detail/'.$id);
				exit;
			}
		}
	}
	
	public function checkLastUpdate($id)
	{
		$this->db->query('SELECT * FROM data_prediksi WHERE negara_id='.$id.' ORDER BY updated_at DESC');
		return $this->db->show();
	}
}