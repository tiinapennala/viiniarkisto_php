<?php
session_start ();

if (isset ( $_SESSION ["viini"] )) {
	
	$_SESSION = array ();
	
	if (isset ( $_COOKIE [session_name ()] )) {
		setcookie ( session_name (), '', time () - 100, '/' );
	}
	
	session_destroy ();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Muista viini</title>
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
<?php
if (isset ( $_GET ["virhe"] ))
	print ("<p>" . stripcslashes ( $_GET ["virhe"] ) . "</p>") ;
else
	print ("<p>Tuntematon virhe</p>") ;
?>
	</article>

</body>
</html>
