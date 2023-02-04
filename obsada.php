<?php
	session_start();
	unset($_SESSION["wiadomosc"]);
	
	$praca = explode(" ", $_POST["praca"]);
	$nazwapracy= $praca[0];
	$idpracy = $praca[1];
	$pracownicy = explode(", ", $_POST["pracownicy"]);
	
	$dbconn = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123")
				or die("Could not connect to server\n");
	$czypraca = pg_fetch_row(pg_query($dbconn, "SELECT nazwa, id FROM prace WHERE nazwa='".$nazwapracy."' and id='". $idpracy ."'"));
	
	if($nazwapracy != Null and $idpracy != Null){
		if($czypraca[0] != $nazwapracy or $czypraca[1]!= $idpracy){
				$wiadomosc.="Nie istnieje praca o podanych parametrach" . "<br />";
		} 
	} else{
		$wiadomosc.="Nie podano nazwy pracy albo jej ID"."<br />";
	}
	
	if(!isset($wiadomosc)){
		$czypracownicy= True;
		for ($i = 0; $i < count($pracownicy); $i++) {
			$tmp1 = explode(" ", $pracownicy[$i]);
			$tmp = pg_fetch_row(pg_query($dbconn, "select id, nazwisko from pracownicy where id='".intval($tmp1[0])."' and nazwisko='". $tmp1[1]."'"));
			if($tmp[0] != $tmp1[0] or $tmp[1] != $tmp1[1]){
				$czypracownicy = False;
				break;
			}
		}
		if($czypracownicy){
			$wiadomosc="dziaLa";
		}else{
			$wiadomosc="Niepoprawne dane pracowników";
		}
	}
$_SESSION["wiadomosc"] = $wiadomosc;
header('Location: kierownik.php');
exit;
?>
