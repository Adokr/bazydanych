<?php
session_start();
unset($_SESSION["wiadomosc"]);

$imię = $_POST["imię"];
$nazwisko = $_POST["nazwisko"];
$specjalność = $_POST["specjalność"];
$hasło = $_POST["hasło"];
$czykierownik = $_POST["czyKierownik"];
if (strlen($imię) > 20 or strlen($imię) == 0){
	$wiadomosc = "niepoprawna długość imienia" . "<br />";
}
if (strlen($nazwisko) > 30 or strlen($nazwisko) == 0) {
	$wiadomosc .= "niepoprawna długość nazwiska" . "<br />";
}
if (strlen(sha1($hasło)) > 50 or strlen($hasło) < 8) {
	$wiadomosc .= "wybierz inne hasło (co najmniej 8 znaków)" . "<br />";
}
if ($czykierownik != 'f' & $czykierownik != 't') {
	$wiadomosc .= "złe dane w polu: czy Kierownik";
}
if(!isset($wiadomosc)){
	$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123");
	$id = pg_fetch_row(pg_query($dbconn, "select(SELECT id FROM pracownicy WHERE id=(SELECT max(id) FROM pracownicy))+1"))[0];
	$czyspec = pg_fetch_row(pg_query($dbconn, "select id from specjalnosci where id= '".$specjalność."'"))[0];
	if($czyspec == $specjalność){
		$wynik = pg_query($dbconn, "insert into Pracownicy Values (default, '".pg_escape_string($imię) .
																			"', '". pg_escape_string($nazwisko) .
																			"', '". sha1($hasło).
																			"','". $czykierownik .
																			"')");
																			
		$query = "INSERT INTO specjalnoscipracownikow VALUES($1, $2)"; 

		pg_prepare($dbconn, "prepare1", $query) 
			or die ("Cannot prepare statement\n"); 

		pg_execute($dbconn, "prepare1", array($specjalność, $id));
		   
		pg_close($dbconn);
							

		if (!isset($wiadomosc)) {
		  $wiadomosc = "Udało się wprowadzić pracownika do bazy danych";	
		}
	}	else{
		$wiadomosc="Nie udało się: nie istnieje specjalność o podanym ID";
		}
	
}
$_SESSION["wiadomosc"] = $wiadomosc;
header('Location: kierownik.php');
exit;
?>
