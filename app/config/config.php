<?php
//mendefinisikan base url
define('base_url', 'http://'.$_SERVER['HTTP_HOST'].'/php/prediksi_covid_19/');

//mendefinisikan database yang ada di core Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'covid19');

//mendefinisikan default controller dan method yang ada di Core App
define('default_controller', 'frontend');
define('default_method', 'index');

date_default_timezone_set('Asia/Jakarta');