<?php

class Controller {
	public function view($view, $data = []) //view & parameter apabila ada
	{
		// memanggil kelas view
		require_once 'app/views/' . $view . '.php';
	}
	public function model($model)
	{
		//memanggil kelas model
		require_once 'app/models/' . $model . '.php';
		//instansiasi model ketika dipanggil agar dapat digunakan
		return new $model;
	}
}