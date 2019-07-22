<?php
	session_start();
	if ($_SESSION["type"] != 'Student') {
		header("Location: reconfirm.php");
	}
	$bid = $_GET['id'];
	
	include('db.php');

	$stmt = $DBH->prepare("UPDATE library SET status='Checked Out', due_date = DATE_ADD(NOW(), INTERVAL 7 DAY) WHERE book_id= :bid;");
	$stmt -> bindValue(':bid', $bid);
	$stmt -> execute();

	include('userUpdateCart.php');
	include('dberror.php');

	$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>CCT Library - Your book has been checked out!</title>
</head>
<body>

	<div class="left-div"></div>
	<div class="mid-div">
		<div style="text-align: center;" ><img src="img/logo.png"></div>
		<br><br><br>
		<h2 style="font: 25px Lucida Sans Unicode; text-align: center;">
			Your book has been checked out!<br><br>
			You will be redirected to <br>'My Books'.

		</h2>
		<br><br><br>

		<?php		
		header("refresh:4;url=userIndex.php");
		?>

		<div style="text-align: center"><a class="button" href="userIndex.php">Back to 'My Books'</a></div>


	<div class="right-div"></div>
	<br style="clear: left;">

</body>

</html>