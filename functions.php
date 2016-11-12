<?php
require_once("config.php");

function makeaccount($user,$pass,$first,$last,$email){
  $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $mysqli -> query("INSERT INTO `login`(`username`, `password`, `email`, `firstname`, `lastname`) VALUES ('$user','$pass','$email','$first','$last')");
  $mysqli->close();
  echo "<p class='text'> account created <\p>";
}

function getdat($timestamp){
    $array = explode($timestamp);
    return $array;
  }

function printannouncements(){
  $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $announce = $mysqli ->query ("SELECT * FROM announcements ORDER BY aID DESC LIMIT 10");
  while ($row = $announce->fetch_assoc()){
  $date = date($row['date']);
  echo '<div class = "announcement center">';
  echo '<div>
    <img src="images/final logo2.png" alt="logo" width="100" height="auto" style="float:left;style:inline-block;">
  </div>';
  echo "<div style = 'font-size: 25px;color:black;'>".$row['title']."</div>"."     ".$date;
  echo "<br><br>";
  echo  $row['text'];
  echo '</div>';
  }

}

function validatefile($file){
	$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
	if ($file['tmp_name'] == ''){
    echo "tmpname was wrong";
		return false;
	}
	return true;
}

function printpeople($assoc){
  echo "<p class = 'pHeader'>";
  echo "Name:  ".$assoc['firstname']."   ".$assoc['lastname'];
  echo "</p> <br>";

}

function validateuser($email,$pass1,$pass2){
  $exploded = explode('@', $email);
  $domain = array_pop($exploded);
  if ($domain != "cornell.edu"){
    echo "<p class='text'>You must use a Cornell email to create an account, please submit again</p>";
    return false;
  }
  if ($pass1 != $pass2){
    echo "<p class = 'text'>Passwords don't match, please submit again</p>";
    return false;
  }
  return true;

}


 ?>
