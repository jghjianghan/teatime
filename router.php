<?php
date_default_timezone_set("Asia/Bangkok");
$url = $_SERVER['REDIRECT_URL'];
$baseURL = '/teatime';
// echo $url;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	switch ($url) {
		case $baseURL . '/index':
			//require_once "controller/bukuController.php";
			//echo $bkCtrl->viewBuku();
			break;
		case $baseURL . '/admin':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->view();
			break;
		case $baseURL . '/manajer':
			require_once "controller/manajerController.php";
			$usCtrl = new manajerController();
			echo $usCtrl->view();
			break;
		case $baseURL . '/admin/user':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->viewUser();
			break;
		case $baseURL . '/admin/add-user':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->viewAddUser();
			break;
		case $baseURL . '/admin/tea':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->viewTea();
			break;
		case $baseURL . '/admin/add-tea':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->viewAddTea();
			break;
		case $baseURL . '/admin/topping':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->viewTopping();
			break;
		case $baseURL . '/admin/add-topping':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->viewAddTopping();
			break;
		case $baseURL . '/kasir':
			require_once "controller/kasirController.php";
			$usCtrl = new KasirController();
			echo $usCtrl->viewTPS();
			break;
		default:
			echo '404 Not Found';
			break;
	}
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	switch ($url) {
		case $baseURL . '/index/add':
			//require_once "controller/bukuController.php";
			//$bkCtrl = new BukuController();
			//$bkCtrl->addBook();
			//header('Location: ../index');
			break;
		case $baseURL . '/admin/user/add':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			$usCtrl->addUser();
			header('Location: ../user');
			break;
		case $baseURL . '/admin/tea/add':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			$usCtrl->addTea();
			header('Location: ../tea');
			break;
		case $baseURL . '/admin/topping/add':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			$usCtrl->addTopping();
			header('Location: ../topping');
			break;
		case $baseURL . '/admin/tea/update':
			require_once "controller/adminController.php";
			// $usCtrl = new AdminController();
			// echo $usCtrl->updateTea();
			include "view/updateTea.php";
			break;
		case $baseURL . '/admin/admin':
			header('Location: ../admin');
			break;
		default:
			echo '404 Not Found';
			break;
	}
}
