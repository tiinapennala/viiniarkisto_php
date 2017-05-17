<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Muista viini</title>
<meta name="keywords" content="Viinit" />
<meta name="author" content="Tiina Pennala">
<link rel="stylesheet" type="text/css" href="arvostele_viinit.css">


<script type="text/javascript">

function haeViini() {
var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange=function() {

    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        // PHP-sivulta tulleen vastauksen käsittelee listaaViinit-funktio
        // xmlhttp.responseText sisältää PHP-sivulta saadun JSON-tekstin
       listaaViinit(xmlhttp.responseText);
    }
}

// Pyydetään PHP-sivua
var nimi = document.viini.nimi.value;
xmlhttp.open("GET", "viinitJSON.php?nimi=" + nimi, true);
xmlhttp.send();
}

function listaaViinit(response) {
	// Muunnetaan JSON-teksti vastaavaksi Javascript-rakenteeksi
	// Tässä tilanteessa muunnoksen tulos on taulukko, koska PHP-sivu
	// lähetti taulukkoa vastaavan rakenteen
    var vastaus = JSON.parse(response);
    var i;
    var teksti = "";

    // Käsitellään taulukko
    for(i = 0; i < vastaus.length; i++) {
        teksti = teksti + "<p>" + "Nimi: " + vastaus[i].nimi + " " + vastaus[i].vuosi + ", " + vastaus[i].tyyppi + 
		"<br> Arvio: " + vastaus[i].arvio + 
		"<br> Hinta: " + vastaus[i].hinta +  " € " + vastaus[i].maa +
        "<br>" + vastaus[i].rypale + " "+ vastaus[i].arvostelu +
        "</p>";
    }

    // Laitetaan taulukon käsittelyn tuloksena tullut teksti HTML-elementtiin
    document.getElementById("lista").innerHTML = teksti;
}
</script>

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
		<h2>HAE VIINI (JSON) </h2><hr>
		<br>
		<form name="viini" action="haeViiniJSON.php" method="post">
			<label>Nimi: </label> <input type="text" name="nimi"> <input
				type="button" value="Hae" onclick="haeViini()">
		</form>
		<div id="lista"></div>
<?php

?>	
		
	</article>
	
</body>
</html>
