<?php

class Admin_model {
	
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	// // // // TANGGAL INDONESIA // // // //
	public function tanggalId(){
		function bulanId($bln){
			switch ($bln) {
				case 1: 
				return "Januari";
				break;
				case 2:
				return "Februari";
				break;
				case 3:
				return "Maret";
				break;
				case 4:
				return "April";
				break;
				case 5:
				return "Mei";
				break;
				case 6:
				return "Juni";
				break;
				case 7:
				return "Juli";
				break;
				case 8:
				return "Agustus";
				break;
				case 9:
				return "September";
				break;
				case 10:
				return "Oktober";
				break;
				case 11:
				return "November";
				break;
				case 12:
				return "Desember";
				break;
			}
		}
		function bulanRomawi($bln){
			switch ($bln) {
				case 1: 
				return "I";
				break;
				case 2:
				return "II";
				break;
				case 3:
				return "III";
				break;
				case 4:
				return "IV";
				break;
				case 5:
				return "V";
				break;
				case 6:
				return "VI";
				break;
				case 7:
				return "VII";
				break;
				case 8:
				return "VIII";
				break;
				case 9:
				return "IX";
				break;
				case 10:
				return "X";
				break;
				case 11:
				return "XI";
				break;
				case 12:
				return "XII";
				break;
			}
		}
		function dateId($date) {
			$temp_date = explode("-", $date);
			$day = date_format(date_create($date), 'D');
			$hari = '';
			switch ($day) {
				case "Mon": 
				$hari = "Senin";
				break;
				case "Tue":
				$hari = "Selasa";
				break;
				case "Wed":
				$hari = "Rabu";
				break;
				case "Thu":
				$hari = "Kamis";
				break;
				case "Fri":
				$hari =  "Jumat";
				break;
				case "Sat":
				$hari = "Sabtu";
				break;
				case "Sun":
				$hari = "Minggu";
				break;
			}
			$tanggal = $temp_date[0];
			$bulan   = bulanId($temp_date[1]);
			$tahun  = $temp_date[2];
			return $hari.", ".$tanggal." ".$bulan." ".$tahun;
		}
		function dateRomawi($date) {
			$temp_date = explode("-", $date);
			$day = date_format(date_create($date), 'D');
			$hari = '';
			switch ($day) {
				case "Mon": 
				$hari = "Senin";
				break;
				case "Tue":
				$hari = "Selasa";
				break;
				case "Wed":
				$hari = "Rabu";
				break;
				case "Thu":
				$hari = "Kamis";
				break;
				case "Fri":
				$hari =  "Jumat";
				break;
				case "Sat":
				$hari = "Sabtu";
				break;
				case "Sun":
				$hari = "Minggu";
				break;
			}
			$tanggal = $temp_date[0];
			$bulan   = bulanRomawi($temp_date[1]);
			$tahun  = $temp_date[2];
			return $bulan;
		}
	}
	
	// // // // DASHBOARD // // // //
	public function countProduk(){
		$this->db->query("SELECT COUNT(id) FROM produk");
		return $this->db->getAll();
	}
	public function countPerusahaan(){
		$this->db->query("SELECT COUNT(id) FROM perusahaan");
		return $this->db->getAll();
	}
	//reference to PERUSAHAAN PESERTA
	public function countPeserta(){
		$this->db->query("SELECT COUNT(id) FROM peserta");
		return $this->db->getAll();
	}
	
	public function countProdukByPerusahaan(){	
		$this->db->query("SELECT COUNT(id_produk) FROM produk JOIN perusahaan ON produk.id = perusahaan.id_produk WHERE produk.id");
		return $this->db->getAll();
	}

	// // // // PRODUK // // // //
	public function getProduk(){
		$this->db->query('SELECT * FROM produk');
		return $this->db->getAll();
	}
	public function getProdukCount($data){
		if(isset($data['bulan']) && !isset($data['tahun'])){
			$query = 'SELECT kode_produk, nama_produk, nama_perusahaan, id_produk, YEAR(tanggal_kegiatan) AS tahun, MONTH(tanggal_kegiatan) AS bulan, COUNT(*) AS total FROM produk JOIN perusahaan ON produk.id = perusahaan.id_produk JOIN jadwal_kegiatan ON perusahaan.id = jadwal_kegiatan.id_perusahaan WHERE MONTH(tanggal_kegiatan) = :bulan GROUP BY produk.id';
			$this->db->query($query);
			$this->db->bind('bulan', $data['bulan']);
		}elseif(!isset($data['bulan']) && isset($data['tahun'])){
			$query = 'SELECT kode_produk, nama_produk, nama_perusahaan, id_produk, YEAR(tanggal_kegiatan) AS tahun, MONTH(tanggal_kegiatan) AS bulan, COUNT(*) AS total FROM produk JOIN perusahaan ON produk.id = perusahaan.id_produk JOIN jadwal_kegiatan ON perusahaan.id = jadwal_kegiatan.id_perusahaan WHERE YEAR(tanggal_kegiatan) = :tahun GROUP BY produk.id';
			$this->db->query($query);
			$this->db->bind('tahun', $data['tahun']);
		}elseif(isset($data['bulan']) && isset($data['tahun'])){
			$query = 'SELECT kode_produk, nama_produk, nama_perusahaan, id_produk, YEAR(tanggal_kegiatan) AS tahun, MONTH(tanggal_kegiatan) AS bulan, COUNT(*) AS total FROM produk JOIN perusahaan ON produk.id = perusahaan.id_produk JOIN jadwal_kegiatan ON perusahaan.id = jadwal_kegiatan.id_perusahaan WHERE MONTH(tanggal_kegiatan) = :bulan AND YEAR(tanggal_kegiatan) = :tahun GROUP BY produk.id';
			$this->db->query($query);
			$this->db->bind('bulan', $data['bulan']);
			$this->db->bind('tahun', $data['tahun']);
		}else{
			$query = 'SELECT produk.id,kode_produk,nama_produk,COUNT(id_produk) AS total FROM `produk` JOIN perusahaan ON produk.id = perusahaan.id_produk GROUP BY produk.id';
			$this->db->query($query);
		}
		return $this->db->getAll();
	}
	public function yearFirst(){
		$this->db->query('SELECT YEAR(jadwal_kegiatan.tanggal_kegiatan) AS tahun FROM `produk` JOIN perusahaan ON produk.id = perusahaan.id_produk JOIN jadwal_kegiatan ON perusahaan.id = jadwal_kegiatan.id_perusahaan ORDER BY tahun ASC');
		return $this->db->get();
	}
	public function yearLast(){
		$this->db->query('SELECT YEAR(jadwal_kegiatan.tanggal_kegiatan) AS tahun FROM `produk` JOIN perusahaan ON produk.id = perusahaan.id_produk JOIN jadwal_kegiatan ON perusahaan.id = jadwal_kegiatan.id_perusahaan ORDER BY tahun DESC');
		return $this->db->get();
	}
	public function tambahProduk($data){
		$query = "INSERT INTO produk VALUES ('', :kode_produk, :nama_produk)";
		$this->db->query($query);
		$this->db->bind('kode_produk', $data['kode_produk']);
		$this->db->bind('nama_produk', $data['nama_produk']);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function ubahProduk($data){
		$query = "UPDATE produk SET kode_produk = :kode_produk, nama_produk = :nama_produk WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $data['id']);
		$this->db->bind('kode_produk', $data['kode_produk']);
		$this->db->bind('nama_produk', $data['nama_produk']);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function hapusProduk($id){
		$query = "DELETE FROM produk WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}

	// // // // PERUSAHAAN // // // //
	public function getPerusahaan(){
		$this->db->query("SELECT perusahaan.id, nama_perusahaan, id_produk, kode_produk, nama_produk FROM perusahaan LEFT JOIN produk ON perusahaan.id_produk = produk.id");
		return $this->db->getAll();
	}
	public function tambahPerusahaan($data){
		$query = "INSERT INTO perusahaan VALUES ('', :nama_perusahaan, :id_produk, '')";
		$this->db->query($query);
		$this->db->bind('nama_perusahaan', $data['nama_perusahaan']);
		$this->db->bind('id_produk', $data['id_produk']);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function ubahPerusahaan($data){
		$query = "UPDATE perusahaan SET nama_perusahaan = :nama_perusahaan, id_produk = :id_produk WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $data['id']);
		$this->db->bind('nama_perusahaan', $data['nama_perusahaan']);
		$this->db->bind('id_produk', $data['id_produk']);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function hapusPerusahaan($id){
		$query = "DELETE FROM perusahaan WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}

	// // // // PERUSAHAAN PESERTA // // // //
	public function getPerusahaanById($id){
		$this->db->query("SELECT * FROM perusahaan WHERE id = :id");
		$this->db->bind('id', $id);
		return $this->db->get();
	}
	public function getPesertaByPerusahaan($id){
		$this->db->query("SELECT peserta.id, nama_perusahaan, id_produk, informasi, nama_peserta, nomor_sertifikat, `status`, tanggal_kegiatan FROM perusahaan LEFT JOIN peserta ON perusahaan.id = peserta.id_perusahaan LEFT JOIN jadwal_kegiatan ON perusahaan.id = jadwal_kegiatan.id_perusahaan WHERE perusahaan.id = :id");
		$this->db->bind('id', $id);
		return $this->db->getAll();
	}
	public function tambahPeserta($data){
		$query = "INSERT INTO peserta VALUES ('', :nama_peserta, :id_perusahaan, :nomor_sertifikat, :status)";
		$this->db->query($query);
		$this->db->bind('nama_peserta', $data['nama_peserta']);
		$this->db->bind('id_perusahaan', $data['id_perusahaan']);
		$this->db->bind('nomor_sertifikat', $data['nomor_sertifikat']);
		$this->db->bind('status', $data['status']);
		// $this->db->bind('tanggal_kehadiran', $data['tanggal_kehadiran']);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function getPesertaById($id){
		$this->db->query("SELECT * FROM peserta WHERE peserta.id = :id");
		$this->db->bind('id', $id);
		return $this->db->get();
	}
	public function getPesertaJoin($id){
		$this->db->query("SELECT * FROM peserta LEFT JOIN perusahaan ON peserta.id_perusahaan = perusahaan.id LEFT JOIN produk ON perusahaan.id_produk = produk.id LEFT JOIN jadwal_kegiatan ON jadwal_kegiatan.id_perusahaan = perusahaan.id WHERE peserta.id = :id");
		$this->db->bind('id', $id);
		return $this->db->get();
	}
	public function ubahPeserta($data){
		$query = "UPDATE peserta SET nama_peserta = :nama_peserta, id_perusahaan = :id_perusahaan, status = :status WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $data['id_peserta']);
		$this->db->bind('nama_peserta', $data['nama_peserta']);
		$this->db->bind('id_perusahaan', $data['id_perusahaan']);
		$this->db->bind('status', $data['status']);
		// $this->db->bind('tanggal_kehadiran', $data['tanggal_kehadiran']);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function hapusPeserta($id){
		$query = "DELETE FROM peserta WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function ubahInformasi($data){
		$query = "UPDATE perusahaan SET informasi = :informasi WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $data['id']);
		$this->db->bind('informasi', $data['informasi']);
		$this->db->execute();
		return $this->db->rowCount();
	}

	// // // // JADWAL KEGIATAN // // // //
	public function getJadwal(){
		$this->db->query('SELECT jadwal_kegiatan.id,tanggal_kegiatan,id_perusahaan,nama_perusahaan,id_produk,kode_produk,nama_produk FROM jadwal_kegiatan LEFT JOIN perusahaan ON jadwal_kegiatan.id_perusahaan = perusahaan.id LEFT JOIN produk ON perusahaan.id_produk = produk.id ORDER BY tanggal_kegiatan DESC');
		return $this->db->getAll();
	}
	public function tambahJadwal($data){
		
		// $this->db->bind('nama_kegiatan', $data['nama_kegiatan']);
		$id = $this->db->query('SELECT id FROM perusahaan ORDER BY id DESC');
		$id2 = $this->db->get();
		$query = "INSERT INTO jadwal_kegiatan VALUES ('', :tanggal_kegiatan, :id_perusahaan)";
		$this->db->query($query);
		$this->db->bind('tanggal_kegiatan', $data['tanggal_kegiatan']);
		$this->db->bind('id_perusahaan', $id2['id']);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function getJadwalById($id){
		$this->db->query('SELECT * FROM jadwal_kegiatan WHERE id_perusahaan = :id');
		$this->db->bind('id', $id);
		return $this->db->get();
	}
	public function ubahJadwal($data){
		$query = "UPDATE jadwal_kegiatan SET tanggal_kegiatan = :tanggal_kegiatan WHERE id_perusahaan = :id_perusahaan";
		$this->db->query($query);
		// $this->db->bind('id', $data['id_perusahaan']);
		// $this->db->bind('nama_kegiatan', $data['nama_kegiatan']);
		$this->db->bind('id_perusahaan', $data['id']);
		$this->db->bind('tanggal_kegiatan', $data['tanggal_kegiatan']);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function hapusJadwal($id){
		$query = "DELETE FROM jadwal_kegiatan WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}

	// // // // BAHAN PELATIHAN // // // //
	public function getProdukById($id){
		$this->db->query('SELECT * FROM produk WHERE id = :id');
		$this->db->bind('id', $id);
		return $this->db->get();
	}
	public function getPelatihanByProduk($id){
		$this->db->query("SELECT * FROM produk LEFT JOIN bahan_pelatihan ON produk.id = bahan_pelatihan.id_produk WHERE produk.id = :id");
		$this->db->bind('id', $id);
		return $this->db->getAll();
	}
	public function getPelatihanById($id){
		$this->db->query("SELECT * FROM bahan_pelatihan WHERE id = :id");
		$this->db->bind('id', $id);
		return $this->db->get();
	}
	public function tambahFile($data){
		if(isset($_POST['submit'])){
			$query = "INSERT INTO bahan_pelatihan VALUES('', :nama_bahan, :deskripsi, :id_produk, :nama_file, :url)";
			$this->db->query($query);
			$this->db->bind('nama_bahan', $data['nama_bahan']);
			$this->db->bind('deskripsi', $data['deskripsi']);
			$this->db->bind('id_produk', $data['id_produk']);
			$filename = $_FILES['nama_file']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$randomname = md5($filename.date('d-m-Y, H:i:s')).'.'.$ext;
			$valid_ext = array("png","jpeg","jpg","pdf","doc","docx","xls","xlsx","ppt","pptx");
			if(in_array($ext, $valid_ext)){
				if(move_uploaded_file($_FILES['nama_file']['tmp_name'],'assets/files/bahan_pelatihan/'.$randomname)){
					$this->db->bind('nama_file', $randomname);
					$this->db->bind('url', 'assets/files/bahan_pelatihan/'.$randomname);
					$this->db->execute();
					return $this->db->rowCount();
				}
			}
			echo "File upload successfully";
		}
	}
	public function hapusFile($id, $nama_file){
		$query = "DELETE FROM bahan_pelatihan WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		unlink("assets/files/bahan_pelatihan/".$nama_file);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function ubahSyarat($data){
		$query = "UPDATE produk SET syarat = :syarat WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $data['id']);
		$this->db->bind('syarat', $data['syarat']);
		$this->db->execute();
		return $this->db->rowCount();
	}

	// // // // PENGATURAN // // // //
	public function getSertifikat(){
		$this->db->query('SELECT * FROM sertifikat');
		return $this->db->getAll();
	}
	public function ubahSertifikat($data){
		if($data['id'] == ''){
			$query = "INSERT INTO sertifikat SET penandatangan = :penandatangan, jabatan = :jabatan";
			$this->db->query($query);
		}else{
			$query = "UPDATE sertifikat SET penandatangan = :penandatangan, jabatan = :jabatan WHERE id = :id";
			$this->db->query($query);
			$this->db->bind('id', $data['id']);
		}
		$this->db->bind('penandatangan', $data['penandatangan']);
		$this->db->bind('jabatan', $data['jabatan']);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function getPerusahaanNull(){
		$this->db->query("SELECT perusahaan.id,nama_perusahaan,kode_produk,id_perusahaan FROM perusahaan LEFT JOIN `user` ON perusahaan.id = id_perusahaan LEFT JOIN produk ON perusahaan.id_produk = produk.id WHERE `user`.id_perusahaan IS NULL");
		return $this->db->getAll();
	}
	public function getUser(){
		$this->db->query('SELECT `user`.id,username,`level`,id_perusahaan,nama_perusahaan,id_produk,kode_produk,nama_produk FROM user LEFT JOIN perusahaan ON perusahaan.id = id_perusahaan LEFT JOIN produk ON perusahaan.id_produk = produk.id');
		return $this->db->getAll();
	}
	public function tambahUser(){
		error_reporting(0);
		$username = $_POST['username'];
		$email = $_POST['email'];
		$level = $_POST['level'];
		$id_perusahaan = $_POST['id_perusahaan'];
		$options = [
			'cost' => 16,
		];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
		$confirmPassword = $_POST['confirmPassword'];
		if(isset($username, $email, $password, $confirmPassword)){ 
			if(strstr($email, "@")){
				if(password_verify($confirmPassword, $password)){
					try{
						$this->db->query("SELECT * FROM user WHERE username = :username");
						$this->db->bind('username', $username);
						$this->db->execute();
					}
					catch(PDOException $e){
						echo $e->getMessage();
					}
					$count = $this->db->rowCount();
					if ($count == 0) {
						try {
							$this->db->query("INSERT INTO user SET username = :username, email = :email, password = :password, level = :level, id_perusahaan = :id_perusahaan");
							$this->db->bind('username', $username);
							$this->db->bind('email', $email);
							$this->db->bind('password', $password);
							$this->db->bind('level', $level);
							$this->db->bind('id_perusahaan', $id_perusahaan);
							$this->db->execute();
						} catch (Exception $e) {
							echo $e->getMessage();
							var_dump($e->getMessage());
							die;
						}
						if($this->db){
							Flasher::setFlash('berhasil', 'ditambahkan', 'success');
							header('Location: '. base_url . 'admin/pengaturan');
							exit;
						}
					}else{
						Flasher::setFlash('username', 'sudah pernah digunakan', 'danger');
						header('Location: '. base_url . 'admin/pengaturan');
						exit;
					}
				}else{
					Flasher::setFlash('password', 'tidak sama', 'danger');
					header('Location: '. base_url . 'admin/pengaturan');
					exit;
				}
			}else{
				Flasher::setFlash('email', 'tidak valid', 'danger');
				header('Location: '. base_url . 'admin/pengaturan');
				exit;
			}
		}
	}
	public function hapusUser($id){
		$query = "DELETE FROM `user` WHERE `user`.id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}
	
}










	// // // // PRODUK JADWAL // // // //

/*


// // // // DETAIL PRODUK // // // //
public function getPerusahaanByProduk($id){
	$this->db->query("SELECT perusahaan.id,nama_perusahaan,nama_produk FROM produk LEFT JOIN perusahaan ON produk.id = perusahaan.kode_produk WHERE produk.id = :id");
	$this->db->bind('id', $id);
	return $this->db->getAll();
}
// // // // DETAIL PERUSAHAAN // // // //



// // // // PESERTA // // // //
public function getPeserta(){
	$this->db->query("SELECT peserta.id,nama_peserta,nama_perusahaan FROM peserta LEFT JOIN perusahaan ON perusahaan.id = peserta.kode_perusahaan");
	return $this->db->getAll();
}





// // // // PELATIHAN // // // //
public function getPelatihan(){
	$this->db->query('SELECT * FROM bahan_pelatihan');
	return $this->db->getAll();
}
public function getPelatihanById($id){
	$this->db->query("SELECT * from bahan_pelatihan WHERE id = :id");
	$this->db->bind('id', $id);
	return $this->db->get();
}

// // // // JADWAL PELAKSANAAN // // // //

public function getJadwalById($id){
	$this->db->query('SELECT jadwal_pelaksanaan.id,tanggal_pelaksanaan,nama_perusahaan,produk.kode_produk,nama_produk FROM jadwal_pelaksanaan LEFT JOIN perusahaan ON jadwal_pelaksanaan.kode_perusahaan = perusahaan.id LEFT JOIN produk ON perusahaan.kode_produk = produk.id WHERE jadwal_pelaksanaan.id = :id');
	$this->db->bind('id', $id);
	return $this->db->get();
}
public function getPerusahaanByJadwal($id){
	$this->db->query("SELECT * FROM jadwal_pelaksanaan LEFT JOIN perusahaan ON jadwal_pelaksanaan.kode_perusahaan = perusahaan.id WHERE jadwal_pelaksanaan.id = :id");
	$this->db->bind('id', $id);
	return $this->db->getAll();
}
public function tambahJadwal($data){
	$query = "INSERT INTO jadwal_pelaksanaan VALUES ('', :nama_kegiatan, :tanggal_pelaksanaan, :kode_perusahaan)";
	$this->db->query($query);
	$this->db->bind('nama_kegiatan', $data['nama_kegiatan']);
	$this->db->bind('tanggal_pelaksanaan', $data['tanggal_pelaksanaan']);
	$this->db->bind('kode_perusahaan', $data['kode_perusahaan']);
	$this->db->execute();
	return $this->db->rowCount();
}


public function getUserById($id){
	$this->db->query('SELECT * FROM user WHERE id = :id');
	$this->db->bind('id', $id);
	return $this->db->get();
}


*/