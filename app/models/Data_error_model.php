<?php

class Data_error_model {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getProphet($id){
		$this->db->query("SELECT * FROM data_error WHERE negara_id = :id AND nama_error LIKE :nama_error");
		$this->db->bind('id', $id);
		$this->db->bind('nama_error', 'prophet%');
		return $this->db->get();
    }
	public function getSVM($id){
		$this->db->query("SELECT * FROM data_error WHERE negara_id = :id AND nama_error LIKE :nama_error");
		$this->db->bind('id', $id);
		$this->db->bind('nama_error', 'SVM%');
		return $this->db->get();
	}
	
	public function getKasusError($id){
		$this->db->query("SELECT data_error.*, negara.negara FROM data_error JOIN negara ON negara.id = negara_id WHERE negara_id = :id AND nama_error LIKE :nama_error");
		$this->db->bind('id', $id);
		$this->db->bind('nama_error', '%kasus');
		return $this->db->get();
	}
	
	public function getKasusErrorByName($name){
		$this->db->query("SELECT data_error.*, negara.negara FROM data_error JOIN negara ON negara.id = negara_id WHERE negara = :negara AND nama_error LIKE :nama_error");
		$this->db->bind('negara', $name);
		$this->db->bind('nama_error', '%kasus');
		return $this->db->get();
    }
}