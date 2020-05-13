<!DOCTYPE html>
<html>

<head>
	<title><?php echo $title; ?> - Teatime</title>
	<link rel='stylesheet' type='text/css' href='<?php echo $upPrefix; ?>view/css/mainStyle.css'>
	<?php
	if (isset($styleSrcList)) {
		foreach ($styleSrcList as $key => $value) {
			echo "<link rel='stylesheet' type='text/css' href='" . $upPrefix . "view/css/$value'>";
		}
	}
	if (isset($scriptSrcList)) {
		foreach ($scriptSrcList as $key => $value) {
			echo "<script src='" . $upPrefix . "view/js/$value' defer></script>";
		}
	}
	?>
</head>

<body>
	<div id='header-bar'>
		<div id='full-logo'>
			<a href="
			<?php
				echo $upPrefix;
				if (isset($_SESSION['role'])) {
					$posisi = $_SESSION['role'];
					if ($posisi == 'manager') {
						$posisi = "manajer";
					}
					echo "$posisi";
				} else {
					echo "index";
				}
			?>
			">
				<img src='<?php echo $upPrefix; ?>asset/logo/logoHeader.svg' />
				<p id='companyName'>Teatime</p>
			</a>
		</div>
		<div id='page-title'>
			<h2><?php echo $title; ?></h2>
		</div>
		<div id='account-info'>
			<?php
			if (isset($_SESSION['role'])) {
				echo "<span data-id='" . $_SESSION['id'] . "' data-role='" . $_SESSION['role'] . "'>" . $_SESSION['name'] . "</span>";
				echo "<span><a href='" . $upPrefix . "changePassword'><button class='addBtn'><span>Change<br>Password</span></button></a></span>";
				echo "<span><a href='" . $upPrefix . "logout'>Logout</a></span>";
			} else {
				echo "<span><a href='" . $upPrefix . "login'>Login</a></span>";
			}
			?>
		</div>
	</div>
	<div id='wrapper'>
		<?php echo $content; ?>
	</div>
	<footer>
		<hr>
		<?php
		if (isset($_SESSION['role'])) {
			$posisi = $_SESSION['role'];
			if ($posisi == 'manager') {
				$posisi = "manajer";
			}
			echo "<a href='" . $upPrefix . $posisi . "'>Home</a> | ";
		}
		?>
		<a href="<?php echo $upPrefix; ?>index">About Teatime</a>
	</footer>
</body>

</html>