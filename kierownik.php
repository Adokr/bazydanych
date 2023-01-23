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
.projekt {
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
            setTimeout(appeardiv,3500);
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
	document.getElementById("Wprowadź nowy projekt").classList.add("projekt");
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
	div.classList.remove('projekt');
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
		<input id="projekt" class="anybutton" type="button" value="Wprowadź nowy projekt" style="left: 40%; top: 45%" onclick="kliknij(this);"></input>
		<input id="zadanie" class="anybutton" type="button" value="Wprowadź nowe zadanie" style="left: 75%; top: 45%" onclick="kliknij(this);"></input>
		
		<div id="Wprowadź nową lokalizację" class="lokal">
			<FORM action="lokalizacje.php" method=POST>
				<p>Wpisz dane lokalizacji, którą chcesz wprowadzić do bazy danych</p>
				<p>Nazwa: <input type=text name= "nazwaLokalizacji"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nowy obszar" class="obszar">
			<FORM action="obszar.php" method=POST>
				<p>Wpisz dane lokalizacji którą chcesz wprowadzić do bazy danych</p>
				<p>Nazwa: <input type=text name= "nazwaObszaru"><br>
				<p>Podaj ID lokalizacji, w której skład ma wchodzić obszar: <input type=text name= "idLokalizacji"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nowego pracownika" class="pracownik">
			<FORM action="pracownik.php" method=POST>
				<p>Wpisz dane pracownika, którego chcesz wprowadzić do bazy danych</p>
				<p>Imię: <input type=text name= "imię"><br>
				<p>Nazwisko: <input type=text name= "nazwisko"><br>
				<p>Specjalność: <input type=text name= "specjalność"><br>
				<p>Hasło (co najmniej 8 znaków): <input type=password name= "hasło"><br>
				<p>Czy dać uprawnienia kierownika (f/t): <input type=text name= "czyKierownik"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nową specjalność" class="specjalność">
			<FORM action="specjalnosc.php" method=POST>
				<p>Wpisz dane specjalności, którą chcesz wprowadzić do bazy danych</p>
				<p>Nazwa: <input type=text name= "nazwaSpecjalności"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nowy projekt" class="projekt">
			<FORM action="projekt.php" method=POST>
				<p>Wpisz dane projektu, który chcesz wprowadzić do bazy danych</p>
				<p>Nazwa: <input type=text name= "nazwaProjektu"><br>
				<p>Termin ukończenia: <input type=date name= "terminUkończenia"><br>
				<p>ID obszaru, którego dotyczy projekt: <input type=text name= "idObszaru"><br>
				<p>ID rodzaju projektu: <input type=text name="rodzajProjektu"></p>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
		<div id="Wprowadź nowe zadanie" class="zadanie">
			<FORM action="zadanie.php" method=POST>
				<p>Wpisz dane lokalizacji którą chcesz wprowadzić do bazy danych</p>
				<p>Nazwa: <input type=text name= "nazwaaa"><br>
				<button type="submit" value="gotowe" name="gotowe"><b>Gotowe</b></button>
			</FORM>
		</div>
	</div>	

	<div id="#obsada" class="tab lol">
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
		$result = pg_query($link, "select pracownicy.id, imie, nazwisko, password, wow.nazwa as spec, czykierownik from pracownicy 
									left join (select * from specjalnosci 
									left join specjalnoscipracownikow on specjalnosci.id=specjalnoscipracownikow.specjalnosci_id) as wow  
									on pracownicy.id=wow.pracownicy_id order by id;");
		$numrows = pg_numrows($result);
		?>

		<h2 align="center">Pracownicy</h2>

		<table border="1" align=center>
		<tr>
		 <th>ID</th>
		 <th>Imię</th>
		 <th>Nazwisko</th>
		 <th>Hasło</th>
		 <th>Specjalność</th>
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
		 <td>" . $row["spec"]. "</td>
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
			$result = pg_query($link, "select projekty.id as id_projektu, projekty.nazwa as nazwa_projektu, termin_ukończenia,
										obszary.nazwa as nazwa_obszaru
										from projekty left join obszary on projekty.obszary_id = obszary.id;
										");
			$numrows = pg_numrows($result);
		?>
		<h2 align="center">Projekty</h2>

		<table border="1" align=center>
		<tr>
		 <th>ID</th>
		 <th>Nazwa Projektu</th>
		 <th>Termin Ukończenia</th>
		 <th>Nazwa Obszaru</th>
		</tr>
		<?php
		  for ($ri = 0; $ri < $numrows; $ri++) {
			echo "<tr>\n";
			$row = pg_fetch_array($result, $ri);
			echo " <td>" . $row["id_projektu"] . "</td>
		 <td>" . $row["nazwa_projektu"] . "</td>
		 <td>" . $row["termin_ukończenia"] . "</td>
		 <td>" . $row["nazwa_obszaru"] . "</td>
		</tr>
		";
		   }
		  pg_close($link);
		?>
		</table>
	</div>
</div>
</body>
</html>
<?php
	unset($_SESSION["wiadomosc"]);
?>

