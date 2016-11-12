<?php if(session_id() == '') {
    session_start();
}?>
<!DOCTYPE html>
<html>

	<head>

		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
		
		<link href="CSS/styles.css" type="text/css" rel="stylesheet">

		<div id="banner">
	    	<img src="images/logo3.png" alt="Cornell Ski Team" class="bannerImage">
	  	</div> <!--end banner div-->
	  	
		<?PHP
		include("navigation.php");
		require_once("config.php");
		include ("functions.php");
		?>

	</head>

	<body>

		<div class="container">
	    <?php include("vertnav.php"); ?>
	    </div>

	</body>

</html>
