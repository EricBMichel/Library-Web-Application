<?php
	session_start();
	if ($_SESSION["type"] != 'Admin') {
		header("Location: reconfirm.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="tablestyle.css">
	<link rel="stylesheet" href="style.css">
	<title>CCT Library - Checked Out Books</title>
</head>
<body>

<div class="left-div"></div>
<div class="mid-div">
	<div style="text-align: center;" ><img src="img/logo.png"></div>
	
		<?php
			include('db.php');
			include('adminHeader.php');
			$stmt = $DBH->prepare("SELECT * FROM library A LEFT OUTER JOIN checkout B ON A.book_id=B.book_id WHERE status = 'Checked Out'");
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		?>

		<h2 style="font: 25px Lucida Sans Unicode">All Checked Out Books!</h2>
		<div style="width: 99.8%; height: 67%; overflow-y: scroll; border:1px solid;">
			<?php
				echo "<table>";
					echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Student ID</th></tr>";
					foreach($rows as $row){
						echo "<tr>";
						echo "<td>";
							echo $row['book_id'];
						echo "</td>";
						echo "<td>";
							echo $row['title'];
						echo "</td>";
						echo "<td>";
							echo $row['author'];
						echo "</td>";
						echo "<td>";
							echo $row['student_id'];
						echo "</td>";
						echo "<td>";
						echo "<a class='button' href=adminCheckInBook.php?id=".$row['book_id'].">Check In</a>";
					}
				echo "</table>";
				include('dberror.php');
				if (empty($rows)) {
					echo "<div style ='font:18px Lucida Sans Unicode,sans-serif;color:#FF0000'> No books have been checked out!</div>";
				}
			?>
		</div>
</div>

<div class="right-div"></div>
<br style="clear: left;">

</body>

</html>