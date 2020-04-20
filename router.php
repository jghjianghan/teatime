<?php
	date_default_timezone_set("Asia/Bangkok");
	$url = $_SERVER['REDIRECT_URL'];
	$baseURL = '/teatime';
	// echo $url;
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		switch ($url) {
			case $baseURL.'/index':
				//require_once "controller/bukuController.php";
				//echo $bkCtrl->viewBuku();
				break;
			default:
				echo '404 Not Found';
				break;
		}
	}else if($_SERVER["REQUEST_METHOD"] == "POST"){
		switch ($url) {
			case $baseURL.'/index/add':
				//require_once "controller/bukuController.php";
				//$bkCtrl = new BukuController();
				//$bkCtrl->addBook();
				//header('Location: ../index');
				break;
			default:
				echo '404 Not Found';
				break;
		}
	}
?>