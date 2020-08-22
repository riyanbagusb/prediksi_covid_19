<?php

class Contoh extends Controller {

	public function index()
	{
		$data['title'] = 'Dashboard | Sistem Prediksi Perkembangan COVID19';
		$this->view('admin/layouts/header', $data);;
		$this->view('admin/index', $data);
		$this->view('admin/layouts/footer');
	}
	// // // // PRODUK // // // //
	public function produk()
	{
		$data['title'] = 'Produk | Sysindo Konsultan';
		$data['page'] = 'Produk';
		$data['produk'] = $this->model('Admin_model')->getProduk();
		$data['perusahaan'] = $this->model('Admin_model')->getPerusahaan();
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/produk', $data);
		$this->view('admin/templates/footer');
	}
	public function get_produk()
	{
		echo json_encode($this->model('Admin_model')->getProdukById($_POST['id']));
	}
	public function tambah_produk()
	{
		if ($this->model('Admin_model')->tambahProduk($_POST) > 0) {
			Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: '. base_url . 'admin/produk');
			exit;
		} else {
			Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: '. base_url . 'admin/produk');
			exit;
		}
	}
	public function ubah_produk()
	{
		if ($this->model('Admin_model')->ubahProduk($_POST) > 0) {
			Flasher::setFlash('berhasil', 'diubah', 'success');
			header('Location: '. base_url . 'admin/produk');
			exit;
		} else {
			Flasher::setFlash('gagal', 'diubah', 'danger');
			header('Location: '. base_url . 'admin/produk');
			exit;
		}
	}
	public function hapus_produk($id)
	{
		if ($this->model('Admin_model')->hapusProduk($id) > 0) {
			Flasher::setFlash('berhasil', 'dihapus', 'success');
			header('Location: '. base_url . 'admin/produk');
			exit;
		} else {
			Flasher::setFlash('gagal', 'dihapus', 'danger');
			header('Location: '. base_url . 'admin/produk');
			exit;
		}
	}

	// // // // PERUSAHAAN // // // //
	public function perusahaan()
	{
		$data['title'] = 'Perusahaan | Sysindo Konsultan';
		$data['page'] = 'Perusahaan';
		$data['perusahaan'] = $this->model('Admin_model')->getPerusahaan();
		$data['produk'] = $this->model('Admin_model')->getProduk();
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/perusahaan', $data);
		$this->view('admin/templates/footer');
	}
	public function tambah_perusahaan()
	{
		if ($this->model('Admin_model')->tambahPerusahaan($_POST) > 0 && $this->model('Admin_model')->tambahJadwal($_POST) > 0 ) {
			Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: '. base_url . 'admin/perusahaan');
			exit;
		} else {
			Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: '. base_url . 'admin/perusahaan');
			exit;
		}
	}
	public function get_perusahaan()
	{
		echo json_encode($this->model('Admin_model')->getPerusahaanById($_POST['id']));
	}
	public function ubah_perusahaan()
	{
		if ($this->model('Admin_model')->ubahPerusahaan($_POST) > 0 || $this->model('Admin_model')->ubahJadwal($_POST) > 0 ) {
			Flasher::setFlash('berhasil', 'diubah', 'success');
			header('Location: '. base_url . 'admin/perusahaan');
			exit;
		} else {
			Flasher::setFlash('gagal', 'diubah', 'danger');
			header('Location: '. base_url . 'admin/perusahaan');
			exit;
		}
	}
	public function hapus_perusahaan($id)
	{
		if ($this->model('Admin_model')->hapusPerusahaan($id) > 0) {
			Flasher::setFlash('berhasil', 'dihapus', 'success');
			header('Location: '. base_url . 'admin/perusahaan');
			exit;
		} else {
			Flasher::setFlash('gagal', 'dihapus', 'danger');
			header('Location: '. base_url . 'admin/perusahaan');
			exit;
		}
	}

	// // // // PERUSAHAAN PESERTA // // // //
	public function perusahaan_peserta($id)
	{
		$data['perusahaan'] = $this->model('Admin_model')->getPerusahaanById($id);
		$data['peserta'] = $this->model('Admin_model')->getPesertaByPerusahaan($id);
		$data['tanggal'] = $this->model('Admin_model')->tanggalId();
		$data['countPeserta'] = $this->model('Admin_model')->countPeserta();
		$data['title'] = $data['perusahaan']['nama_perusahaan'].' | Sysindo Konsultan';
		$data['page'] = $data['perusahaan']['nama_perusahaan'];
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/perusahaan_peserta', $data);
		$this->view('admin/templates/footer');
	}
	public function tambah_peserta($id)
	{
		$data['perusahaan'] = $this->model('Admin_model')->getPerusahaanById($id);
		if ($this->model('Admin_model')->tambahPeserta($_POST) > 0) {
			Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: '. base_url . 'admin/perusahaan_peserta/' . $data['perusahaan']['id']);
			exit;
		} else {
			Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: '. base_url . 'admin/perusahaan_peserta/' . $data['perusahaan']['id']);
			exit;
		}
	}
	public function sertifikat($id)
	{
		$data['pesertaById'] = $this->model('Admin_model')->getPesertaJoin($id);
		$data['sertifikat'] = $this->model('Admin_model')->getSertifikat();
		$data['tanggal'] = $this->model('Admin_model')->tanggalId();
		$data['title'] = $data['pesertaById']['nama_peserta'].' '.$data['pesertaById']['nama_perusahaan'].' | Sysindo Konsultan';
		$this->view('admin/menu/sertifikat', $data);
	}
	public function get_peserta()
	{
		echo json_encode($this->model('Admin_model')->getPesertaById($_POST['id']));
	}
	public function ubah_peserta()
	{
		if ($this->model('Admin_model')->ubahPeserta($_POST) > 0) {
			Flasher::setFlash('berhasil', 'diubah', 'success');
			header('Location: '. base_url . 'admin/perusahaan_peserta/'.$_POST['id_perusahaan']);
			exit;
		} else {
			Flasher::setFlash('gagal', 'diubah', 'danger');
			header('Location: '. base_url . 'admin/perusahaan_peserta/'.$_POST['id_perusahaan']);
			exit;
		}
	}
	public function hapus_peserta($id)
	{
		$id_perusahaan = $this->model('Admin_model')->getPesertaById($id)['id_perusahaan'];
		if ($this->model('Admin_model')->hapusPeserta($id) > 0) {
			Flasher::setFlash('berhasil', 'dihapus', 'success');
			header('Location: '. base_url . 'admin/perusahaan_peserta/'.$id_perusahaan);
			exit;
		} else {
			Flasher::setFlash('gagal', 'dihapus', 'danger');
			header('Location: '. base_url . 'admin/perusahaa_pesertan/'.$id_perusahaan);
			exit;
		}
	}
	public function ubah_informasi()
	{
		if ($this->model('Admin_model')->ubahInformasi($_POST) > 0) {
			Flasher::setFlash('berhasil', 'diubah', 'success');
			header('Location: '. base_url . 'admin/perusahaan_peserta/'.$_POST['id_perusahaan']);
			exit;
		} else {
			Flasher::setFlash('gagal', 'diubah', 'danger');
			header('Location: '. base_url . 'admin/perusahaan_peserta/'.$_POST['id_perusahaan']);
			exit;
		}
	}

	// // // // JADWAL KEGIATAN // // // //
	public function jadwal_kegiatan()
	{
		$data['title'] = 'Jadwal Kegiatan | Sysindo Konsultan';
		$data['page'] = 'Jadwal Kegiatan';
		$data['jadwal'] = $this->model('Admin_model')->getJadwal();
		$data['tanggal'] = $this->model('Admin_model')->tanggalId();
		$data['perusahaan'] = $this->model('Admin_model')->getPerusahaan();
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/jadwal_kegiatan', $data);
		$this->view('admin/templates/footer');
	}
	public function tambah_jadwal()
	{
		if ($this->model('Admin_model')->tambahJadwal($_POST) > 0) {
			Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: '. base_url . 'admin/jadwal_kegiatan');
			exit;
		} else {
			Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: '. base_url . 'admin/jadwal_kegiatan');
			exit;
		}
	}
	public function get_jadwal()
	{
		echo json_encode($this->model('Admin_model')->getJadwalById($_POST['id']));
	}
	public function ubah_jadwal()
	{
		if ($this->model('Admin_model')->ubahJadwal($_POST) > 0) {
			Flasher::setFlash('berhasil', 'diubah', 'success');
			header('Location: '. base_url . 'admin/jadwal_kegiatan');
			exit;
		} else {
			Flasher::setFlash('gagal', 'diubah', 'danger');
			header('Location: '. base_url . 'admin/jadwal_kegiatan');
			exit;
		}
	}
	public function hapus_jadwal($id)
	{
		if ($this->model('Admin_model')->hapusJadwal($id) > 0) {
			Flasher::setFlash('berhasil', 'dihapus', 'success');
			header('Location: '. base_url . 'admin/jadwal_kegiatan');
			exit;
		} else {
			Flasher::setFlash('gagal', 'dihapus', 'danger');
			header('Location: '. base_url . 'admin/jadwal_kegiatan');
			exit;
		}
	}
	// // // // BAHAN PELATIHAN // // // //
	public function bahan_pelatihan()
	{
		$data['title'] = 'Peserta | Sysindo Konsultan';
		$data['page'] = 'Syarat & Bahan Pelatihan';
		$data['produk'] = $this->model('Admin_model')->getProduk();
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/bahan_pelatihan', $data);
		$this->view('admin/templates/footer');
	}
	public function produk_pelatihan($id)
	{
		$data['produk'] = $this->model('Admin_model')->getProdukById($id);
		$data['pelatihanByProduk'] = $this->model('Admin_model')->getPelatihanByProduk($id);
		$data['title'] = 'Peserta | Sysindo Konsultan';
		$data['page'] = 'Detail Pelatihan';
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/produk_pelatihan', $data);
		$this->view('admin/templates/footer');
	}
	public function tambah_bahan()
	{
		if ($this->model('Admin_model')->tambahFile($_POST) > 0) {
			Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: '. base_url . 'admin/produk_pelatihan/'.$_POST['id_produk']);
			exit;
		} else {
			Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: '. base_url . 'admin/produk_pelatihan/'.$_POST['id_produk']);
			exit;
		}
	}
	public function hapus_bahan($id, $nama_file)
	{
		$id_bahan = $this->model('Admin_model')->getPelatihanById($id)['id_produk'];
		if ($this->model('Admin_model')->hapusFile($id, $nama_file) > 0) {
			Flasher::setFlash('berhasil', 'dihapus', 'success');
			header('Location: '. base_url . 'admin/produk_pelatihan/'.$id_bahan);
			exit;
		} else {
			Flasher::setFlash('gagal', 'dihapus', 'danger');
			header('Location: '. base_url . 'admin/produk_pelatihan/'.$id_bahan);
			exit;
		}
	}
	public function ubah_syarat()
	{
		if ($this->model('Admin_model')->ubahSyarat($_POST) > 0) {
			Flasher::setFlash('berhasil', 'diubah', 'success');
			header('Location: '. base_url . 'admin/produk_pelatihan/'.$_POST['id']);
			exit;
		} else {
			Flasher::setFlash('gagal', 'diubah', 'danger');
			header('Location: '. base_url . 'admin/produk_pelatihan/'.$_POST['id']);
			exit;
		}
	}

	// // // // PENGATURAN // // // //
	public function pengaturan()
	{
		$data['title'] = 'Peserta | Sysindo Konsultan';
		$data['page'] = 'Pengaturan';
		$data['sertifikat'] = $this->model('Admin_model')->getSertifikat();
		$data['user'] = $this->model('Admin_model')->getUser();
		$data['perusahaan'] = $this->model('Admin_model')->getPerusahaanNull();
		$data['tambahUser'] = $this->model('Admin_model')->tambahUser();
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/pengaturan', $data);
		$this->view('admin/templates/footer');
	}
	public function ubah_sertifikat()
	{
		if ($this->model('Admin_model')->ubahSertifikat($_POST) > 0) {
			Flasher::setFlash('berhasil', 'diubah', 'success');
			header('Location: '. base_url . 'admin/pengaturan');
			exit;
		} else {
			Flasher::setFlash('gagal', 'diubah', 'danger');
			header('Location: '. base_url . 'admin/pengaturan');
			exit;
		}
	}
	public function hapus_user($id)
	{
		if ($this->model('Admin_model')->hapusUser($id) > 0) {
			Flasher::setFlash('berhasil', 'dihapus', 'success');
			header('Location: '. base_url . 'admin/pengaturan');
			exit;
		} else {
			Flasher::setFlash('gagal', 'dihapus', 'danger');
			header('Location: '. base_url . 'admin/pengaturan');
			exit;
		}
	}
	public function cetak_report()
	{
		
		$data['title'] = 'Report | Sysindo Konsultan';
		$data['page'] = 'Report';
		$data['produk'] = $this->model('Admin_model')->getProdukCount($_POST);
		$data['first_year'] = $this->model('Admin_model')->yearFirst();
		$data['last_year'] = $this->model('Admin_model')->yearLast();
		$this->view('admin/menu/cetak_report', $data);
	}
}







/*	// // // // PERUSAHAAN PESERTA // // // //


	// // // // PESERTA // // // //
	public function peserta()
	{
		$data['title'] = 'Peserta | Sysindo Konsultan';
		$data['page'] = 'Peserta';
		$data['peserta'] = $this->model('Admin_model')->getPeserta();
		$data['perusahaan'] = $this->model('Admin_model')->getPerusahaan();
		$data['countPeserta'] = $this->model('Admin_model')->countPeserta();
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/peserta', $data);
		$this->view('admin/templates/footer');
	}



	public function hapus_peserta($id)
	{
		if ($this->model('Admin_model')->hapusPeserta($id) > 0) {
			Flasher::setFlash('berhasil', 'dihapus', 'success');
			header('Location: '. base_url . 'admin/peserta');
			exit;
		} else {
			Flasher::setFlash('gagal', 'dihapus', 'danger');
			header('Location: '. base_url . 'admin/peserta');
			exit;
		}
	}



	

	// // // // JADWAL PELAKSANAAN // // // //
	public function jadwal_pelaksanaan()
	{
		$data['title'] = 'Peserta | Sysindo Konsultan';
		$data['page'] = 'Jadwal Pelaksanaan';
		$data['jadwal'] = $this->model('Admin_model')->getJadwal();
		$data['tanggal'] = $this->model('Admin_model')->tanggalId();
		$data['perusahaan'] = $this->model('Admin_model')->getPerusahaan();
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/jadwal_pelaksanaan', $data);
		$this->view('admin/templates/footer');
	}
	public function detail_jadwal($id)
	{
		$data['jadwal'] = $this->model('Admin_model')->getJadwalById($id);
		$data['perusahaanByJadwal'] = $this->model('Admin_model')->getPerusahaanByJadwal($id);
		$data['tanggal'] = $this->model('Admin_model')->tanggalId();
		$data['title'] = $data['jadwal']['nama_kegiatan'].' | Sysindo Konsultan';
		$data['page'] = $data['jadwal']['nama_kegiatan'];
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/detail_jadwal', $data);
		$this->view('admin/templates/footer');
	}	
	public function tambah_jadwal()
	{
		if ($this->model('Admin_model')->tambahJadwal($_POST) > 0) {
			Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: '. base_url . 'admin/jadwal_pelaksanaan');
			exit;
		} else {
			Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: '. base_url . 'admin/jadwal_pelaksanaan');
			exit;
		}
	}


	public function get_user()
	{
		echo json_encode($this->model('Admin_model')->getUserById($_POST['id']));
	}

	
	public function tambah_perusahaan_produk($id)
	{
		if ($this->model('Admin_model')->tambahPerusahaan($_POST) > 0) {
			Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: '. base_url . 'admin/detail_produk/'. $id);
			exit;
		} else {
			Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: '. base_url . 'admin/detail_produk');
			exit;
		}
	}
	// // // // DETAIL PERUSAHAAN // // // //
	public function detail_perusahaan($id)
	{
		$data['perusahaan'] = $this->model('Admin_model')->getPesertaById($id);
		$data['pesertaByPerusahaan'] = $this->model('Admin_model')->getPesertaByPerusahaan($id);
		$data['title'] = $data['perusahaan']['nama_perusahaan'].' | Sysindo Konsultan';
		$data['page'] = 'Perusahaan '.$data['perusahaan']['nama_perusahaan'];
		$this->view('admin/templates/header', $data);
		$this->view('admin/templates/navbar');
		$this->view('admin/templates/sidebar', $data);
		$this->view('admin/menu/detail_perusahaan', $data);
		$this->view('admin/templates/footer', $data);
	}
}*/