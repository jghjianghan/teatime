<?php
date_default_timezone_set("Asia/Bangkok");
$url = $_SERVER['REDIRECT_URL'];
$baseURL = '/teatime';
// echo $_SERVER['REQUEST_URI'];
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	switch ($url) {
		case $baseURL . '/index':
			require_once "controller/mainController.php";
			$ctrl = new MainController();
			echo $ctrl->viewHome();
			break;
		case $baseURL . '/login':
			if (isset($_SESSION['role'])) {
				if ($_SESSION['role'] == 'admin') {
					header('location: admin');
				} else if ($_SESSION['role'] == 'kasir') {
					header('location: kasir');
				} else {
					header('location: manajer');
				}
			} else {
				require_once "controller/mainController.php";
				$ctrl = new MainController();
				echo $ctrl->viewLogin();
			}
			break;
		case $baseURL . '/logout':
			require_once "controller/mainController.php";
			$ctrl = new MainController();
			echo $ctrl->logout();
			break;
		case $baseURL . '/changePassword':
			if (!isset($_SESSION['role'])){
				header('location: login');
			} else {
				require_once "controller/mainController.php";
				$ctrl = new MainController();
				echo $ctrl->viewChangePass();
			}
			break;
		case $baseURL . '/forbidden':
			require_once "controller/mainController.php";
			$ctrl = new MainController();
			echo $ctrl->viewForbidden();
			break;
		case $baseURL . '/admin':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
				require_once "controller/adminController.php";
				$usCtrl = new AdminController();
				echo $usCtrl->view();
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/admin/user':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
				require_once "controller/adminController.php";
				$usCtrl = new AdminController();
				echo $usCtrl->viewUser();
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/admin/tea':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
				require_once "controller/adminController.php";
				$usCtrl = new AdminController();
				echo $usCtrl->viewTea();
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/admin/topping':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
				require_once "controller/adminController.php";
				$usCtrl = new AdminController();
				echo $usCtrl->viewTopping();
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/kasir':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'kasir') {
				require_once "controller/kasirController.php";
				$usCtrl = new KasirController();
				echo $usCtrl->viewTPS();
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/kasir/tea':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'kasir') {
				require_once "controller/kasirController.php";
				$ctrl = new KasirController();
				echo json_encode($ctrl->getAllTea());
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/kasir/topping':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'kasir') {
				require_once "controller/kasirController.php";
				$ctrl = new KasirController();
				echo json_encode($ctrl->getAllTopping());
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/kasir/sugar':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'kasir') {
				require_once "controller/kasirController.php";
				$ctrl = new KasirController();
				echo $ctrl->getConfig('sugarLevel');
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/kasir/ice':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'kasir') {
				require_once "controller/kasirController.php";
				$ctrl = new KasirController();
				echo $ctrl->getConfig('ice');
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/kasir/cup':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'kasir') {
				require_once "controller/kasirController.php";
				$ctrl = new KasirController();
				echo $ctrl->getConfig('cupSize');
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/kasir/orderNum':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'kasir') {
				require_once "controller/kasirController.php";
				$ctrl = new KasirController();
				echo $ctrl->getOrderNumber();
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/manajer':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'manager') {
				require_once "controller/manajerController.php";
				$usCtrl = new manajerController();
				echo $usCtrl->view();
			} else {
				header('Location: forbidden');
			}
			break;
		case $baseURL . '/manajer/rataJamRamai':
			if (isset($_SESSION['role']) && $_SESSION['role'] == 'manager') {
				require_once "controller/manajerController.php";
				$usCtrl = new manajerController();
				echo $usCtrl->getRataJamRamai();
			} else {
				header('Location: forbidden');
			}
			break;

		default:
			echo '404 Not Found';
			break;
	}
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	switch ($url) {
		case $baseURL . '/login':
			require_once "controller/mainController.php";
			$ctrl = new MainController();
			echo $ctrl->validateLogin();
			break;
		case $baseURL . '/changePassword':
			require_once "controller/mainController.php";
			$ctrl = new MainController();
			echo $ctrl->changePassword();
			break;
		case $baseURL . '/admin/user/add':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->addUser();
			break;
		case $baseURL . '/admin/user/edit':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->editUser();
			header('Location: ../user');
			break;
		case $baseURL . '/admin/user/delete':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->deleteUser();
			header('Location: ../user');
			break;
		case $baseURL . '/admin/user/reset':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			print_r($usCtrl->resetPass());
			// header('Location: ../user');
			break;
		case $baseURL . '/admin/tea/add':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			$usCtrl->addTea();
			header('Location: ../tea');
			break;
		case $baseURL . '/admin/tea/update':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->updateTea();
			header('Location: ../tea');
			break;
		case $baseURL . '/admin/tea/delete':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->deleteTea();
			header('Location: ../tea');
			break;
		case $baseURL . '/admin/topping/add':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			$usCtrl->addTopping();
			header('Location: ../topping');
			break;
		case $baseURL . '/admin/topping/update':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			$usCtrl->updateTopping();
			header('Location: ../topping');
			break;
		case $baseURL . '/admin/topping/delete':
			require_once "controller/adminController.php";
			$usCtrl = new AdminController();
			echo $usCtrl->deleteTopping();
			header('Location: ../topping');
			break;
		case $baseURL . '/admin/admin':
			header('Location: ../admin');
			break;
		case $baseURL . '/kasir/checkout':
			require_once "controller/kasirController.php";
			$ctrl = new KasirController();
			echo $ctrl->addTransaction();
			break;
		case $baseURL . '/manajer/manajer':
			switch ($_POST['select-laporan']) {
				case "detail-trans-harian":
					require_once "controller/manajerController.php";
					$usCtrl = new manajerController();
					echo $usCtrl->viewHarian();
					// require_once "controller/pdfController.php";
					// $test = new pdfController();
					// $test->getPdfHarian();
					break;
				case "trans-rentang":
					require_once "controller/manajerController.php";
					$usCtrl = new manajerController();
					echo $usCtrl->viewRentang();
					break;
				case "uang-masuk":
					require_once "controller/manajerController.php";
					$usCtrl = new manajerController();
					echo $usCtrl->viewKeuangan();
					// require_once "controller/pdfController.php";
					// $test = new pdfController();
					// $test->getPdfKeuangan();
					break;
				case "performa-kasir":
					require_once "controller/manajerController.php";
					$usCtrl = new manajerController();
					echo $usCtrl->viewKasir();
					break;
				case "jam-ramai":
					require_once "controller/manajerController.php";
					$usCtrl = new manajerController();
					echo $usCtrl->viewJamRamai();
					break;
				default:
					echo '404 Not Found';
					break;
			}
			break;
		case $baseURL . '/manajer/manajer/pdfharian':
			echo $url;
			require_once "controller/pdfController.php";
			$pdfCtrl = new pdfController();
			echo $pdfCtrl->getPdfHarian();
			break;
		case $baseURL . '/manajer/manajer/pdfrentang':
			require_once "controller/pdfController.php";
			$pdfCtrl = new pdfController();
			echo $pdfCtrl->getPdfRentang();
			break;
		case $baseURL . '/manajer/manajer/pdfkeuangan':
			require_once "controller/pdfController.php";
			$pdfCtrl = new pdfController();
			echo $pdfCtrl->getPdfKeuangan();
			break;
		case $baseURL . '/manajer/manajer/pdfjamramai':
			require_once "controller/pdfController.php";
			$pdfCtrl = new pdfController();
			echo $pdfCtrl->getPdfJamRamai();
			break;
		case $baseURL . '/manajer/manajer/pdfkasir':
			require_once "controller/pdfController.php";
			$pdfCtrl = new pdfController();
			echo $pdfCtrl->getPdfKasir();
			break;
		default:
			echo '404 Not Found';
			break;
	}
}
