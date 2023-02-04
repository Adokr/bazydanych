<?php
	session_start();
	unset($_SESSION["wiadomosc"]);
	
	$today = new DateTime("today");
	$nazwa=$_POST["nazwaZadania"];
	$termin= new DateTime($_POST["terminZadania"]);
	$nazwapracy=$_POST["nazwaPracy"];
	$specjalność=$_POST["specjalność"];
	if(strlen($nazwa)> 30 or strlen($nazwa) == 0){
		$wiadomosc = "Nieprawidłowa nazwa zadania" . "<br />";
	}
	if($termin <= $today){
		$wiadomosc.="Nieprawidlowy termin wykonania zadania" . "<br />";
	} 
	if(!isset($wiadomosc)){
		$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123");
		$terminPracy = new DateTime(pg_fetch_row(pg_query($dbconn, "SELECT termin_ukończenia FROM prace WHERE nazwa='". $nazwapracy ."'"))[0]);
		$czySpecjalność = pg_fetch_row(pg_query($dbconn, "SELECT nazwa FROM specjalnosci WHERE nazwa='".$specjalność."'"))[0];
		$czyPraca = pg_fetch_row(pg_query($dbconn, "SELECT nazwa FROM prace WHERE nazwa='".$nazwapracy."'"))[0];
		
		if($nazwapracy != Null){
			if($czyPraca!= $nazwapracy){
				$wiadomosc.="Nie istnieje praca o podanej nazwie" . "<br />";
			} else{
				if($terminPracy < $termin){
					$wiadomosc.="Termin wykonania zadania przekracza termin zakończenia pracy" . "<br />";
				}
			}
		} else{
			$wiadomosc.="Nie podano nazwy pracy"."<br />";
		}
		if($specjalność!=Null){
			if($czySpecjalność!= $specjalność){
					$wiadomosc.="Nie istnieje specjalność o podanej nazwie" . "<br />";
			}
		} else{
			$wiadomosc.="Nie podano nazwy specjalności" . "<br />";
		}
		if(!isset($wiadomosc)){
			$query = "INSERT INTO zadania(nazwa, termin, prace_id) VALUES($1, $2, $3)";
			$termin1 = $termin->format("d/m/Y");
			$idpracy=pg_fetch_row(pg_query($dbconn, "SELECT id FROM prace WHERE nazwa='".$nazwapracy."'"))[0];
			pg_prepare($dbconn, "prepare1", $query) 
				or die ("Cannot prepare statement 0\n"); 
			pg_execute($dbconn, "prepare1", array($nazwa, $termin1, $idpracy))
				or die ("Cannot execute statement 0\n"); 
			
			$query1="INSERT INTO rodzajzadania VALUES($1, $2)";
			
			$specjalność_id = pg_fetch_row(pg_query($dbconn, "SELECT id FROM specjalnosci WHERE nazwa='". $specjalność."'"))[0];
			$zadania_id = pg_fetch_row(pg_query($dbconn, "SELECT id FROM zadania WHERE nazwa='". $nazwa."'"))[0];
			pg_prepare($dbconn, "prepare2", $query1) 
				or die ("Cannot prepare statement 1\n"); 
				
			pg_execute($dbconn, "prepare2", array($specjalność_id, $zadania_id))
				or die ("Cannot execute statement 1\n"); 
			$wiadomosc="Udało się wprowadzić nowe zadanie do bazy danych";
		}
	}
	pg_close($dbconn);
	$_SESSION["wiadomosc"] = $wiadomosc;
	header('Location: kierownik.php');
	exit;
?>
	#$query = "Insert into rodzajeprojektow values($1, $2)";
	#		pg_prepare($dbconn, "prepare1", $query);
	#		pg_execute($dbconn, "prepare1", array($rodzaj, $projekt_id));

