<?php if(session_id() == '') {
    session_start();
}?>
<!DOCTYPE html>
<html>

	<head>
		<title>Skiing: Team</title>

		<link rel="shortcut icon" type="image/x-icon" href="myicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="CSS/styles.css" type="text/css" rel="stylesheet">

		<div id="banner">
	    	<img src="images/logo3.png" alt="Cornell Ski Team" class="bannerImage">
	  	</div> <!--end banner div-->

		<?PHP include("navigation.php");
		require_once("config.php");
		include ("functions.php");
		?>

	</head>

	<body>

		<?php if(!isset($_SESSION['user'])) : ?>
		 <div class="center"><br><br><br>
		    <img src="images/final logo.png" alt="Logo" width="300px" height = "auto"> <br><br><br><br>
		    <form method='post' action="team.php" class="text">
			Username: <br>
			<input type = 'text' name = 'username' > <br>
			Password: <br>
			<input type = 'password' name = 'password'> <br>
			<input type = 'submit' name = 'login' value= 'Login'>
		  	<br>
		  	<br>
			</form>
		</div>

		<a href="newuser.php" class="text">Make New Account </a>

		<?php else : ?>
			<?php include("vertnav.php"); ?>
		  <div class="container">
				<div class="center">
				<h1 class="pHeader">Announcements</h1>
				</div>


			  <?php if ($_SESSION['user']=='admin') : ?>
			    <form method = 'post' class="text">
			      Title <input type = 'text' name = 'title'> <br><br>
			      Text <br><textarea rows = "4" cols = "50" name = "text"> </textarea> <br><br>
			      <button type = 'submit' name = 'makeannouncement' class="button Lbutton"><span>Post</span></button>
			  <?php endif; ?>
				<?php
				printannouncements();
				endif;
				?>

				<br><br>

				<p class="text">
				<?php

				$title = filter_input( INPUT_POST, 'title', FILTER_SANITIZE_STRING );
				$text = filter_input( INPUT_POST, 'text', FILTER_SANITIZE_STRING );

				if (isset($title) & isset($text) & isset($_POST['makeannouncement'])){
				  $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
				  $usermatch = $mysqli -> query("INSERT INTO `announcements` (`aID`, `date`, `title`, `text`) VALUES (NULL, CURDATE(), '$title', '$text')");

				}




				$username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
				$password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );

				if (isset($username) & isset($password) & isset($_POST['login'])){
							$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
							$usermatch = $mysqli -> query("SELECT * FROM login WHERE username = '$username'");
							$assoc = $usermatch->fetch_assoc();
							if (password_verify($password,$assoc['password'])){
								echo "Logged in ";
								$_SESSION['user'] = $username;
								echo $_SESSION['user'];
							}
							else{
								echo "failed to login";
							}

				}

				 ?>
			 </p>

		</div>

	</body>

</html>
