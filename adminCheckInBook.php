<?php
	$bid = $_GET['id'];

	include('db.php');

	$stmt = $DBH->prepare("UPDATE library SET status='Available', due_date = NULL WHERE book_id= :bid");
	$stmt -> bindValue(':bid', $bid);
	$stmt -> execute();
	include('adminUpdateStatus.php');
	include('dberror.php');

	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	header('Location: adminCheckedOutBooks.php');
?>