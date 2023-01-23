<?php
session_start();

$nazwalokalizacji = $_POST["nazwaLokalizacji"];
if(strlen($nazwalokalizacji) < 31){
	$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123");

	$wynik = pg_query($dbconn, "insert into Lokalizacje Values (default, '".pg_escape_string($nazwalokalizacji) ."')");

	if ($wynik) {
	  $wiadomosc = "Udało się wprowadzić lokalizację do bazy danych";
	}
	else {
	  $wiadomosc = "Nie udalo się";
	}
} else{
	$wiadomosc = "nazwa lokalizacji jest za długa";
	}
$_SESSION["wiadomosc"] = $wiadomosc;
	header('Location: kierownik.php');
	exit;
?>
