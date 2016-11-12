<?php if(session_id() == '') {
    session_start();
}?>
<!DOCTYPE html>
<html>

    <head>
	<title>Skiing: Roster</title>

	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <?php include("vertnav.php"); ?>
    	<div class="container">

        <div class="center">
            <h1 class="pHeader">Roster</h1>
        </div>

        <?php
          $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
          $people = $mysqli->query("SELECT * FROM login WHERE username <> 'admin'");
          while ($row = $people->fetch_assoc()){
            printpeople($row);
          }
         ?>


       </div>

    </body>

</html>
