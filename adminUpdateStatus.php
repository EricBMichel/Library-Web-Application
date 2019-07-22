<?php
	$bid = $_GET['id'];

	include('db.php');

	$stmt = $DBH->prepare("DELETE FROM checkout WHERE  book_id=:bid");
	$stmt -> bindValue(':bid', $bid);
	$stmt -> execute();

	include('dberror.php');

	$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>