<?php

class App {
	
	//Memanggil Controller, Method, Parameter Default apabila tidak ada apapun di url
	protected $controller = default_controller;
	protected $method = default_method;
	protected $parameter = [];
	
	public function __construct()
	{

		$url = $this->parse_url();
		
		//controller
		//Jika ada file di array pertama (url ke 0) di url, jika ada ubah default controller menjadi controller yang baru
		if (file_exists('app/controllers/' . $url[0] . '.php')) {
			$this->controller = $url[0];
			//hapus url ke 0
			unset($url[0]);
		}

		//panggil controller yang baru
		require_once 'app/controllers/' . $this->controller . '.php';
		//instansiasi agar dapat dipanggil methodnya
		$this->controller = new $this->controller;

		//method
		//Jika ada file di array kedua (url ke 1) di url, jika ada ubah default method menjadi method yang baru
		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		//parameter
		//misal http//url/controller/method/parameter/parameter
		if (!empty($url)) {
			$this->parameter = array_values($url);
		}

		//Jalankan controller & method, serta kirimkan parameter jika ada
		call_user_func_array([$this->controller, $this->method], $this->parameter);
	}
	//parsing url (mengambil url lalu memecahnya)
	public function parse_url()
	{
		//jika ada url yang dikirimkan
		if (isset($_GET['url'])) {
			//memecah string menjadi array
			//hapus url dengan tanda "/" di akhir url
			$url = rtrim($_GET['url'], '/');
			//untuk membersihkan url dari karakter aneh, mengatasi sql injection
			$url = filter_var($url, FILTER_SANITIZE_URL);
			// memecah url dengan "/" menjadi array
			$url = explode('/', $url);
			return $url;
		}
	}
}


