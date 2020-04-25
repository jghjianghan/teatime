<!DOCTYPE html>
<html>

<head>
	<title><?php echo $title; ?></title>
	<?php
	$upPrefix = "";
	if (isset($uplevel)){
		for ($i = 0; $i<$uplevel; $i++){
			$upPrefix .= '../';
		}
	}
	if (isset($styleSrcList)) {
		foreach ($styleSrcList as $key => $value) {
			echo "<link rel='stylesheet' type='text/css' href='".$upPrefix."view/css/$value'>";
		}
	}
	if (isset($scriptSrcList)) {
		foreach ($scriptSrcList as $key => $value) {
			$scriptLink = "<script src='".$upPrefix."view/js/$value' defer></script>";
		}
	}
	?>
</head>

<body>
	<div id='header-bar'>
		<div id='full-logo'>
			<img src='<?php echo $upPrefix;?>asset/logo/logoHeader.svg' />
			<p id='companyName'>Teatime</p>
		</div>
		<div id='page-title'>
			<h2>Transaction Record</h2>
		</div>
		<div id='account-info'>
			<?php
				if (isset($username)){
					echo $username;
				}
				if (isset($changePassword)){
					echo $changePassword;
				}
				if (isset($logOption)){
					echo $logOption;
				}
			?>
		</div>
	</div>

	<?php echo $content; ?>

	<footer>
		<hr>
		Copyleft &copy;<?php echo date('Y');?> Teatime
	</footer>
</body>

</html>