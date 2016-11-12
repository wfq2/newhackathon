<?php if(session_id() == '') {
    session_start();
	}?>
<!DOCTYPE html>
<html>

	<head>
		<title>Cornell Alpine Skiing | About</title>
		<meta name="description" content = "Learn about one of the best student run club sport group on campus, the Cornell Ski Team">
		<meta name = "keywords" content = "cornell skiing,cornell ski team,cornell,skiing,alpine,team">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="myicon.ico">
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
	
	<meta property="og:description"        content="Welcome to the Official Site of the Cornell Ski Team" />
	<meta property="og:image"              content="http://cornellalpineskiing.com/images/final%20logo2.png"/>

		<link href="CSS/styles.css" type="text/css" rel="stylesheet">


	</head>

	<body>
		<?PHP include("navigation.php"); ?>
		<div class="container">
			<section class="content">
			<h1 class="pHeader">About</h1>

	  		<div>
	    		<img src="images/final logo2.png" alt="logo" width="300" height="auto" style="float:right;style:inline-block;">
	  		</div>

			<p class="text">
			The Cornell Alpine Ski Team is a co-ed, student run, club team that races in the United States Collegiate Ski Association (USCSA). We race and train at Greek Peak Mountain and compete all around New York state. For the past ten years we have qualified for the USCSA National Championships, which has provided us the opportunity to compete against other alpine teams from across the nation. The season begins in January with a pre-season on-snow training week and the racing officially begins in the middle of January, continuing through February.
			</p>

			<p class="text">
			In 2015, the Men's Varsity team placed 1st in the Mideast Region, and the Women's team placed 3rd. We are looking forward to getting back on the slopes in January for hopefully another great season! Make sure to check out our News and Results page for archived race results!
			</p>

			<h2 class="pHeader">Program Overview</h2>

			<p class="text">
			The Cornell Ski Team offers a variety of advantages to students who would like to focus on their studies as well as engage in a team that has a history of success competing.  We start off the season a few weeks into school with captain run dry land practices.  After winter break, we begin training on snow starting with ski week - a week of skiing and team bonding activities before second semester.  All of our training takes place at Greek Peak Resort, a local mountain about twenty five minutes away from campus.  Throughout January and February, our Varsity and JV teams race within the USCSA Mideast conference, often qualifying for regional and national championships.
			</p>

			<p class="text">
			All practices and training sessions are optional, as we understand that academics come first.  However, Varsity athletes are expected to attend most practices in order to maintain their spot on the travel team.  With such a great program, it is no surprise that the Cornell Ski 	Team has had so much success both as a club and competitive team.
			Support the Cornell Alpine and Nordic Teams with your tax-deductible gift to Cornell University.
			</p>

	  		<h3 class="pHeader">Donate</h3>

			<p class="text">
			To make a gift,
			<a href = "https://securelb.imodules.com/s/1717/alumni/index.aspx?sid=1717&gid=2&pgid=403&cid=1031&dids=404&sort=1&bledit=1"> Donate Here
			</a>
			and specify Cornell Ski Team; we thank you in advance.
			</p>
		</section>
		<?php require_once('footer.php'); ?>
		</div>

	</body>

</html>
