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
			case $baseURL.'/admin':
				include 'view/admin.php';
				break;
			case $baseURL.'/admin/user':
				require_once "controller/adminController.php";
				$usCtrl = new AdminController();
				echo $usCtrl->viewUser();
				break;
			case $baseURL.'/admin/tea':
				require_once "controller/adminController.php";
				$usCtrl = new AdminController();
				echo $usCtrl->viewTea();
				break;
			case $baseURL.'/admin/topping':
				require_once "controller/adminController.php";
				$usCtrl = new AdminController();
				echo $usCtrl->viewTopping();
				break;
			case $baseURL.'/kasir':
				require_once "controller/kasirController.php";
				$usCtrl = new KasirController();
				echo $usCtrl->viewTPS();
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
			case $baseURL.'/admin/tea/update':
				require_once "controller/adminController.php";
				// $usCtrl = new AdminController();
				// echo $usCtrl->updateTea();
				include "view/updateTea.php";
				break;
			default:
				echo '404 Not Found';
				break;
		}
	}
?>