<?php if(session_id() == '') {
    session_start();
    }?>
<!DOCTYPE html>
<html>
    <head>
	<title>Skiing: New User</title>

	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="CSS/styles.css" type="text/css" rel="stylesheet">

        <div id="banner">
            <img src="images/logo3.png" alt="Cornell Ski Team" class="bannerImage">
        </div> <!--end banner div-->

        <?php
        include("navigation.php");
        require_once("config.php");
        include_once("functions.php");
        ?>

    </head>


    <body>

        <div class="container">
          <div class="center"><h1 class="pHeader">Create New Account </h1></div>
            <p class= "text"> Please note you must use a Cornell email to create an account </p>


            <form method="post" class="text">
            Email: <br>
            <input type = "text" name = "email"> <br>
            Username: <br>
            <input type = "text" name = "username"> <br>
            Password: <br>
            <input type = "password" name = "password1"> <br>
            Retype Password: <br>
            <input type = "password" name = "password2"> <br>
            First Name: <br>
            <input type = "text" name = "firstname"> <br>
            Last Name: <br>
            <input type = "text" name = "lastname"> <br><br>

            <button type = 'submit' name = 'login' class="button Lbutton"><span>Create</span></button>
            </form>

            <?php

            $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
            $text = filter_input( INPUT_POST, 'password1', FILTER_SANITIZE_STRING );
            $text2 = filter_input( INPUT_POST, 'password2', FILTER_SANITIZE_STRING );
            $hashed = password_hash($text,PASSWORD_DEFAULT);
            $first = filter_input( INPUT_POST, 'firstname', FILTER_SANITIZE_STRING );
            $last = filter_input( INPUT_POST, 'lastname', FILTER_SANITIZE_STRING );
            $email = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );

            if (isset($username) & isset($hashed) & isset($_POST['login']) & isset($first) & isset($last) & isset($email)) {
                if (validateuser ($email,$text,$text2)){
                    makeaccount($username,$hashed,$first,$last,$email);
                }
            }
            ?>

            <a href="team.php" class="text">Back <a>

        </div>

    </body>

</html>
