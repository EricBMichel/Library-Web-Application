<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>CCT Library - Logged Out!</title>
</head>
<body>

	<div class="left-div"></div>
	<div class="mid-div">
		<div style="text-align: center;"><img src="img/logo.png"></div>

		<div style="text-align: center;">

		<br><br>
		<h2 style="font: 25px Lucida Sans Unicode">Something went wrong...</h2>

		<?php
			session_start();
			session_destroy();
			echo "<div style ='font:22px Lucida Sans Unicode,sans-serif; margin:1px auto; text-align:center'>Please log in again!</div>";
			header("refresh:3;url=welcome.php");	
		?>
		<br><br>
		<a class="button" href="welcome.php">Home</a>

		</div>
	</div>

	<div class="right-div"></div>
	<br style="clear: left;">

</body>

</html>