<?php if(session_id() == '') {
session_start();
}?>
<!DOCTYPE html>
<html>

	<head>
		<link rel="shortcut icon" type="image/x-icon" href="myicon.ico">
		<title>Cornell Alpine Skiing | Results</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="CSS/styles.css" type="text/css" rel="stylesheet">

		<?php include("navigation.php");
		include ("config.php") ;
		include ("functions.php");?>

	</head>

	<body id="resultspage">

		<div class="container">
			<div class="content">
		<?php if(isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) : ?>

			<div id="makePost">

				<form method="post" enctype="multipart/form-data" class="text">
					<p>
						<br>Results PDF <input type="file" name="file" id = "file" required><br>
					</p>
					<p>
						Race Name <input type="text" name = "name">
					</p>
					<p>
					Gender <select name = 'gender' required>
						<option value="men">Men</option>
	  					<option value="women">Women</option>
					</select>
					</p>

					<p>

						<button type = "submit" name = "submitpost" class="button Lbutton"><span>Upload</span></button>
					</p>

				</form>

			</div>

			<?php endif; ?>

	<?php if(!isset($_GET['results'])) : ?>
		<h1 class = "pHeader">2016 Varsity Race Schedule:  Mideast Collegiate Ski Conference</h1>
		<p class="text">
		Jan 16-17: Labrador <br>
		Jan 23-24: Bristol <br>
		Jan 30-31: Greek Peak (HOME RACE) <br>
		Feb 6-7: Holiday Valley <br>
		Feb 13-14: Toggenburg <br>
		Feb 20-21: Bristol - Regionals <br>
			</p>
		<p class = "pHeader"> Past Results </p>

			<?php
				$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				$years = $mysqli->query("SELECT DISTINCT YEAR(date) AS year FROM results");
				while ($row = $years->fetch_assoc()){
					$link1 = "results.php?results=".$row['year']."men";
					$value1 = $row['year']." Men";
					$link2 = "results.php?results=".$row['year']."women";
					$value2 = $row['year']." Women";
					echo "<br> <a class = 'pHeader' style='padding:20px;float:left;' href = '$link1'> $value1 </a>";
					echo "<a class = 'pHeader' style='padding:20px;float:left;' href = '$link2'> $value2 </a> <br>";
				}
			 ?>


			<?php else : ?>

				<?php
					$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
					$results = $_GET['results'];
					$year = substr($results,0,4);
					$gender = substr($results,4);
					$title = ucfirst($gender." ".$year);
					echo "<h1 class='pHeader'>$title</h1><br>";
					$pages = $mysqli->query("SELECT * FROM results WHERE gender ='$gender' AND YEAR(date)='$year' ORDER BY resultID DESC");
					while ($row = $pages->fetch_assoc()){
						$src = $row['pdfname'];
						$name = $row['location'];
						echo "<p class='pHeader'>".$name."</p><br>";
						echo "<iframe class = 'resultspdf center' src='$src' width = '100%' height = '400px'></iframe><br>";

					}
				 ?>

			<?php endif; ?>




			<?PHP
			if (isset($_FILES['file'])){
				//echo '<pre>' . print_r( $_FILES, true ) . '</pre>';
				$newphoto = $_FILES['file'];
				if (validatefile($newphoto)){
					echo "in validatefile";
				$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
				$originalname = $newphoto['name'];
				$tempName = $newphoto[ 'tmp_name' ];
				$gender = $_POST['gender'];
				if (isset($_POST['name'])){
				$location = $_POST['name'];}
				$originalname = 'resultspdf/'.$originalname;
			$query = "INSERT INTO `results`(`resultID`, `location`, `date`, `pdfname`, `gender`)
			VALUES (NULL,'$location',CURRENT_TIMESTAMP,'$originalname','$gender')";
				$mysqli -> query($query);
				if (move_uploaded_file($tempName, $originalname ))
				{echo "movefileworked";}
				else{
					echo "movefiledidntwork";
				}

			}}
			?>
			</div>
			<?php require_once('footer.php'); ?>
		</div>

	</body>

</html>
