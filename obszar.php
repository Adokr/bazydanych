<?php
session_start();
unset($_SESSION["wiadomosc"]);

$nazwaobszaru= pg_escape_string($_POST["nazwaObszaru"]);
$idlokalizacji = $_POST["idLokalizacji"];
if(strlen($nazwaobszaru) < 21){
	$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123")
					or die ("Could not connect to server\n");
					
	$czylokal = pg_fetch_row(pg_query($dbconn, "select id from lokalizacje where id= '".$idlokalizacji."'"))[0];
	if($czylokal == $idlokalizacji){


		$query = "INSERT INTO obszary(nazwa, lokalizacje_id) VALUES($1, $2)"; 

		pg_prepare($dbconn, "prepare1", $query);

		pg_execute($dbconn, "prepare1", array($nazwaobszaru, $idlokalizacji));		  
		pg_close($dbconn);

		if(!isset($wiadomosc)){
			$wiadomosc = "Udało się wprowadzić obszar do bazy danych";
		}
	} else{
		$wiadomosc="Nie udało się: nie istnieje lokalizacja o podanym ID";
	}
} else {
	$wiadomosc="Podana nazwa obszaru jest za długa";
}
$_SESSION["wiadomosc"] = $wiadomosc;
header('Location: kierownik.php');
exit;
?>

