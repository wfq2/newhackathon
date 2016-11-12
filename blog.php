<?php if(session_id() == '') {
	session_start();
	}?>
<!DOCTYPE html>
<html>

	<head>
		
		<title>Cornell Ski Team: Blog</title>

		<link rel="shortcut icon" type="image/x-icon" href="myicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="CSS/styles.css" type="text/css" rel="stylesheet">

		<?PHP include("navigation.php");?>

	</head>

	<body>

		<div class="container">
			<div class="content">
			<div class="center">
				<h1 class="pHeader">
					Cornell Ski Club Team Blog
				</h1>
			</div> <!--end div header-->

			<?php if(session_id() == '') {
	    		session_start();
				}?>

			<p class="text center"><b>Welcome</b>
			<?php if (isset($_SESSION['user'])) {
				echo $_SESSION['user'];
				}?>
			<b>!</b></p>

			<?php if(isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) : ?>
				<div id="makePost">
					<form method="post" enctype="multipart/form-data" class="text">
						<p>
							<br>Embedded Post <br><input type="text" name="post" class="txt" required><br>
						</p>

						<p>
							Title <br><input type="text" name = "title">
						</p>

						<p>
							Text <br><textarea rows = "4" cols = "50" name = "text"> </textarea>
						</p>

						<p>
							<button type = 'submit' name = 'submitpost' class="button Lbutton"><span>Upload Blog</span></button>
						</p>
					</form>

				</div> <!-- end div makePost -->


			<?php
				endif;
				require_once 'config.php';
				$instanceMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				//Will retrieve the posts from table Blog and display them
				$posts = $instanceMysqli->query("SELECT * FROM posts ORDER BY postID DESC LIMIT 10");
				while($row = $posts->fetch_assoc()){

					echo "<div class = 'center'>";
					echo "<div class = 'blogLine'>";
					echo "<div class = 'blogPost'>";
					echo "<h2>".$row['title']."</h2>";
					echo "<br>".$row['text']."<br><br>";
					echo $row['embeddedpost'];
					echo "</div></div></div> <br>";
				}

				if(isset($_POST['post']) & isset($_POST['submitpost'])){
					$instanceMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
					$post = $_POST['post'];
					$text = $_POST['text'];
					$title = $_POST['title'];

					$uploadPost = $instanceMysqli->query("INSERT INTO `posts`(`date`, `text`, `title`, `embeddedpost`) VALUES (CURRENT_TIMESTAMP,'$text','$title','$post')");
				}
				?>

		</div>
		<?php require_once('footer.php'); ?>
	</div>
	</body>

</html>
