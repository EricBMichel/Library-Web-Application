<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>CCT Library - Registration Complete!</title>
</head>
<body>

<div class="left-div"></div>
<div class="mid-div" ">
	<div style="text-align: center;" ><img src="img/logo.png"></div>
	<div style="text-align: center;">
		<h2 style="font: 25px Lucida Sans Unicode">Registration Complete!</h2>
		
	<?php
		if (isset($_SESSION["username"]))  {
			echo "<br/>
				<div style ='font:21px Lucida Grande;'> 
					You are now registered as: ".
					"<div style ='font:21px,Lucida Grande;color:#FF0000'>"
						.$_SESSION["username"].
					"</div>".
				"</div>";
				echo "<br/>
				<div style ='font:21px Lucida Grande;'>
					Student Number: ".
					"<div style ='font:21px,Lucida Grande;color:#FF0000'>"
					.$_SESSION["student_id"].
					"</div>".
				"</div>";
		}
	?>
	<br><br>
	<a class="button" href="userIndex.php">Head to the Library here</a>
	</div>
</div>
<div class="right-div"></div>
<br style="clear: left;">

</body>

</html>