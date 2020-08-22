<?php

class Database {
	//database manggunakan PDO, bukan mysqli
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $db_name = DB_NAME;

	//database handler
	private $database_handler;
	//Statement untuk menyimpan query
	private $statement;

	public function __construct() //untuk koneksi
	{
		//data source name
		$data_souce_name = 'mysql:host='. $this->host . ';dbname=' . $this->db_name;
		//untuk mengoptimasi koneksi ke database
		$option = [
			PDO::ATTR_PERSISTENT => true, //menjaga database selalu terkoneksi/terjaga (untuk optimasi)
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //mode error menampilkan exception
		];
		try {
			$this->database_handler = new PDO($data_souce_name, $this->user, $this->pass, $option);
		} catch(PDOException $error) {
			die($error->getMessage());
		}
	}
	//untuk mengatur query agar dapat dipakai secara generic untuk apapun misal insert, delete, agar dapat digunakan secara flexible
	public function query($query) {
		$this->statement = $this->database_handler->prepare($query);
	}

	//binding data untuk misal ada where, value, update (parameter)
	public function bind($parameter, $value, $type = null) { //parameter dengan nilai dan type ditentukan otomatis oleh aplikasi
		if (is_null($type)) { //jika type null, jalankan
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT; //jika value integer
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL; //jika value boolean
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL; //jika value null
					break;
				default:
					$type = PDO::PARAM_STR; //jika value string
			}
		}
		$this->statement->bindValue($parameter, $value, $type); //binding untuk mengamankan agar terhindar dari sql injection, query dieksekusi setelah string dibersihkan
	}

	public function execute()
	{
		$this->statement->execute(); //untuk mengeksekusi hasilnya dibawah
	}
	public function get() //jika hasilnya banyak
	{
		$this->execute();
		return $this->statement->fetchAll(PDO::FETCH_ASSOC);
	}
	public function show() //jika hasil datanya cuma satu
	{
		$this->execute();
		return $this->statement->fetch(PDO::FETCH_ASSOC);
	}
	public function rowCount()
	{
		return $this->statement->rowCount();
	}
}