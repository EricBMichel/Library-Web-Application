<?php
session_start();
$username="";
$message = "";

if($_POST){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$type = $_POST['type'];

	try{
		include('db.php');
		if($type=='Admin') {
			try{
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
					}else{$message = 'Incorrect password, please try again.';}
				
				}else{$message = 'Reserved for Admins only!';}
			}catch(PDOException $e) {echo 'Error' . $e;}

		}else{
				$q = $DBH->prepare("select * from users where username = :username LIMIT 1");
				$q->bindValue(':username', $username);
				$q->execute();
				$row = $q->fetch(PDO::FETCH_ASSOC);
		
				if($q->rowCount() > 0) {
					$phash = $row['password'];
		
					if(password_verify($password,$phash)){
						$username = $row['username'];
						$student_id = $row['student_id'];
						$_SESSION["type"] = $_POST['type'];
						$_SESSION["username"] = $username;
						$_SESSION["student_id"] = $student_id;
						header('Location: userIndex.php');
					}else {$message = 'Incorrect password, please try again.';}
					
				}else{$message = 'User does not exist.</br>Please create a new account.';}}
	}catch(PDOException $e) {echo 'Error' . $e;}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>CCT Library - Welcome to the CCT Library!</title>
</head>
<body>

	<div class="left-div"></div>
	<div class="mid-div">
		<div style="text-align: center;"><img src="img/logo.png"></div>

		<h2 style="font: 25px Lucida Sans Unicode">Welcome to the CCT Library!</h2>

		<form class="form-style" action="welcome.php" method="post">  
			Username: 		<input type="text" name="username" value="<?php echo $username?>" required /><br>
			Password: 		<input type="password" name="password" required /><br>
			<input class="button" type="radio" name="type" value="Student" method ="post" checked>Student</input>
			<input class="button" type="radio" name="type" value="Admin" method ="post">Admin</input><br><br>
			<input class="button" type="submit" name="submit" value="Login"/>
			<?php
			if(!empty($message)){
				echo "<div style ='font:21px,Lucida Grande;color:#FF0000'>".$message."</div>";
			}
			?>
			<br><br>
			<a class="button" href="register.php">Create a new account</a>
		</form>
	</div>

	<div class="right-div"></div>
	<br style="clear: left;">

</body>

</html>