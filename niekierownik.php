<?php
	session_start();
?>
<html>
<head><title> Pracownik </title>
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
<h1 style='text-align: center'>Witaj pracowniku!</h1>
