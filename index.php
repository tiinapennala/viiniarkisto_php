<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Muista viini</title>
<meta name="keywords" content="Viinit" />
<meta name="author" content="Tiina Pennala">
<link rel="stylesheet" type="text/css" href="arvostele_viinit.css">
<meta name="kuvat/kuva4.JPG" content="width=device-width, initial-scale=1">

<script type="text/javascript">

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange=function() {

    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
 
       var vastaus = JSON.parse(xmlhttp.responseText);
       var lampo = vastaus.data.current_condition[0].temp_C;
       var teksti = vastaus.data.current_condition[0].lang_fi[0].value;
       
       document.getElementById("saa").innerHTML = "Helsinki " + lampo + "&#176;" + "<br>" + teksti ;
    }
}

xmlhttp.open("GET", "http://api.worldweatheronline.com/free/v2/weather.ashx?q=Helsinki&format=json&num_of_days=1&lang=fi&key=33d7b9535ad0934c1163b4701b43f", true);
xmlhttp.send();

</script>

</head>

<body class="index">
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
		<p style="float: right; font-size: 80%; text-align: center; padding-right: 50px;" id="saa"></p>
	<div class="index">

		<h2>VIINI-ARKISTO</h2><hr>
		<br>
		<p>
		<?php
		if (isset ( $_COOKIE ["nimi"] )) {
		print ("Tervetuloa " . $_COOKIE ["nimi"]."!") ;
		}
		?>
		</p>
		<p>Laita maistelusi muistiin viini-arkistoon.</p>
		<br>
	</div>

	
</body>
</html>
