<?php
	include('db.php');
	$q = $DBH->prepare ("SELECT * FROM library WHERE title LIKE '%$search%' ORDER BY id DESC ");
?>