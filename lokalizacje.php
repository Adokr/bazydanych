<?php
session_start();
unset($_SESSION["wiadomosc"]);

$nazwalokalizacji = $_POST["nazwaLokalizacji"];
if(strlen($nazwalokalizacji) < 31){
	$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123")
				or die ("Could not connect to server\n");

	$query = "insert into Lokalizacje(nazwa) Values($1)";
	pg_prepare($dbconn, "prepare1", $query)
		or die("Cannot prepare statement\n");
	pg_execute($dbconn, "prepare1", array($nazwalokalizacji))
		or die("Cannot execute statement\n");
	pg_close($dbconn);

	$wiadomosc = "Udało się wprowadzić lokalizację do bazy danych";
	
} else{
	$wiadomosc = "Nazwa lokalizacji jest za długa";
	}
$_SESSION["wiadomosc"] = $wiadomosc;
	header('Location: kierownik.php');
	exit;
?>
