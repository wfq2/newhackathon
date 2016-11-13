<?php if(session_id() == '') {
session_start();
}?>
<!DOCTYPE html>
<html>

    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="data.js"</script>
	<title>Cornell Alpine Skiing</title>

	<link rel="shortcut icon" type="image/x-icon" href="myicon.ico">
	<meta name="google-site-verification" content="jLqIv-bYHodHnaXXeR_94O8GVGkyZ6ijJxWitVI65Zw" />
	<meta name="keywords" content="cornell,skiing,cornell skiing,cornell alpine,cornell racing,cornell alpine skiing,cornell alpine racing,cornell ski team,cornell alpine ski team">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="Welcome to the official site of the Cornell Alpine Ski Team">

<meta property="og:description"        content="Welcome to the Official Site of the Cornell Ski Team" />
<meta property="og:image"              content="http://cornellalpineskiing.com/images/final%20logo2.png"/>


        <link href="CSS/styles.css" type="text/css" rel="stylesheet">

        

        <?PHP
        include("navigation.php");
        require_once("config.php");
        ?>



    </head>

    <body>

        
        <?php require_once('footer.php'); ?>
        </div>

    </body>

</html>
