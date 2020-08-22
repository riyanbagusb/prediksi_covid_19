<?php

class Data_training_model {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getDataTraining($id){
		$this->db->query("SELECT data_training.*, negara.negara FROM data_training JOIN negara ON negara_id = negara.id WHERE negara_id= :id ORDER BY tanggal");
		$this->db->bind('id', $id);
		return $this->db->get();
	}

	public function getDataTrainingByName($name){
		$this->db->query("SELECT data_training.*, negara.negara FROM data_training JOIN negara ON negara_id = negara.id WHERE negara= :negara ORDER BY tanggal");
		$this->db->bind('negara', $name);
		return $this->db->get();
	}

	public function sumDataTraining($id){
		$this->db->query("SELECT negara.id, negara, kasus AS total_kasus, meninggal AS total_meninggal, sembuh AS total_sembuh FROM data_training JOIN negara ON negara_id = negara.id WHERE negara_id= :id ORDER BY tanggal DESC LIMIT 1");
		$this->db->bind('id', $id);
		return $this->db->get();
	}

	public function sumDataTrainingByName($name){
		$this->db->query("SELECT negara.id, negara, kasus AS total_kasus, meninggal AS total_meninggal, sembuh AS total_sembuh FROM data_training JOIN negara ON negara_id = negara.id WHERE negara= :negara ORDER BY tanggal DESC LIMIT 1");
		$this->db->bind('negara', $name);
		return $this->db->get();
	}

	public function generateDataTraining($generate_data){
		if (isset($_POST['_method'])){
			if($_POST['_method'] == 'POST'){
				
				$data = file_get_contents("http://127.0.0.1:5000/api/generate/".$generate_data['negara']);
				if($data){
				
					$data = json_decode($data);

					if($data->data != null){
						foreach ($data->data as $data) {
							$this->db->query('SELECT * FROM data_training WHERE negara_id = :negara_id AND tanggal = :tanggal');
							$this->db->bind('negara_id', $generate_data['id']);
							$this->db->bind('tanggal', $data->Tanggal);
							$this->db->execute();
							$isExist = $this->db->rowCount();
							if($isExist == 0){
								$query = "INSERT INTO data_training(negara_id, tanggal, kasus, meninggal, sembuh, created_at) VALUES (:negara_id, :tanggal, :kasus, :meninggal, :sembuh, :created_at)";
								$this->db->query($query);
								$this->db->bind('negara_id', $generate_data['id']);
								$this->db->bind('tanggal', $data->Tanggal);
								$this->db->bind('kasus', $data->Terkonfirmasi);
								$this->db->bind('meninggal', $data->Meninggal);
								$this->db->bind('sembuh', $data->Pulih);
								$this->db->bind('created_at', date('Y-m-d H:i:s'));
								$this->db->execute();
							}
						}
						Flasher::setFlash('Data training berhasil ditambahkan', 'success');
					}else{
						Flasher::setFlash('Data John Hopkins tidak tersedia', 'danger');
					}
				}else{
					Flasher::setFlash('Data John Hopkins tidak tersedia', 'danger');
				}
				header('Location: '. base_url . 'admin/data_training/');
				exit;
			}
		}
	}

	public function crudDataTraining($id, $data){
		if (isset($_POST['_method'])){
			if($_POST['_method'] == 'POST'){
				$this->db->query('SELECT * FROM data_training WHERE negara_id ='.$id.' AND tanggal = "'.$data['tanggal'].'"');
				$this->db->execute();
				$isExist = $this->db->rowCount();
				if($isExist == 0){
					$query = "INSERT INTO data_training(negara_id, tanggal, kasus, meninggal, sembuh, created_at) VALUES (:negara_id, :tanggal, :kasus, :meninggal, :sembuh, :created_at)";
					$this->db->query($query);
					$this->db->bind('negara_id', $id);
					$this->db->bind('tanggal', $data['tanggal']);
					$this->db->bind('kasus', $data['kasus']);
					$this->db->bind('meninggal', $data['meninggal']);
					$this->db->bind('sembuh', $data['sembuh']);
					$this->db->bind('created_at', date('Y-m-d H:i:s'));
					$this->db->execute();
					$isSuccess = $this->db->rowCount();
					if ($isSuccess > 0) {
						Flasher::setFlash('Data berhasil ditambahkan', 'success');
						header('Location: '. base_url . 'admin/data_detail/'.$id);
						exit;
					}else{
						Flasher::setFlash('Data gagal ditambahkan', 'danger');
						header('Location: '. base_url . 'admin/data_detail/'.$id);
						exit;
					}
					
				}else{
					Flasher::setFlash('Data pada tanggal ini sudah ada', 'warning');
					header('Location: '. base_url . 'admin/data_detail/'.$id);
					exit;
				}
			}elseif($_POST['_method'] == 'UPDATE'){
				$query = "UPDATE data_training SET kasus = :kasus, meninggal = :meninggal, sembuh = :sembuh, updated_at = :updated_at WHERE id = :id";
				$this->db->query($query);
				$this->db->bind('id', $data['id']);
				$this->db->bind('kasus', $data['kasus']);
				$this->db->bind('meninggal', $data['meninggal']);
				$this->db->bind('sembuh', $data['sembuh']);
				$this->db->bind('updated_at', date('Y-m-d H:i:s'));
				$this->db->execute();
				$isSuccess = $this->db->rowCount();
				if ($isSuccess > 0) {
					Flasher::setFlash('Data berhasil diubah', 'success');
					header('Location: '. base_url . 'admin/data_detail/'.$id);
					exit;
				}else{
					Flasher::setFlash('Data gagal diubah', 'danger');
					header('Location: '. base_url . 'admin/data_detail/'.$id);
					exit;
				}
			}elseif($_POST['_method'] == 'DELETE'){
				$this->db->query('SELECT * FROM data_training WHERE negara_id ='.$id.' AND id='.$data['id']);
				$this->db->execute();
				$isExist = $this->db->rowCount();
				if($isExist > 0){
					$query = "DELETE FROM data_training WHERE id = :id";
					$this->db->query($query);
					$this->db->bind('id', $data['id']);
					$this->db->execute();
					$isSuccess = $this->db->rowCount();
					if ($isSuccess > 0) {
						Flasher::setFlash('Data berhasil dihapus', 'success');
						header('Location: '. base_url . 'admin/data_detail/'.$id);
						exit;
					}else{
						Flasher::setFlash('Data gagal dihapus', 'danger');
						header('Location: '. base_url . 'admin/data_detail/'.$id);
						exit;
					}
					
				}else{
					Flasher::setFlash('Data tidak ada', 'warning');
					header('Location: '. base_url . 'admin/data_detail/'.$id);
					exit;
				}
			}
		}
	}
}