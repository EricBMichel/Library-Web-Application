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
	<title>CCT Library - Admin Library</title>
</head>
<body>

	<div class="left-div"></div>
	<div class="mid-div">
		<div style="text-align: center;" ><img src="img/logo.png"></div>
	
			<?php
				include('adminHeader.php');
				include('db.php');
				$stmt = $DBH->prepare("SELECT * FROM library");
				$stmt->execute();
				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			?>

			<h2 style="font: 25px Lucida Sans Unicode">Welcome to the Library!</h2>
			<div style="width: 99.8%; height: 67%; overflow-y: scroll; border:1px solid;">
				<?php
					echo "<table>";
					echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>ISBN</th><th>Status</th></tr>";
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
						echo $row['isbn'];
					echo "</td>";
					echo "<td>";
					if ($row['status'] == "Checked Out") {
						echo "<div style ='font: Lucida Sans Unicode,sans-serif;color:#FF0000'>Checked Out</div>";
					}else{
						echo "<a style ='Lucida Sans Unicode,sans-serif;color:Green'>Available</a>";
					}
					}
					echo "</table>";

					include('dberror.php')
				?>
			</div>
	</div>

	<div class="right-div"></div>
	<br style="clear: left;">

</body>

</html>