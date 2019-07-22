<?php
	session_start();
	if ($_SESSION["type"] != 'Student') {
		header("Location: reconfirm.php");
	}
	include('db.php');
	$user_input = "";
	if($_POST){
		$user_input = $_POST["user_input"];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<style> input[type=text] {height: 28px; width: 50%; margin:1px auto; padding: 5px}</style>
	<link rel="stylesheet" href="tablestyle.css">
	<link rel="stylesheet" href="style.css">
	<title>CCT Library - Student Library</title>
</head>
<body>

<div class="left-div"></div>
<div class="mid-div">
	<div style="text-align: center;"><img src="img/logo.png"></div>
	
	<?php
		include('userHeader.php');
	?>

	<div style="width: 100%; height: 15%; text-align: center;">
	<form action='wildcard.php' method='GET' style="font:16px Lucida Sans Unicode,sans-serif;">
		<input type="text" name="book_search" placeholder="Search for a book here" autocomplete="off" required>
		<input class="button" type="Submit" name="Submit" value="Search">
	</form>
	</div>

	<div style="width: 99.8%; height: 64.9%; overflow-y: scroll; border:1px solid;">
	<?php

	$stmt = $DBH->prepare("SELECT * FROM library");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
	echo "<table>";
	echo "<tr><th>Title</th><th>Author</th><th>ISBN</th></tr>";
		foreach($rows as $row){
			echo "<tr>";
			echo "<td>";
				echo $row['title'];
			echo "</td>";
			echo "<td>";
				echo $row['author'];
			echo "</td>";
			echo "<td>";
				echo $row['isbn'];
			echo "</td>";
			echo "<td>";

			if ($row['status'] == "Checked Out") {
				echo "<div style ='font: Lucida Sans Unicode,sans-serif;color:#FF0000'><b>Unavailable<b></div>";
			}else{
				echo "<a class='button' style='background:Green' href=userCheckOutBook.php?id=".$row['book_id'].">Check Out</a>";
			}
		}
	echo "</table>";
	include('dberror.php');
	if (empty($rows)) {
		echo "<div style ='font:18px Lucida Sans Unicode,sans-serif;color:#FF0000'> There are no results! </br> Please try again!</div>";
	}
	?>
	</div>
</div>

<div class="right-div"></div>
<br style="clear: left;">

</body>

</html>