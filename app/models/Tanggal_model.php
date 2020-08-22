<?php

class Tanggal_model {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getTanggal(){
		$this->db->query('SELECT * FROM tanggal ORDER BY tanggal');
		return $this->db->get();
	}

	public function tanggalIndonesia(){
		function bulanIndonesia($bln){
			switch ($bln) {
				case 1: return "Januari";
				break;
				case 2: return "Februari";
				break;
				case 3: return "Maret";
				break;
				case 4: return "April";
				break;
				case 5: return "Mei";
				break;
				case 6: return "Juni";
				break;
				case 7: return "Juli";
				break;
				case 8: return "Agustus";
				break;
				case 9: return "September";
				break;
				case 10: return "Oktober";
				break;
				case 11: return "November";
				break;
				case 12: return "Desember";
				break;
			}
		}
		
		function tanggal($date) {
			$temp_date = explode("-", $date);
			$day = date_format(date_create($date), 'D');
			$hari = '';
			switch ($day) {
				case "Mon": $hari = "Senin";
				break;
				case "Tue": $hari = "Selasa";
				break;
				case "Wed": $hari = "Rabu";
				break;
				case "Thu": $hari = "Kamis";
				break;
				case "Fri": $hari =  "Jumat";
				break;
				case "Sat": $hari = "Sabtu";
				break;
				case "Sun": $hari = "Minggu";
				break;
			}
			$tanggal = $temp_date[0];
			$bulan   = bulanIndonesia($temp_date[1]);
			$tahun  = $temp_date[2];
			return $tanggal." ".$bulan." ".$tahun;
		}
	}

	public function crudTanggal($data){
		if (isset($_POST['_method'])){
			if($_POST['_method'] == 'POST'){
				$this->db->query('SELECT * FROM tanggal WHERE tanggal='."'".$data['tanggal']."'");
				$this->db->execute();
				$isExist = $this->db->rowCount();
				if($isExist == 0){
					$query = "INSERT INTO tanggal(tanggal, created_at) VALUES (:tanggal, :created_at)";
					$this->db->query($query);
					$this->db->bind('tanggal', $data['tanggal']);
					$this->db->bind('created_at', date('Y-m-d H:i:s'));
					$this->db->execute();
					$isSuccess = $this->db->rowCount();
					if ($isSuccess > 0) {
						Flasher::setFlash('Tanggal berhasil ditambahkan', 'success');
						header('Location: '. base_url . 'admin/tanggal');
						exit;
					}else{
						Flasher::setFlash('Tanggal gagal ditambahkan', 'danger');
						header('Location: '. base_url . 'admin/tanggal');
						exit;
					}
					
				}else{
					Flasher::setFlash('Tanggal sudah ada', 'warning');
					header('Location: '. base_url . 'admin/tanggal');
					exit;
				}
			}elseif($_POST['_method'] == 'UPDATE'){
				$this->db->query('SELECT * FROM tanggal WHERE tanggal='."'".$data['tanggal']."'");
				$this->db->execute();
				$isExist = $this->db->rowCount();
				if($isExist == 0){
					$query = "UPDATE tanggal SET tanggal = :tanggal, updated_at = :updated_at WHERE id = :id";
					$this->db->query($query);
					$this->db->bind('id', $data['id']);
					$this->db->bind('tanggal', $data['tanggal']);
					$this->db->bind('updated_at', date('Y-m-d H:i:s'));
					$this->db->execute();
					$isSuccess = $this->db->rowCount();
					if ($isSuccess > 0) {
						Flasher::setFlash('Tanggal berhasil diubah', 'success');
						header('Location: '. base_url . 'admin/tanggal');
						exit;
					}else{
						Flasher::setFlash('Tanggal gagal diubah', 'danger');
						header('Location: '. base_url . 'admin/tanggal');
						exit;
					}
					
				}else{
					Flasher::setFlash('Tanggal sudah ada', 'warning');
					header('Location: '. base_url . 'admin/tanggal');
					exit;
				}
			}elseif($_POST['_method'] == 'DELETE'){
				$this->db->query('SELECT * FROM tanggal WHERE tanggal='."'".$data['tanggal']."'");
				$this->db->execute();
				$isExist = $this->db->rowCount();
				if($isExist >= 1){
					$query = "DELETE FROM tanggal WHERE id = :id";
					$this->db->query($query);
					$this->db->bind('id', $data['id']);
					$this->db->execute();
					$isSuccess = $this->db->rowCount();
					if ($isSuccess > 0) {
						Flasher::setFlash('Tanggal berhasil dihapus', 'success');
						header('Location: '. base_url . 'admin/tanggal');
						exit;
					}else{
						Flasher::setFlash('Tanggal gagal dihapus', 'danger');
						header('Location: '. base_url . 'admin/tanggal');
						exit;
					}
					
				}else{
					Flasher::setFlash('Tanggal tidak ada', 'warning');
					header('Location: '. base_url . 'admin/tanggal');
					exit;
				}
			}
		}
	}
}