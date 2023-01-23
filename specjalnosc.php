<?php
session_start();
unset($_SESSION["wiadomosc"]);

$nazwaspecjalności = $_POST["nazwaSpecjalności"];
if(strlen($nazwaspecjalności) < 21){
	$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123");

	$wynik = pg_query($dbconn, "insert into Specjalnosci Values (default, '".pg_escape_string($nazwaspecjalności) ."')");

	if ($wynik) {
		$wiadomosc = "Udało się wprowadzić specjalizację do bazy danych";
	} else{
		$wiadomosc = "nie udało się";
		}
} else{
	$wiadomosc = "nazwa specjalności jest za długa";
	}
$_SESSION["wiadomosc"] = $wiadomosc;
header('Location: kierownik.php');
exit;

?>
