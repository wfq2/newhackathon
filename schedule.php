<?php if(session_id() == '') {
    session_start();
}?>
<!DOCTYPE html>
<html>

    <head>
	<title>Skiing: Schedule</title>
    	
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="CSS/styles.css" type="text/css" rel="stylesheet">

        <div id="banner">
            <img src="images/logo3.png" alt="Cornell Ski Team" class="bannerImage">
        </div> <!--end banner div-->

        <?PHP include("navigation.php");
        require_once("config.php");
        ?>

    </head>

    <body>
        <?php include("vertnav.php"); ?>

    	<div class="container">

            <div class="center">
         	  <h1 class="pHeader">Schedule</h1>
         	</div>

         	<br><br>
            <br><br>

            <div class = "center">
                <div id = "calendar">
                <iframe src="https://calendar.google.com/calendar/embed?src=cornellalpineskiteam%40gmail.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>

        </div>

    </body>

</html>
