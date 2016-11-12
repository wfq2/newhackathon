<?php if(session_id() == '') {
session_start();
}?>
<!DOCTYPE html>
<html>

    <head>
	<title>Cornell Skiing: Contact Us</title>

	<link rel="shortcut icon" type="image/x-icon" href="myicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="CSS/styles.css" type="text/css" rel="stylesheet">


        <?PHP
        include("navigation.php");
        require_once("config.php");
        ?>


    </head>


    <body>

        <div class="container">
            <div class="content">
            
            <h1 class="pHeader">Contact Information</h1>
            

            <br>

            <div class = "text">
                Feel free to reach out to us!  If you have any questions about the team please utilize
                our contact form or contact a member of our eboard directly.  We love talking about
                the team to prospective students.
            </div>

            <br>
            <br>

            <div class = "center">
            <div id = "eboard">
                <img src="images/eboard/Wyatt.png" alt="Wyatt Queirolo"> <br>
                Men's Captain <br>
                Wyatt Queirolo<br>
                wfq2@cornell.edu <br>
                (860) 335-9612<br>
            </div>

            <div id = "eboard">
                <img src="images/eboard/abby.png" alt="Abby Brown"> <br>
                Women's Captain <br>
                Abby Brown <br>
                asb299@cornell.edu <br>
                (914) 400-3326 <br>
            </div>

            <div id = "eboard">
                <img src="images/eboard/kg.jpg" alt="Kg Norris"> <br>
                President <br>
                Kg Norris <br>
                kn293@cornell.edu <br>
                (585) 905-7274 <br>
            </div>

            <div id = "eboard">
                <img src="images/eboard/varon.jpg" alt="Alex Varon"> <br>
                JV Captain <br>
                Alex Varon<br>
                ajv45@cornell.edu<br>
                (585) 301-1930<br>
            </div>

            <div id = "eboard">
                <img src="images/eboard/mards.png" alt="Andrew Marderstein"> <br>
                JV Captain <br>
                Andrew Marderstein <br>
                arm286@cornell.edu <br>
                (914) 806-1890 <br>
            </div>

            <div id = "eboard">
                <img src="images/eboard/sean.png" alt="Sean Giannotto"> <br>
                Alumni Chair <br>
                Sean Giannotto <br>
                smg329@cornell.edu <br>
                (203) 962-3400 <br>
            </div>
            </div>

            <br>
            <br>

            <h1 class = "pHeader">Contact Form</h1>

            <form id = "contactform" method = "post" class="text">
            Name
            <input type="text" name = "name"> <br><br>
            Email
            <input type ="email" name = "email"><br><br>
            Message<br>
            <textarea rows = "4" cols = "50" name = "message"> </textarea><br><br>

            <button type = 'submit' name = 'sendmessage' class="button Lbutton"><span>Send</span></button>

            </form>
		
		<div class="text">
            <?php
            $name = filter_input( INPUT_POST, 'name', FILTER_SANITIZE_STRING );
            $email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
            $message = filter_input( INPUT_POST, 'message', FILTER_SANITIZE_STRING );
            if (isset($name) & isset($email) & isset($_POST['sendmessage'])){
            $text = "Email: ".$email."\n\n".$message;
            $subject = "Message From ".$name;
            if (mail("cornellalpineskiteam@gmail.com", $subject,$text)){
            echo "Mail sent!";
            }

            }

            ?>
		</div>
        </div>
        <?php require_once('footer.php'); ?>
    </div>
    </body>

</html>
