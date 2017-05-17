<?php
if (isset ( $_POST ["muuta"] )) {
	setcookie ( "nimi", $_POST ["kayttaja"], time () + 60 * 60 * 24 * 7 );
	header ( "location: index.php" );
	exit ();
} else {
	if (isset ( $_COOKIE ["nimi"] )) {
		$nimi = $_COOKIE ["nimi"];
	} else {
		$nimi = "";
	}
}
?>

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

	<!-- sivun sisältö -->
	<article>
	<h2>ASETUKSET</h2><hr>
	<br>
		<form action="" method="post">
			<p>
				<label>Nimesi: </label> <input type="text" name="kayttaja" value="<?php print(htmlentities($nimi, ENT_QUOTES, "UTF-8"));?>"> 
				<input type="submit" name="muuta" value="Muuta nimeä">
			</p>
		</form>

	</article>


	
</body>
</html>
