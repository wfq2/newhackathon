<nav id='teamnav'>

		<ul class="vert-nav_box">

		<li>
			<a href='team.php' class="vert-nav_items">
				Main
			</a>
		</li>

		<li>
			 <a href='schedule.php' class="vert-nav_items">
				 Schedule
			 </a>
		</li>

		<li>
			 <a href='roster.php' class="vert-nav_items">
				 Team
			 </a>
		</li>

			<form method = 'post' class="text" style= "margin-left:40px">
		    	<button type = 'submit' name = 'logout' onClick = "team.php" class="button"><span>Logout</span></button>
		  	</form>


		</ul>

</nav>

	<?php
	if (isset($_POST['logout'])){
		session_destroy();
	}
	 ?>
