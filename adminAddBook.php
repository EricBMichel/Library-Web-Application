<?php
session_start();
if ($_SESSION["type"] != 'Admin') {
	header("Location: reconfirm.php");
}
$title = "";
$titleErr = "";
$author = "";
$authorErr = ""; 
$isbn = "";
$isbnErr = "";

if ($_POST) {
	$title = $_POST['title'];
	$author = $_POST['author'];  
	$isbn = $_POST['isbn'];

	if(empty($title)){
		$titleErr = "Enter the title of the book.";
	}
	if(empty($author)){
		$authorErr = "Enter the author of the book.";
	}
	if(!preg_match('/^[0-9]{10}$/',$isbn)){
		$isbnErr = "Must be 10 numbers.";
	}
	if(empty($titleErr)&&empty($authorErr)&&empty($isbnErr)){
		try {
			include('db.php');
			$checkISBNNum = $DBH->prepare("select * from library where isbn = ?" );
			$checkISBNNum->bindParam(1, $isbn);
			$checkISBNNum->execute();

			if($checkISBNNum->rowCount() == 0){

			$stmt = $DBH->prepare("INSERT into library (title,author,isbn) Values (:title,:author,:isbn)");
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':author', $author);
			$stmt->bindValue(':isbn', $isbn);
			$stmt->execute();
			$_SESSION["title"] = $title;
			$_SESSION["author"] = $author;
			header('Location: adminAddBookConfirm.php');
			exit();
			}else{
				$isbnErr = '- ISBN already exists.';
			}
		} catch(PDOException $e) {echo 'Error' . $e;}
		
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css"><style>.error{display: block; color: #FF0000;}</style>
	<title>CCT Library - Add Book</title>
</head>
<body>

	<div class="left-div"></div>
	<div class="mid-div">
		<div style="text-align: center;" ><img src="img/logo.png"></div>

		<?php
		include('db.php');
		include('adminHeader.php');
		?>

		<h2 style="font: 25px Lucida Sans Unicode">Add a Book to The Library!</h2>

		<form class='form-style' action="adminAddBook.php" method="post">  
			Title:		<input type="text" name="title" value="<?php echo $title; ?>" autocomplete="off" placeholder="eg. The Lord of the Rings" required/>
			<span class="error"><?php echo $titleErr;?></span><br>
			Author:		<input type="text" name="author" value="<?php echo $author; ?>" autocomplete="off" placeholder="eg. JRR Tolkien" required/>
			<span class="error"><?php echo $authorErr;?></span><br>
			ISBN:		<input type="text" name="isbn" value="<?php echo $isbn; ?>" autocomplete="off" placeholder=".eg. 1500123456" maxlength='10' required/>
			<span class="error"><?php echo $isbnErr;?></span><br>
			<input type="submit" name="submit" value="Save" class='button'/>
		</form>
	</div>

	<div class="right-div"></div>
	<br style="clear: left;">

</body>

</html>