<?php if(session_id() == '') {
session_start();
}?>
<!DOCTYPE html>
<html>

    <head>
	<title>TRIM</title>
	<title>Cornell Alpine Skiing</title>


        <link href="CSS/styles.css" type="text/css" rel="stylesheet">

        

        <?PHP
        //include("navigation.php");
        //require_once("config.php");
        ?>



    </head>

    <body>
    <div id="totaldeposited"></div>
    <div id="numberdeposits"></div>
        
    <?php require_once('footer.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="data.js"></script>

    </body>

</html>
