<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

require_once "viini.php";

session_start();

if (isset($_SESSION["viini"])) {
	$viini = $_SESSION["viini"];
}
else {
	header("location: index.php");
	exit;
}
?>

<html>
<head>
<meta charset="UTF-8">
<title>Uusi Viini</title>

<style type="text/css">
label {
	width: 8em;
	display: block;
	float: left;
}

.pun {
	color: red;
}
</style>
<meta name="author" content="Tiina Pennala">
<link rel="stylesheet" type="text/css" href="arvostele_viinit.css">
</head>

<body>
<nav>
	<h1><li>VIINI-ARKISTO</li></h1>
	<ul>
		
		<li><a href="index.php">ETUSIVU </a></li>
		<li><a href="uusiViini.php">UUSI VIINI</a></li>
		<li><a href="listaaViinit.php">LISTAA VIINIT</a></li>
		<li><a href="haeViiniJSON.php">HAE VIINI</a></li>
		<li><a href="asetukset.php">ASETUKSET</a></li>
	</ul>
	</nav>

	<article>
			<h2>VIININ TIEDOT</h2><hr>
			</br>
			<?php 
			print("<label>Nimi: </label>" . $viini->getNimi()."</br>");
			print("<label>Vuosi: </label>" . $viini->getVuosi()."</br>");
			print("<label>Tyyppi: </label>" . $viini->getTyyppi()."</br>");
			print("<label>Maa: </label>" . $viini->getMaa()."</br>");
			print("<label>Rypäle: </label>" . $viini->getRypale()."</br>");
			print("<label>Hinta €: </label>" . $viini->getHinta()."</br>");
			print("<label>Arvio (1-5): </label>" . $viini->getArvio()."</br>");
			print("<label>Arvostelu: </label>" . $viini->getArvostelu() . "</br></br></br>");	
			?>
		<form action="uusiViini.php" method="post">
			<label>&nbsp;</label> 
		<input type="submit" name="korjaa" value="Korjaa"> 
		<input type="submit" name="talleta" value="Tallenna"> 
		<input type="submit" name="peruuta"	value="Peruuta">
	</article>
	

<body>
</html>