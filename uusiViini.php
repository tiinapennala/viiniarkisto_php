<?php
require_once "viini.php";
session_start();

// talleta-nimistä painiketta painettu
if (isset ( $_POST ["laheta"] )) {
	// Luodaan olio lomakekenttien tiedoista
	$viini = new Viini ( $_POST ["nimi"], $_POST ["vuosi"], $_POST ["tyyppi"], $_POST ["maa"], $_POST ["rypale"], $_POST ["hinta"], $_POST ["arvio"], $_POST ["arvostelu"] );
	
	// Laitetaan luotu olio istuntoon, jotta muutkin sivut ja tämä sivu voi käyttää sitä
	$_SESSION["viini"] = $viini;
	session_write_close();
	
	//	print_r($ilmoitus);
	$nimiVirhe = $viini->checkNimi();
	$vuosiVirhe = $viini->checkVuosi ();
	$tyyppiVirhe = $viini->checkTyyppi();
	$maaVirhe = $viini->checkMaa ();
	$rypaleVirhe = $viini->checkRypale();
	$hintaVirhe = $viini->checkHinta();
	$arvioVirhe = $viini->checkArvio();
	$kommenttiVirhe = $viini->checkArvostelu();
	
	if ($nimiVirhe == 0 && $vuosiVirhe == 0 && $tyyppiVirhe == 0 && $maaVirhe == 0 && $rypaleVirhe == 0 && $hintaVirhe == 0 && $arvioVirhe == 0 && $kommenttiVirhe == 0) {
		header("location: naytaLisays.php");
		exit;
	}
	
}// peruuta-painiketta painettu
  elseif (isset ( $_POST ["peruuta"] )) {
	unset($_SESSION["viini"]);
	header ( "location: index.php" );
	exit ();
	
	
	
} elseif (isset ( $_POST ["talleta"] )) {
	if (isset ( $_SESSION ["viini"] )) {
		try {
			require_once "viiniPDO.php";
			
			$viiniPDO = new viiniPDO ();
			$tulos = $viiniPDO->lisaaViini ( $_SESSION ["viini"] );
		} catch ( Exception $error ) {
			// print($error->getMessage());
			header ( "location: virhe.php?virhe=" . $error->getMessage () );
			exit ();
		}
		
		$_SESSION = array ();
		
		if (isset ( $_COOKIE [session_name ()] )) {
			setcookie ( session_name (), '', time () - 100, '/' );
		}
		
		session_destroy ();
		
		header ( "Location: talletettu.php" );
		exit ();
	} else {
		header ( "location: virhe.php?virhe=Ei ollut talletettavia tietoja" );
		exit ();
	}

}  

else {
	// Sivu ladataan ekaa kertaa tai sivulle tulla toiselta sivulta ohjattuna
	
	
	if (isset ( $_SESSION ["viini"] )) {
		$viini = $_SESSION ["viini"];
		
		$nimiVirhe = $viini->checkNimi();
		$vuosiVirhe = $viini->checkVuosi ();
		$tyyppiVirhe = $viini->checkTyyppi();
		$maaVirhe = $viini->checkMaa ();
		$rypaleVirhe = $viini->checkRypale();
		$hintaVirhe = $viini->checkHinta();
		$arvioVirhe = $viini->checkArvio();
		$kommenttiVirhe = $viini->checkArvostelu();
		
	} else {
	// Tehdään leffa oletusarvoilla (tyhjä viini)
		$viini = new Viini ();
		
		// Alustetaan virhemuuttujat
		$nimiVirhe = 0;
		$vuosiVirhe = 0;
		$tyyppiVirhe= 0;
		$maaVirhe = 0;
		$rypaleVirhe= 0;
		$hintaVirhe= 0;
		$arvioVirhe= 0;
		$kommenttiVirhe= 0;
	}
				
}

?>

<!DOCTYPE html>

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
		<h2>UUSI VIINI</h2><hr>
		<form action="uusiViini.php" method="post">
		<br>
			<p>
				<label>Nimi <span style="color: #B94A48">*</span></label> <input type="text" name="nimi" size="60"
				value="<?php print(htmlentities($viini->getNimi(), ENT_QUOTES, "UTF-8"));?>">
				<?php
				print ("<span class='pun'>" . $viini->getError ( $nimiVirhe ) . "</span>") ;
				?> 
			</p>
			<p>
				<label>Vuosi</label> <input type="text" name="vuosi" size="10" maxlength="4"
				value="<?php print(htmlentities($viini->getVuosi(), ENT_QUOTES, "UTF-8"));?>">
				<?php 
				print ("<span class='pun'>" . $viini->getError ( $vuosiVirhe ) . "</span>") ;
				?>
			</p>
			</p>
			<p>
				<label>Tyyppi <span style="color: #B94A48">*</span></label> 			
				<input type="text" name="tyyppi" size="40"
				value="<?php print(htmlentities($viini->getTyyppi(), ENT_QUOTES, "UTF-8"));?>">
				
				<?php 
				print ("<span class='pun'>" . $viini->getError ( $tyyppiVirhe ) . "</span>") ;
				?>
			</p>
			<p>
				<label>Maa</label> <input type="text" name="maa" size="40"
				value="<?php print(htmlentities($viini->getMaa(), ENT_QUOTES, "UTF-8"));?>">
				<?php 
				print ("<span class='pun'>" . $viini->getError ( $maaVirhe ) . "</span>") ;
				?>
			</p>
			<p>
				<label>Rypäle</label> <input type="text" name="rypale" size="40"
				value="<?php print(htmlentities($viini->getRypale(), ENT_QUOTES, "UTF-8"));?>">
				<?php 
				print ("<span class='pun'>" . $viini->getError ( $rypaleVirhe ) . "</span>") ;
				?>
				
			</p>

			<p>
				<label>Hinta &euro;</label> <input type="text" name="hinta" size="10" maxlength="4"
				
				value="<?php print(htmlentities($viini->getHinta(), ENT_QUOTES, "UTF-8"));?>"> 
				<!-- <span class="error"> -->
				<?php 
				print ("<span class='pun'>" . $viini->getError ( $hintaVirhe ) . "</span>") ;
				?>
			<!--	</span>	 -->
			</p>
			<p>
				<label>Arvio (1-5) <span style="color: #B94A48">*</span></label> <input type="text" name="arvio" size="10" maxlength="1"
				value="<?php print(htmlentities($viini->getArvio(), ENT_QUOTES, "UTF-8"));?>">
				<?php 
				print ("<span class='pun'>" . $viini->getError ( $arvioVirhe ) . "</span>") ;
				?>
			</p>
			<p>
				<label>Arvostelu</label> 
				<textarea rows="5" cols="40" name="arvostelu"><?php print(htmlentities($viini->getArvostelu(), ENT_QUOTES, "UTF-8"));?></textarea>
				<?php
				print ("<span class='pun' style='vertical-align:top'>" . $viini->getError ( $kommenttiVirhe ) . "</span>") ;
				?>
				</p>
			</p>

			<p>
				<label>&nbsp;</label> 
				<input type="submit" name="laheta" value="Tallenna"> 
				<input type="submit" name="peruuta"	value="Peruuta">
			</p>
		</form>
	</article>


</body>
</html>