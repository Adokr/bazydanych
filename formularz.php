<?php
	session_destroy();
	session_start();
?>


<!DOCTYPE html>

<html>
<head>
<title>Strona logowania</title>
<style>
body {font-family: Arial, Helvetica, sans-serif;background-image: url("garden.jpg"); background-repeat: no-repeat;}
form {margin-left: 40%; margin-right:40%; margin-top: 100px; background-color: rgb(0, 222, 178, 0.95); height: 520px; border-radius: 15px;}

input[type=text], input[type=password] {
  width: 94%;
  padding: 3% 1px;
  margin: 10px 10px;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 5px;
}
label[type=text], label[type=password]{
	margin: 0px 10px;
	font-size: 20px;
	}

button {
  background-color: #CE18BC;
  color: white;
  padding: 14px 20px;
  margin: 8px 10px;
  border: none;
  cursor: pointer;
  width: 94%;
  font-size: 20px;
  border-radius: 5px;
}
.imgcontainer {
  text-align: center;
  padding: 10px 0px 0px;
}
img.avatar {
  width: 40%;
  border-radius: 50%;
  padding: 0% 0%;
}

</style>
</head>
	
	<body>
	
	<form action="check.php" method="post">
		<div class="imgcontainer">
			<img src="avatar.png" alt="Avatar" class="avatar">
		</div>
		<div class="container">
			
			<h2 align="center" size="large">Logowanie</h2>
			<hr style="height: 3px; border-width: 0; background-color: black;">
			<?php
			if(isset($_SESSION["error"])){
				$error = $_SESSION["error"];
				echo "<p style = 'color: red; font-size: 20px; text-align: center; margin-top: 0px; margin-bottom: 0px'><b>$error</b></p>";
			}
		?>
			<label for="ID" type="text"><b>ID</b></label><br>
			<input type="text" name="username"><br>
			<label for="password" type="password"><b>Hasło</b></label><br>
			<input type="password" name="password"><br>
		</div>
		<button type="submit" value="zaloguj" name="zaloguj"><b>Zaloguj</b></button>
		
	
	</form>
	</body>
</html>

<?php
	unset($_SESSION["error"]);
?>
