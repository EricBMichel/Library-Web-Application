<?php
	$bid = $_GET['id'];

	include('db.php');


	$stmt = $DBH->prepare("INSERT INTO checkout (student_id, book_id) VALUES ({$_SESSION['student_id']}, :bid);");
	$stmt -> bindValue(':bid', $bid);
	$stmt -> execute();

	include('dberror.php');

	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	



?>