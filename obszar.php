<?php
session_start();
unset($_SESSION["wiadomosc"]);

$nazwaobszaru= pg_escape_string($_POST["nazwaObszaru"]);
$nazwalokalizacji = $_POST["nazwaLokalizacji"];
if(strlen($nazwaobszaru) < 21){
	$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123")
					or die ("Could not connect to server\n");
					
	$czylokal = pg_fetch_row(pg_query($dbconn, "select nazwa from lokalizacje where nazwa= '".$nazwalokalizacji."'"))[0];
	$idlokalizacji = pg_fetch_row(pg_query($dbconn, "select id from lokalizacje where nazwa= '". $nazwalokalizacji."'"))[0];
	if($czylokal == $nazwalokalizacji){


		$query = "INSERT INTO obszary(nazwa, lokalizacje_id) VALUES($1, $2)"; 

		pg_prepare($dbconn, "prepare1", $query)
			or die ("Cannot prepare statement\n");

		pg_execute($dbconn, "prepare1", array($nazwaobszaru, $idlokalizacji))
			or die("Cannot execute statement\n");
		pg_close($dbconn);

		$wiadomosc = "Udało się wprowadzić obszar do bazy danych";
	} else{
		$wiadomosc="Nie istnieje lokalizacja o podanej nazwie";
	}
} else {
	$wiadomosc="Podana nazwa obszaru jest za długa";
}
$_SESSION["wiadomosc"] = $wiadomosc;
header('Location: kierownik.php');
exit;
?>

