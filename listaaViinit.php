<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Muista viini</title>
<meta name="keywords" content="Viinit" />
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
		<h2>LISTAA VIINIT</h2><hr>
		<br>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

try {
	require_once "viiniPDO.php";
	
	$viiniPDO = new viiniPDO ();
	if (isset ( $_POST ["nayta"] )) {
		$viini = $viiniPDO->haeViini ( $_POST ["id"] );
		print ("<p>\n") ;
		$nimi = $viini->getNimi ();
		$vuosi = $viini->getVuosi ();
		$tyyppi = $viini->getTyyppi();
		$maa = $viini->getMaa();
		$rypale = $viini->getRypale();	
		$hinta = $viini->getHinta();		
		$arvio = $viini->getArvio();					
		$arvostelu = $viini->getArvostelu();
		print ("Nimi: $nimi $vuosi\n") ;
		print ("<br>Tyyppi: $tyyppi") ;
		print ("<br>Maa: $maa") ;
		print ("<br>Rypäle: $rypale") ;
		print ("<br>Hinta: $hinta") ;
		print ("<br>Arvio (1-5): $arvio") ;
		print ("<br>Arvostelu: $arvostelu") ;

		print ("</p>") ;
		print ("<form action='' method='post'>\n") ;
		print ("<input type='submit' name='takaisin' value='Takaisin'>\n") ;
		print ("</form>\n") ;

	} else {
		if (isset ( $_POST ["poista"] )) {
			$viiniPDO->poistaViini ( $_POST ["id"] );
		}
		
		$tulos = $viiniPDO->kaikkiViinit();
		
		print ("<table>\n") ;
		foreach ( $tulos as $viini ) {
			print ("<tr>\n") ;
			
//			print ("<td>" . $viini->getId () . "</td>\n") ;
			$nimi = $viini->getNimi ();
			$tyyppi = $viini->getTyyppi();
			$arvio = $viini->getArvio ();
			print ("<td>$nimi &nbsp</td>\n");
			print ("<td>$tyyppi &nbsp</td>\n");
			print ("<td>$arvio &nbsp</td>\n");
			print ("<td><form action='' method='post'>\n") ;
				print ("<input type='hidden' name='id' value='" . $viini->getId () . "'>\n") ;
				print ("<input type='submit' name='nayta' value='Näytä'>\n") ;
				print ("<input type='submit' name='poista' value='Poista'>\n") ;
			print ("</form></td>\n") ;
			
			print ("</tr>\n") ;
		}
		print ("</table>\n") ;
	}
} catch ( Exception $error ) {
	header ( "location: virhe.php?virhe=" . $error->getMessage () );
	exit ();
}
?>	
		
	</article>
	
</body>
</html>
