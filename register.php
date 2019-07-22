<?php
	$usernameErr="";
	$username = "";
	$passwordErr="";
	$password = "";
	$student_idErr="";
	$student_id = "";
	$captchaErr="";
	include_once $_SERVER['DOCUMENT_ROOT'] . '/CATest/securimage/securimage.php';
	$securimage = new Securimage();

	if($_POST){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$student_id = $_POST['student_id'];
	
		if(empty($username)|| strlen($username) < 4){
			$usernameErr = "- Please enter a valid Username (More than 3 characters)";
		}
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{6,10}$/', $password)){
			$passwordErr = "- Please enter a correct password (combination of characters and digits between 6 and 10 max)";
		}
		if(empty($student_id) || strlen($student_id) != 7){
			$student_idErr = "- Must be 7 digits";
		}
		if($securimage->check($_POST['captcha_code']) == false) {
			$captchaErr="The security code entered was incorrect, please try again.";
		}

		if(empty($usernameErr)&&empty($passwordErr)&&empty($student_idErr)&&empty($captchaErr)){
			try {
				include('db.php');
				$checkUserName = $DBH->prepare("select * from users where username = ?" );
				$checkUserName->bindParam(1, $username);
				$checkUserName->execute();
				$checkUserNum = $DBH->prepare("select * from users where student_id = ?" );
				$checkUserNum->bindParam(1, $student_id);
				$checkUserNum->execute();

				if ($checkUserName->rowCount() == 0 && $checkUserNum->rowCount() == 0) {

					$phash = password_hash($password, PASSWORD_BCRYPT);
					$sql = "INSERT INTO users (username, password, student_id) VALUES (?, ?, ?);";
					$sth = $DBH->prepare($sql);
					
					$sth->bindParam(1, $username);
					$sth->bindParam(2, $phash);
					$sth->bindParam(3, $student_id);

					$sth->execute();
					$_SESSION["username"] = $username;
					$_SESSION["student_id"] = $student_id;
					$_SESSION["type"] = 'Student';
					header('Location: confirm.php');
					exit();
				}else{
					$student_idErr = '- Username or Student Number may already exist.';
				}
			}catch(PDOException $e) {echo 'Error' . $e;}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css"/>
	<title>CCT Library - Registration</title>
</head>
<body>

<div class="left-div"></div>
<div class="mid-div">
	<div style="text-align: center;" ><img src="img/logo.png"></div>

	<form class="form-style" action="register.php" method="post">

		Username:		<input type="text" name="username" value="<?php echo $username;?>" autocomplete="off" maxlength="10" required />
						<span class="error"><?php echo $usernameErr;?></span><br>
		Password: 		<input type="password" name="password" required />
						<span class="error"><?php echo $passwordErr;?></span><br>
		Student Number: <input type="text" name="student_id" value="<?php echo $student_id;?>" autocomplete="off" maxlength="7" required />
						<span class="error"><?php echo $student_idErr;?></span><br>
						<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
						<a href="#" onclick="document.getElementById('captcha').src ='/CATest/securimage/securimage_show.php?' + Math.random();return false">
							<img height="32" width="32" src="img/refresh.png" onclick="this.blur()" /><br>
						</a>
		Enter Captcha:	<input type="text" name="captcha_code" maxlength="6" autocomplete="off" required />
						<span class="error"><?php echo $captchaErr;?></span><br>
		<input class="button" type="submit" name='submit' value= 'Submit'>
		<a class="button" href="welcome.php">Cancel</a>

	</form>

</div>
<div class="right-div"></div>
<br style="clear: left;">

</body>

</html>