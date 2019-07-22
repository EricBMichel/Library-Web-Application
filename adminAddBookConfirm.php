<?php
	session_start();
	if ($_SESSION["type"] != 'Admin') {
		header("Location: reconfirm.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>CCT Library - Book Added!</title>
</head>
<body>

	<div class="left-div"></div>
	<div class="mid-div" style=" text-align: center">
		<div style="text-align: center;" ><img src="img/logo.png"></div>
		<?php include('adminHeader.php');?>
		<h2 style="font: 25px Lucida Sans Unicode">Book Added!</h2>

		<?php	
			include('db.php');
			$stmt = $DBH->prepare("SELECT * FROM library");
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(isset($_SESSION['title'])){
			echo "<br/>
					<div style ='font:21px Lucida Sans Unicode;'> 
						Title: ".
						"<div style ='font:21px;color:#FF0000'>"
							.$_SESSION["title"].
						"</div>".
					"</div>";
			echo "<br/>
					<div style ='font:21px Lucida Sans Unicode;'>
						Author: ".
						"<div style ='font:21px;color:#FF0000'>"
						.$_SESSION["author"].
						"</div>".
					"</div>";

			unset($_SESSION['title']);
			unset($_SESSION['author']);
			
			}
		?>
		<br><br>

		<a class="button" href="adminLibrary.php">Head to the Library here</a>
	</div>
	<div class="right-div"></div>
	<br style="clear: left;">

</body>

</html>