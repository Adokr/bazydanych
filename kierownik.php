<?php
	session_start();
?>
<html>
<head><title> Kierownik </title>
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.nav {
  overflow: hidden;
  background-color: #333;
}

.nav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  width: 25%;
  padding: 14px 0px;
  text-decoration: none;
  font-size: 25px;
}

.nav a:hover {
  background-color: #ddd;
  color: black;
}

.nav a.active {
  background-color: #04AA6D;
  color: white;
}

.tab {
	display: none;
	}
.lokal {
	display: none;
	}
.obszar {
	display: none;
	}
.pracownik {
	display: none;
	}
.specjalność {
	display: none;
	}
.praca {
	display: none;
	}
.zadanie {
	display: none;
	}	
.anybutton {
       top:30%;
       width:250px;
       height:50px;
       position: absolute;
       color: white;
       font-size: 15px;
       background: #333; 
       }
.anybutton:hover {
  background-color: #04AA6D;
  color: white;
}

</style>
</head>
<body>
<h1 style='text-align: center'>Witaj kierowniku!</h1>

<div class="nav">
	<a href="#wprowadzanie" onclick="SetActiveDiv(this);">Wprowadź nowy obiekt</a>
  <a href="#obsada" onclick="SetActiveDiv(this);">Ustal obsadę pracy</a>
  <a href="#termin" onclick="SetActiveDiv(this);">Zmień termin wykonania zadania</a>
  <a href="#przegladaj" onclick="SetActiveDiv(this);">Przeglądaj bazę danych</a>
			
</div>
<?php
			if(isset($_SESSION["wiadomosc"])){
				$wiadomosc = $_SESSION["wiadomosc"];
				echo "<p id='msg' style = 'color: green; font-size: 20px; text-align: center; top: 22%; left: 35%; position: absolute;'><b>$wiadomosc</b></p>";
			}
			?>
<script>
window.onload = function () {
            setTimeout(appeardiv,4000);
        }
        function appeardiv() {
            document.getElementById('msg').style.display= "none";
        }

function SetActiveDiv(e){
  var elems = document.querySelectorAll(".active");
  [].forEach.call(elems, function(el) {
    el.classList.remove("active");
  });
  e.classList.add("active");
  if (e.getAttribute('href') == "#wprowadzanie"){
		if (e.classList.contains("active")){
			var tabz = document.getElementById("aha").querySelectorAll(".anybutton");
			[].forEach.call(tabz, function(y) {
				y.classList.remove('tab');
			});
		}
	}
	document.getElementById("Wprowadź nową lokalizację").classList.add("lokal");
	document.getElementById("Wprowadź nowy obszar").classList.add("obszar");
	document.getElementById("Wprowadź nowego pracownika").classList.add("pracownik");
	document.getElementById("Wprowadź nową specjalność").classList.add("specjalność");
	document.getElementById("Wprowadź nową pracę").classList.add("praca");
	document.getElementById("Wprowadź nowe zadanie").classList.add("zadanie");
  showhide(e);
}
function showhide(x) {
    var div = document.getElementById(x.getAttribute("href"));
    var tabz = document.getElementById("aha").querySelectorAll(".lol");
    [].forEach.call(tabz, function(y) {
		y.classList.add('tab');
	});
    if (div.classList.contains('tab')){
		div.classList.remove('tab');
	}
}
function kliknij(x){
	var div = document.getElementById(x.getAttribute("value"));
	div.classList.remove('lokal');
	div.classList.remove('obszar');
	div.classList.remove('pracownik');
	div.classList.remove('specjalność');
	div.classList.remove('praca');
	div.classList.remove('zadanie');
	var tabz = document.getElementById("aha").querySelectorAll(".anybutton");
    [].forEach.call(tabz, function(y) {
		y.classList.toggle('tab');
	});
}
</script>
<div id="aha">
	<div id="#wprowadzanie" class="tab lol">
		
		<input id="lokal" class="anybutton" type="button" value="Wprowadź nową lokalizację" style="left:5%;" onclick="kliknij(this);"></input>
		<input id="obszar" class="anybutton" type="button" value="Wprowadź nowy obszar" style="left:40%;" onclick="kliknij(this);"></input>
		<input id="pracownik" class="anybutton" type="button" value="Wprowadź nowego pracownika" style="left:75%;" onclick="kliknij(this);"></input>
		<input id="specjalność" class="anybutton" type="button" value="Wprowadź nową specjalność" style="left:5%; top: 45%" onclick="kliknij(this);"></input>
		<input id="praca" class="anybutton" type="button" value="Wprowadź nową pracę" style="left: 40%; top: 45%" onclick="kliknij(this);"></input>
		<input id="zadanie" class="anybutton" type="button" value="Wprowadź nowe zadanie" style="left: 75%; top: 45%" onclick="kliknij(this);"></input>
		
		<div id="Wprowadź nową lokalizację" class="lokal">
			<FORM action="lokalizacje.php" method=POST>
				<p>Wpisz dane lokalizacji, którą chcesz wprowadzić do bazy danych</p>
				<p>Nazwa lokalizacji: <input type=text name= "nazwaLokalizacji"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nowy obszar" class="obszar">
			<FORM action="obszar.php" method=POST>
				<p>Wpisz dane obszaru, który chcesz wprowadzić do bazy danych</p>
				<p>Nazwa obszaru: <input type=text name= "nazwaObszaru"><br>
				<p>Podaj nazwę lokalizacji, w której skład ma wchodzić obszar: <input type=text name= "nazwaLokalizacji"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nowego pracownika" class="pracownik">
			<FORM action="pracownik.php" method=POST>
				<p>Wpisz dane pracownika, którego chcesz wprowadzić do bazy danych</p>
				<p>Imię: <input type=text name= "imię"><br>
				<p>Nazwisko: <input type=text name= "nazwisko"><br>
				<p>Nazwy specjalności (oddzielone spacjami): <input type=text name= "specjalność"><br>
				<p>Hasło (co najmniej 8 znaków): <input type=password name= "hasło"><br>
				<p>Czy dać uprawnienia kierownika (f/t): <input type=text name= "czyKierownik"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nową specjalność" class="specjalność">
			<FORM action="specjalnosc.php" method=POST>
				<p>Wpisz dane specjalności, którą chcesz wprowadzić do bazy danych</p>
				<p>Nazwa specjalności: <input type=text name= "nazwaSpecjalności"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nową pracę" class="praca">
			<FORM action="prace.php" method=POST>
				<p>Wpisz dane pracy, którą chcesz wprowadzić do bazy danych</p>
				<p>Nazwa pracy: <input type=text name= "nazwaPracy"><br>
				<p>Termin ukończenia: <input type=date name= "terminUkończenia"><br>
				<p>Nazwa obszaru, którego dotyczy praca: <input type=text name= "nazwaObszaru"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nowe zadanie" class="zadanie">
			<FORM action="zadanie.php" method=POST>
				<p>Wpisz dane zadania, które chcesz wprowadzić do bazy danych</p>
				<p>Nazwa: <input type=text name= "nazwaZadania"><br>
				<p>Termin zadania: <input type=date name="terminZadania"><br>
				<p>Nazwa pracy, której częścią będzie zadanie: <input type=text name="nazwaPracy"><br>
				<p>Typ zadania: <input type=text name="specjalność"></p>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
	</div>	

	<div id="#obsada" class="tab lol">
		<div id="Ustal obsadę zadania" class="obsada">
			<FORM action="obsada.php" method=POST>
				<p>Podaj dane pracy, której obsadę chcesz ustalić</p>
				<p>Nazwa oraz ID pracy (np. praca1 1): <input type=text name= "praca"><br>
				<p>Podaj dane pracowników, których chcesz przyporządkować temu zadaniu</p>
				<p>ID oraz nazwiska pracowników (np. 8 Kowalski, 9 Nowak, 1 Filipkowski): <input type=text name="pracownicy"></p>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
	</div>
	<div id="#termin" class="tab lol">
	</div>
	<div id="#przegladaj"  class="tab lol">
		<?php
		$link = pg_connect("host=localhost port=5432 dbname=ogród user=postgres password=test123");

		if (!$link) {
		  print("Connection Failed.");
		  exit;
		}
		$result = pg_query($link, "select pracownicy.id, imie, nazwisko, password, czykierownik, STRING_AGG(wow.nazwa::character varying, ', ')
								   as specjalności from pracownicy 
								   left join (select * from specjalnosci 
								   left join specjalnoscipracownikow on specjalnosci.id=specjalnoscipracownikow.specjalnosci_id) as wow                                                          on pracownicy.id=wow.pracownicy_id group by pracownicy.id order by id;
								   ");
		$numrows = pg_numrows($result);
		?>

		<h2 align="center">Pracownicy</h2>

		<table border="1" align=center>
		<tr>
		 <th>ID</th>
		 <th>Imię</th>
		 <th>Nazwisko</th>
		 <th>Hasło</th>
		 <th>Specjalności</th>
		 <th>Kierownik</th>
		</tr>
		<?php
		  for ($ri = 0; $ri < $numrows; $ri++) {
			echo "<tr>\n";
			$row = pg_fetch_array($result, $ri);
			echo " <td>" . $row["id"] . "</td>
		 <td>" . $row["imie"] . "</td>
		 <td>" . $row["nazwisko"] . "</td>
		 <td>" . $row["password"] . "</td>
		 <td>" . $row["specjalności"]. "</td>
		 <td>" . strtoupper($row["czykierownik"]) . "</td>
		</tr>
		";
		   }
		?>
		</table>
		<?php
			$result = pg_query($link, "select * from lokalizacje");
			$numrows = pg_numrows($result);
		?>
		<h2 align="center">Lokalizacje</h2>

		<table border="1" align=center>
		<tr>
		 <th>ID</th>
		 <th>Nazwa</th>
		</tr>
		<?php
		  for ($ri = 0; $ri < $numrows; $ri++) {
			echo "<tr>\n";
			$row = pg_fetch_array($result, $ri);
			echo " <td>" . $row["id"] . "</td>
		 <td>" . $row["nazwa"] . "</td>
		</tr>
		";
		   }
		?>
		</table>
		<?php
			$result = pg_query($link, "select obszary.id as id_obszar, obszary.nazwa as nazwa_obszaru,
										lokalizacje.nazwa as nazwa_lokalizacji  
										from obszary left join lokalizacje on obszary.lokalizacje_id = lokalizacje.id order by nazwa_lokalizacji;
										");
			$numrows = pg_numrows($result);
		?>
		<h2 align="center">Obszary</h2>

		<table border="1" align=center>
		<tr>
		 <th>ID obszaru</th>
		 <th>Nazwa obszaru</th>
		 <th>Nazwa lokalizacji</th>
		</tr>
		<?php
		  for ($ri = 0; $ri < $numrows; $ri++) {
			echo "<tr>\n";
			$row = pg_fetch_array($result, $ri);
			echo " <td>" . $row["id_obszar"] . "</td>
		 <td>" . $row["nazwa_obszaru"] . "</td>
		 <td>" . $row["nazwa_lokalizacji"] . "</td>
		</tr>
		";
		   }
		?>
		</table>
		<?php
			$result = pg_query($link, "select * from specjalnosci");
			$numrows = pg_numrows($result);
		?>
		<h2 align="center">Specjalności</h2>

		<table border="1" align=center>
		<tr>
		 <th>ID</th>
		 <th>Nazwa Specjalności</th>
		</tr>
		<?php
		  for ($ri = 0; $ri < $numrows; $ri++) {
			echo "<tr>\n";
			$row = pg_fetch_array($result, $ri);
			echo " <td>" . $row["id"] . "</td>
		 <td>" . $row["nazwa"] . "</td>
		</tr>
		";
		   }
		?>
		</table>
			<?php
			$result = pg_query($link, "select prace.id as id_pracy, prace.nazwa as nazwa_pracy, termin_ukończenia,
										obszary.nazwa as nazwa_obszaru
										from prace left join obszary on prace.obszary_id = obszary.id;
										");
			$numrows = pg_numrows($result);
		?>
		<h2 align="center">Prace</h2>

		<table border="1" align=center>
		<tr>
		 <th>ID</th>
		 <th>Nazwa Pracy</th>
		 <th>Termin Ukończenia</th>
		 <th>Nazwa Obszaru</th>
		</tr>
		<?php
		  for ($ri = 0; $ri < $numrows; $ri++) {
			echo "<tr>\n";
			$row = pg_fetch_array($result, $ri);
			echo " <td>" . $row["id_pracy"] . "</td>
		 <td>" . $row["nazwa_pracy"] . "</td>
		 <td>" . $row["termin_ukończenia"] . "</td>
		 <td>" . $row["nazwa_obszaru"] . "</td>
		</tr>
		";
		   }
		?>
		</table>
		<?php
			$result = pg_query($link, "select zadania.id, zadania.nazwa, zadania.termin, prace.nazwa as job_name, wow.nazwa as nazwaspec, zadania.pracownicy_id as pracownik_id
									   from zadania left join prace on prace.id=zadania.prace_id
									   left join (select * from rodzajzadania left join specjalnosci on specjalnosci_id=specjalnosci.id) as wow
									   on zadania.id=wow.zadania_id;");

			$numrows = pg_numrows($result);
		?>

		<h2 align="center">Zadania</h2>

		<table border="1" align=center>
		<tr>
		 <th>ID</th>
		 <th>Nazwa</th>
		 <th>Termin</th>
		 <th>Praca</th>
		 <th>Specjalność</th>
		 <th>Pracownicy</th>
		</tr>
		<?php
		  for ($ri = 0; $ri < $numrows; $ri++) {
			echo "<tr>\n";
			$row = pg_fetch_array($result, $ri);
			echo " <td>" . $row["id"] . "</td>
		 <td>" . $row["nazwa"] . "</td>
		 <td>" . $row["termin"] . "</td>
		 <td>" . $row["job_name"] . "</td>
		 <td>" . $row["nazwaspec"]. "</td>
		 <td>" . $row["pracownik_id"]. "</td>
		</tr>
		";
		   }
		   pg_close($link)
		?>
		</table>
	</div>
</div>
</body>
</html>
<?php
	unset($_SESSION["wiadomosc"]);
?>

