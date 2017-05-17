<?php
try {
	require_once "viiniPDO.php";
	
	// Luodaan tietokanta-luokan olio
	$kantakasittely = new viiniPDO ();
	
	// Jos sivua pyytaneelta tuli hae eli kyseessa on nimella viini hakeminen
	if (isset ( $_GET ["nimi"] )) {
		$haettava = $_GET ["nimi"];
		
		// Tehdään kantahaku, parametrina on nimi
		$tulos = $kantakasittely->haeViinitNimella ( $haettava );
		
		// Palautetaan vastaus JSON-tekstina
		print (json_encode ( $tulos )) ;
	}  // Kyseessa on kaikkien leffojen haku kannasta
    else {
		$tulos = $kantakasittely->kaikkiViinit ();
		
		// Palautetaan vastaus JSON-tekstinä
		print json_encode ( $tulos );
	}
} catch ( Exception $error ) {
}
?>

