<?php

class Tes_model {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getLastKasus($id){
		$this->db->query("SELECT data_training.*, negara.negara FROM data_training JOIN negara ON negara_id = negara.id WHERE negara_id= :id ORDER BY tanggal DESC LIMIT 1");
		$this->db->bind('id', $id);
		return $this->db->get();
	}

	public function getLastKasusRow($id){
		$this->db->query("SELECT data_training.*, negara.negara FROM data_training JOIN negara ON negara_id = negara.id WHERE negara_id= :id ORDER BY tanggal");
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function getLastNegara(){
		$this->db->query("SELECT data_training.*, negara.negara FROM data_training JOIN negara ON negara_id = negara.id WHERE negara_id= :id ORDER BY tanggal");
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function getKasusMinimal($id){
		$this->db->query("SELECT data_training.*, negara.negara, (data_training.kasus - data_training.meninggal - data_training.sembuh) AS minimal FROM data_training JOIN negara ON negara_id = negara.id WHERE negara_id= :id AND (data_training.kasus - data_training.meninggal - data_training.sembuh) != 0 ORDER BY minimal ASC LIMIT 1");
		$this->db->bind('id', $id);
		return $this->db->get();
	}

	public function getApa(){
		$this->db->query("SELECT negara_id AS id, negara, tanggal, kasus FROM negara JOIN data_training ON negara_id = negara.id WHERE tanggal = (SELECT tanggal FROM data_training ORDER BY tanggal DESC LIMIT 1)");
		return $this->db->get();
	}
}