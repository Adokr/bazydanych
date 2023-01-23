<?php
	session_start();
	unset($_SESSION["wiadomosc"]);
	
	$today = date("m-d-Y");
	$nazwa=$_POST["nazwaProjektu"];
	$termin=$_POST["terminUkończenia"];
	$rodzaj=$_POST["rodzajProjektu"];
	$idobszaru=$_POST["idObszaru"];
	echo $termin;
	if(strlen($nazwa)> 30 or strlen($nazwa) == 0){
		$wiadomosc = "nieprawidłowa nazwa projektu" . "<br />";
	}
	if($termin < $today){
		$wiadomosc.="nieprawidlowy termin ukonczenia projektu" . "<br />";
		}
	if(!isset($wiadomosc)){
		$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123");
		$projekt_id = pg_fetch_row(pg_query($dbconn, "select(SELECT id FROM projekty WHERE id=(SELECT max(id) FROM projekty))+1"))[0];
		$czyrodz=pg_fetch_row(pg_query($dbconn, "select id from rodzaj where id='".$rodzaj."'"))[0];
		$czyobsz= pg_fetch_row(pg_query($dbconn, "select id from obszary where id= '".$idobszaru."'"))[0];
		if($czyobsz != $idobszaru){
			$wiadomosc.="niepoprawne ID obszaru" . "<br />";
		}	
		if($czyrodz != $rodzaj){
			$wiadomosc.="niepoprawne ID rodzaju" . "<br />";
		}
		if(!isset($wiadomosc)){
			pg_query($dbconn, "insert into projekty(nazwa, termin_ukończenia, obszary_id) values('". pg_escape_string($nazwa) .
																									"', '". $termin .
																									"', '". $idobszaru."')");
			$query = "Insert into rodzajeprojektow values($1, $2)";
			pg_prepare($dbconn, "prepare1", $query);
			pg_execute($dbconn, "prepare1", array($rodzaj, $projekt_id));
			
			$wiadomosc="Udało się wprowadzić nowy projekt do bazy";
		}
	}
$_SESSION["wiadomosc"] = $wiadomosc;
header('Location: kierownik.php');
exit;
?>
