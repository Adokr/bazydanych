<?php
	session_start();
	unset($_SESSION["wiadomosc"]);
	
	$today=new DateTime("today");
	$nazwa=$_POST["nazwaPracy"];
	$termin=new DateTime($_POST["terminUkończenia"]);
	$nazwaobszaru=$_POST["nazwaObszaru"];
	if(strlen($nazwa)> 30 or strlen($nazwa) == 0){
		$wiadomosc = "Nieprawidłowa nazwa pracy" . "<br />";
	}
	if($termin <= $today){
		$wiadomosc.="Nieprawidlowy termin ukonczenia pracy" . "<br />";
		}
	if(!isset($wiadomosc)){
		$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123");
		$czyobsz= pg_fetch_row(pg_query($dbconn, "select nazwa from obszary where nazwa= '".$nazwaobszaru."'"))[0];
		if($czyobsz != $nazwaobszaru){
			$wiadomosc.="Nie istnieje obszar o podanej nazwie" . "<br />";
		}
		if(!isset($wiadomosc)){
			$termin1=$termin->format("d/m/Y");
			$idobszaru=pg_fetch_row(pg_query($dbconn, "select id from obszary where nazwa= '".$nazwaobszaru."'"))[0];
			$query="INSERT INTO prace(nazwa, termin_ukończenia, obszary_id) VALUES($1, $2, $3)";
			
			pg_prepare($dbconn, "prepare0", $query) 
				or die ("Cannot prepare statement 0\n"); 
				
			pg_execute($dbconn, "prepare0", array($nazwa, $termin1, $idobszaru))
				or die ("Cannot execute statement 0\n");  
			
			$wiadomosc="Udało się wprowadzić nową pracę do bazy";
		}
	}
$_SESSION["wiadomosc"] = $wiadomosc;
header('Location: kierownik.php');
exit;
?>
