<?php

class Rekomendasi_model {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getRekomendasi(){
		$this->db->query('SELECT * FROM data_rekomendasi ORDER BY kondisi ASC');
		return $this->db->get();
	}

	public function getRekomendasiByKondisi($kondisi){
		if ($kondisi < 5) {
			$kondisi = 5;
		}
		$this->db->query('SELECT * FROM data_rekomendasi where kondisi <= :kondisi ORDER BY kondisi ASC');
		$this->db->bind('kondisi', $kondisi);
		return $this->db->get();
	}
	
	public function crudRekomendasi($data){
		if (isset($_POST['_method'])){
			if($_POST['_method'] == 'POST'){
				$query = "INSERT INTO data_rekomendasi(kondisi, rekomendasi, created_at) VALUES (:kondisi, :rekomendasi, :created_at)";
				$this->db->query($query);
				$this->db->bind('kondisi', $data['kondisi']);
				$this->db->bind('rekomendasi', $data['rekomendasi']);
				$this->db->bind('created_at', date('Y-m-d H:i:s'));
				$this->db->execute();
				$isSuccess = $this->db->rowCount();
				if ($isSuccess > 0) {
					Flasher::setFlash('Rekomendasi berhasil ditambahkan', 'success');
					header('Location: '. base_url . 'admin/rekomendasi');
					exit;
				}else{
					Flasher::setFlash('Rekomendasi gagal ditambahkan', 'danger');
					header('Location: '. base_url . 'admin/rekomendasi');
					exit;
				}
			}elseif($_POST['_method'] == 'UPDATE'){
				$query = "UPDATE data_rekomendasi SET kondisi = :kondisi, rekomendasi = :rekomendasi, updated_at = :updated_at WHERE id = :id";
				$this->db->query($query);
				$this->db->bind('id', $data['id']);
				$this->db->bind('kondisi', $data['kondisi']);
				$this->db->bind('rekomendasi', $data['rekomendasi']);
				$this->db->bind('updated_at', date('Y-m-d H:i:s'));
				$this->db->execute();
				$isSuccess = $this->db->rowCount();
				if ($isSuccess > 0) {
					Flasher::setFlash('Rekomendasi berhasil diubah', 'success');
					header('Location: '. base_url . 'admin/rekomendasi');
					exit;
				}else{
					Flasher::setFlash('Rekomendasi gagal diubah', 'danger');
					header('Location: '. base_url . 'admin/rekomendasi');
					exit;
				}
			}elseif($_POST['_method'] == 'DELETE'){
				$query = "DELETE FROM data_rekomendasi WHERE id = :id";
				$this->db->query($query);
				$this->db->bind('id', $data['id']);
				$this->db->execute();
				$isSuccess = $this->db->rowCount();
				if ($isSuccess > 0) {
					Flasher::setFlash('Rekomendasi berhasil dihapus', 'success');
					header('Location: '. base_url . 'admin/rekomendasi');
					exit;
				}else{
					Flasher::setFlash('Rekomendasi gagal dihapus', 'danger');
					header('Location: '. base_url . 'admin/rekomendasi');
					exit;
				}
			}
		}
	}
}