<?php

class Negara_model {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getNegara(){
		$this->db->query('SELECT * FROM negara');
		return $this->db->get();
	}

	public function getNegaraById($id){
		$this->db->query('SELECT * FROM negara WHERE id='.$id);
		return $this->db->show();
	}

	public function crudNegara($data){
		if (isset($_POST['_method'])){
			if($_POST['_method'] == 'POST'){
				$this->db->query('SELECT * FROM negara WHERE negara='."'".$data['negara']."'");
				$this->db->execute();
				$isExist = $this->db->rowCount();
				if($isExist == 0){
					$query = "INSERT INTO negara(negara, created_at) VALUES (:negara, :created_at)";
					$this->db->query($query);
					$this->db->bind('negara', $data['negara']);
					$this->db->bind('created_at', date('Y-m-d H:i:s'));
					$this->db->execute();
					$isSuccess = $this->db->rowCount();
					if ($isSuccess > 0) {
						Flasher::setFlash('Negara berhasil ditambahkan', 'success');
						header('Location: '. base_url . 'admin/negara');
						exit;
					}else{
						Flasher::setFlash('Negara gagal ditambahkan', 'danger');
						header('Location: '. base_url . 'admin/negara');
						exit;
					}
					
				}else{
					Flasher::setFlash('Nama negara sudah ada', 'warning');
					header('Location: '. base_url . 'admin/negara');
					exit;
				}
			}elseif($_POST['_method'] == 'UPDATE'){
				$this->db->query('SELECT * FROM negara WHERE negara='."'".$data['negara']."'");
				$this->db->execute();
				$isExist = $this->db->rowCount();
				if($isExist == 0){
					$query = "UPDATE negara SET negara = :negara, updated_at = :updated_at WHERE id = :id";
					$this->db->query($query);
					$this->db->bind('id', $data['id']);
					$this->db->bind('negara', $data['negara']);
					$this->db->bind('updated_at', date('Y-m-d H:i:s'));
					$this->db->execute();
					$isSuccess = $this->db->rowCount();
					if ($isSuccess > 0) {
						Flasher::setFlash('Negara berhasil diubah', 'success');
						header('Location: '. base_url . 'admin/negara');
						exit;
					}else{
						Flasher::setFlash('Negara gagal diubah', 'danger');
						header('Location: '. base_url . 'admin/negara');
						exit;
					}
					
				}else{
					Flasher::setFlash('Nama negara sudah ada', 'warning');
					header('Location: '. base_url . 'admin/negara');
					exit;
				}
			}elseif($_POST['_method'] == 'DELETE'){
				$this->db->query('SELECT * FROM negara WHERE negara='."'".$data['negara']."'");
				$this->db->execute();
				$isExist = $this->db->rowCount();
				if($isExist >= 1){
					$query = "DELETE FROM negara WHERE id = :id";
					$this->db->query($query);
					$this->db->bind('id', $data['id']);
					$this->db->execute();
					$isSuccess = $this->db->rowCount();
					if ($isSuccess > 0) {
						Flasher::setFlash('Negara berhasil dihapus', 'success');
						header('Location: '. base_url . 'admin/negara');
						exit;
					}else{
						Flasher::setFlash('Negara gagal dihapus', 'danger');
						header('Location: '. base_url . 'admin/negara');
						exit;
					}
					
				}else{
					Flasher::setFlash('Nama negara tidak ada', 'warning');
					header('Location: '. base_url . 'admin/negara');
					exit;
				}
			}
		}
	}
}