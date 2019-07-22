<?php
	session_start();
	if ($_SESSION["type"] != 'Student') {
		header("Location: reconfirm.php");
	}
	include('db.php');
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="tablestyle.css">
	<title>CCT Library - My Books</title>
</head>
<body>

<div class="left-div"></div>
<div class="mid-div">
	<div style="text-align: center;" ><img src="img/logo.png"></div>

	<?php
		include('userHeader.php');	
	?>

	<div style="width: 100%; height: 15%; text-align: center;">
		<?php 
		"<div style='margin: 1px auto'>";
		echo 
		"<div style ='font:19px Lucida Grande; margin:1px auto'> 
			Logged in as:".
			"<div style ='color:#FF0000'>"
				.$_SESSION["username"].
			"</div>".
		"</div>";

		echo 
		"<div style ='font:19px Lucida Grande; margin:1px auto'>
			Student Number: ".
			"<div style ='color:#FF0000'>"
				.$_SESSION["student_id"].
			"</div>".
		"</div>";
		"</div>" 
		?>	
	</div>

	<div style="width: 99.8%; height: 64.9%; overflow-y: scroll; border:1px solid;">
	<?php

	$stmt = $DBH->prepare("SELECT title, author, due_date  FROM library A LEFT OUTER JOIN checkout B ON A.book_id=B.book_id WHERE student_id IS NOT NULL AND student_id={$_SESSION['student_id']};");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo "<table>";
	echo "<tr><th>Title</th><th>Author</th><th>Due Date</th></tr>";
		foreach($rows as $row){
			echo "<tr>";
			echo "<td>";
				echo $row['title'];
			echo "</td>";
			echo "<td>";
				echo $row['author'];
			echo "</td>";
			echo "<td>";
				echo date('d-m-Y', strtotime($row['due_date']));
		}
	echo "</table>";
	include('dberror.php');
	if (empty($rows)) {
		echo "<div style ='font:18px Lucida Sans Unicode,sans-serif;color:#FF0000'> You have no books checked out!</div>";
	}
	?>
	</div>


		
	</div>
	<div class="right-div"></div>
	<br style="clear: left;">

</body>

</html>