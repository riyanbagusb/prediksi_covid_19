<?php
if (!session_id()) {
	session_start();
}

//memamnggil file init.php (teknik bootstraping untuk memanggil aplikasi mvc)
require_once 'app/init.php';

//Menjalankan class App
$app = new App;