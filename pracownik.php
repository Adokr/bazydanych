<?php
session_start();
unset($_SESSION["wiadomosc"]);

$imię = $_POST["imię"];
$nazwisko = $_POST["nazwisko"];
$nazwaspecjalności = explode(" ", $_POST["specjalność"]);
$hasło = $_POST["hasło"];
$czykierownik = $_POST["czyKierownik"];
if (strlen($imię) > 20 or strlen($imię) == 0){
	$wiadomosc = "Niepoprawna długość imienia" . "<br />";
}
if (strlen($nazwisko) > 30 or strlen($nazwisko) == 0) {
	$wiadomosc .= "Niepoprawna długość nazwiska" . "<br />";
}
if (strlen(sha1($hasło)) > 50 or strlen($hasło) < 8) {
	$wiadomosc .= "Wybierz inne hasło (co najmniej 8 znaków)" . "<br />";
}
if ($czykierownik != 'f' & $czykierownik != 't') {
	$wiadomosc .= "Złe dane w polu: czy Kierownik";
}
if(!isset($wiadomosc)){
	$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123")
				or die("Could not connect to server\n");
	$czyspec= True;
	for ($i = 0; $i < count($nazwaspecjalności); $i++) {
		$tmp = pg_fetch_row(pg_query($dbconn, "select nazwa from specjalnosci where nazwa= '".$nazwaspecjalności[$i]."'"))[0];
		if($tmp != $nazwaspecjalności[$i]){
			$czyspec = False;
			break;
			}
	}
	if($czyspec){
		$query0 = "INSERT INTO pracownicy(imie, nazwisko, password, czykierownik) VALUES ($1, $2, $3, $4)";	
		pg_prepare($dbconn, "prepare0", $query0) 
			or die ("Cannot prepare statement -1\n"); 

		pg_execute($dbconn, "prepare0", array($imię, $nazwisko, sha1($hasło), $czykierownik))
			or die("Cannot execute statement -1\n");
									
		$query1 = "INSERT INTO specjalnoscipracownikow VALUES($1, $2)"; 
		$pracownik_id = pg_fetch_row(pg_query($dbconn, "SELECT(SELECT id FROM pracownicy WHERE id=(SELECT max(id) FROM pracownicy))"))[0];
		for ($i = 0; $i < count($nazwaspecjalności); $i++) {
			$specjalność_id = pg_fetch_row(pg_query($dbconn, "SELECT id FROM specjalnosci WHERE nazwa = '". $nazwaspecjalności[$i] ."'"))[0];
			pg_prepare($dbconn, "prepare'". $i ."'", $query1) 
				or die ("Cannot prepare statement '".$i."'\n"); 

			pg_execute($dbconn, "prepare'".$i."'", array($specjalność_id, $pracownik_id))
				or die("Cannot execute statement '".$i."'\n");
		}
		
		pg_close($dbconn);
		$wiadomosc = "Udało się wprowadzić pracownika do bazy danych";	
	}else{
		$wiadomosc="Nie istnieje specjalność o podanej nazwie";
		}
	
}
$_SESSION["wiadomosc"] = $wiadomosc;
header('Location: kierownik.php');
exit;
?>
