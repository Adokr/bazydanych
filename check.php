<?php 

	session_start();

	$error = "incorrect data";

	$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123");
		
	$username = pg_escape_string($_POST['username']);
	$password = sha1($_POST['password']);
		
	$query = pg_query($dbconn, "SELECT * FROM pracownicy WHERE (select rtrim(ltrim(concat(imie, ' ', nazwisko))))='".pg_escape_string($username)."' AND password='".pg_escape_string($password)."'");
	$res = pg_num_rows($query);
	$row = pg_fetch_row($query);
		
	if($res == 1) {
		$_SESSION['dbconn'] = $dbconn;
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['kierownik'] = $row[4];
		$_SESSION['userobj'] = pg_fetch_assoc($query);
			
		if($row[4]){
			header('Location: kierownik.php');
			exit;
		} else {
			header('Location: niekierownik.php');
			exit;
		}
	} else {
		$_SESSION["error"] = $error;
		header("location: formularz.php");
	}
	
?>
