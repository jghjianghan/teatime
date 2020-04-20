<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>

	<?php
		foreach($styleSrcList as $key => $value){
			echo "<link rel='stylesheet' href='view/css/$value'>";
		}
		foreach($scriptSrcList as $key => $value){
			echo "<script src='view/js/$value' defer></script>";
		}
	?>
    
</head>
<body>
    <h1>Perpustakaan Hore</h1>
    <?php echo $content; ?>
    <hr>
    <footer>
        <a href="./index">Home</a> | <a href="info">Info</a>
    </footer>
</body>
</html>