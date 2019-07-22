<?php

$username="";
$message = "";


if($_POST){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$type = $_POST['type'];

	try{
		include('db.php');
		$q = $DBH->prepare("select * from admin where username = :username LIMIT 1");
		$q->bindValue(':username', $username);
		$q->execute();
		$row = $q->fetch(PDO::FETCH_ASSOC);

		if($q->rowCount() > 0) {
			$phash = $row['password'];

			if(password_verify($password,$phash)){
				$username = $row['username'];
				$_SESSION["type"] = $_POST['type'];
				$_SESSION["username"] = $username;
				header('Location: adminLibrary.php');
			}
			
		}
	}catch(PDOException $e) {echo 'Error' . $e;}
}

if($type=='Admin') {
			$q = $DBH->prepare("select * from admin where username = :username LIMIT 1");
			$q->bindValue(':username', $username);
			$q->execute();
			$row = $q->fetch(PDO::FETCH_ASSOC);
			
			if($q->rowCount() > 0) {
				$phash = $row['password'];

			if(password_verify($password,$phash)){
				$username = $row[2];
				$_SESSION["type"] = $_POST['type'];
				$_SESSION["username"] = $username;
				header('Location: adminLibrary.php');
				}	
			}


			