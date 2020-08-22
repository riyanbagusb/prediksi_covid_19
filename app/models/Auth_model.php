<?php

class Auth_model {

	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function login(){
		error_reporting(0);
		if ($_SESSION['username'] != null){
			header('location: '. base_url . 'admin');
		}

		if (isset($_POST['login'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			try{
				$this->db->query("SELECT * FROM user WHERE username = :username");
				$this->db->bind('username', $username);
				$this->db->execute();

				$data = $this->db->show();
				$verify = password_verify($password, $data['password']);

				if ($username == $data['username']) {
					if ($verify == true){
						$_SESSION['username'] = $username;
						header('location: ' . base_url . 'admin');
						return;
					} else {
						isInvalid::set_name('password');
					}
				} else {
					isInvalid::set_name('username');
				}
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
	
	public function logout(){
		if (isset($_SESSION['username'])){
			session_start();
			session_destroy();
			session_start();
			Flasher::setFlash('Anda berhasil logout!', 'success');
			header('location: ' . base_url . 'auth');
		} else {
			Flasher::setFlash('Tidak ada user yang perlu logout!', 'danger');
			header('location: ' . base_url . 'auth');
		}
	}
}