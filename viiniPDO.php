<?php
require_once ("viini.php");

class viiniPDO{
	private static $virhelista = array (
			- 1 => "Virheellinen tieto",
			0 => "",
			1 => "Yhteys ei onnistu",
			6 => "Kaikkien haku ei onnistunut",
			7 => "Lisäys ei onnistunut",
			8 => "Haku ei onnistunut",
			9 => "Poisto ei onnistunut" 
	);
	
	private $connection;
	private $lkm;
	
	function __construct($dsn = "mysql:host=localhost;dbname=a1402802", $user = "a1402802", $password = "zoXAFh26p") {
		// Ota yhteys kantaan
		if (! $this->connection = new PDO ( $dsn, $user, $password ))
			throw new Exception ( $virhelista [1], 1 );
			
			// Virheiden jäljitys kehitysaikana
		$this->connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		
		// Tulosrivien määrä
		$this->lkm = 0;
	}
	
	function getLkm() {
		return $this->lkm;
	}
	
	public function kaikkiViinit() {
		$sql = "SELECT id, nimi, vuosi, tyyppi, maa, rypale, hinta, arvio, arvostelu FROM Viinit ORDER BY tyyppi";
		
		// Valmistellaan lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [6], 6 );
			
			// Laita parametrit (ei tässä)
			
		// Aja lauseke
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [6], 6 );
			
			// Käsittele hakulausekkeen tulos
		$tulos = array ();
		while ( $row = $stmt->fetchObject () ) {
			$hen = new Viini ();
			$hen->setId ( $row->id );
			$hen->setNimi ( utf8_encode ( $row->nimi ) );
			$hen->setVuosi ( $row->vuosi );
			$hen->setTyyppi ( utf8_encode ( $row->tyyppi ) );
			$hen->setMaa ( utf8_encode ( $row->maa ) );
			$hen->setRypale ( utf8_encode ( $row->rypale ) );
			$hen->setHinta ( $row->hinta );
			$hen->setArvio ( $row->arvio );
			$hen->setArvostelu ( utf8_encode ( $row->arvostelu ) );
			
//			$fp = fopen("/tmp/tiina.txt", "a");
//			fwrite($fp, "TIINA" . $row->arvio);
//			fclose($fp);
			
			$tulos [] = $hen;
		}
		
		$this->lkm = $stmt->rowCount ();
		
		return $tulos;
	}
	
	
	public function haeViini($id) {
		$sql = "SELECT * FROM Viinit WHERE id = :id";
	
		// Valmistellaan lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [8], 8 );
			
		// Laita parametrit
		$stmt->bindValue ( ":id", $id );
	
		// Aja lauseke
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [8], 8 );
			
		// Käsittele hakulausekkeen tulos
		$row = $stmt->fetchObject ();
		if ($stmt->rowCount() == 1) {
			$hen = new Viini ();
			$hen->setId ( $row->id );
			$hen->setNimi ( utf8_encode ( $row->nimi ) );
			$hen->setVuosi ( $row->vuosi );
			$hen->setTyyppi ( utf8_encode ( $row->tyyppi ) );
			$hen->setMaa ( utf8_encode ( $row->maa ) );
			$hen->setRypale ( utf8_encode ( $row->rypale ) );
			$hen->setHinta ( $row->hinta );
			$hen->setArvio ( $row->arvio );
			$hen->setArvostelu ( utf8_encode ( $row->arvostelu ) );
		} else {
			$hen = null;
		}
	
		$this->lkm = $stmt->rowCount ();
	
		return $hen;
	}
	
	
	function lisaaViini($hen) {
		$sql = "insert into Viinit (nimi, vuosi, tyyppi, maa, rypale, hinta, arvio, arvostelu) " . "values (:nimi, :vuosi, :tyyppi, :maa, :rypale, :hinta, :arvio, :arvostelu)";
		
		// Valmistellaan SQL-lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [7], 7 );
			
			// Parametrien sidonta
		$stmt->bindValue ( ":nimi", utf8_decode ( $hen->getNimi() ) );
		$stmt->bindValue ( ":vuosi", $hen->getVuosi() );
		$stmt->bindValue ( ":tyyppi", utf8_decode ( $hen->getTyyppi() ) );
		$stmt->bindValue ( ":maa", utf8_decode ( $hen->getMaa() ) );
		$stmt->bindValue ( ":rypale", utf8_decode ( $hen->getRypale() ) );
		$stmt->bindValue ( ":hinta", $hen->getHinta() );
		$stmt->bindValue ( ":arvio", $hen->getArvio() );
		$stmt->bindValue ( ":arvostelu", utf8_decode ( $hen->getArvostelu() ) );		
		
		// Suoritetaan SQL-lause (insert)
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [7], 7 );
		
		$this->lkm = $stmt->rowCount ();
		
		return $this->connection->lastInsertId ();
	}
	
	public function poistaViini($id) {
		$sql = "DELETE FROM Viinit WHERE id=:id";
		
		// Valmistellaan lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [9], 9 );
			
			// Laita parametrit
		$stmt->bindValue ( ":id", $id );
		
		// Aja lauseke
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [9], 9 );
			
			// Suoritetaan SQL-lause
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [9], 9 );
		
		$this->lkm = $stmt->rowCount ();
	}
	
	
		
	public function haeViinitNimella($nimi) {
		$sql = "SELECT id, nimi, vuosi, tyyppi, maa, rypale, hinta, arvio, arvostelu FROM Viinit WHERE nimi like :nimi";
		
		// Valmistellaan lause
		if (! $stmt = $this->connection->prepare ( $sql ))
			throw new Exception ( $virhelista [8], 8 );
			
			// Laita parametrit
		$ni = "%" . utf8_decode ( $nimi ) . "%";
		$stmt->bindValue ( ":nimi", $ni );
		
		// Aja lauseke
		if (! $stmt->execute ())
			throw new Exception ( $virhelista [8], 8 );
			
			// Käsittele hakulausekkeen tulos
		$tulos = array ();
		while ( $row = $stmt->fetchObject () ) {
			$hen = new Viini ();
			
			$hen->setId ( $row->id );
			$hen->setNimi ( utf8_encode ( $row->nimi ) );
			$hen->setVuosi ( $row->vuosi );
			$hen->setTyyppi ( utf8_encode ( $row->tyyppi ) );
			$hen->setMaa ( utf8_encode ( $row->maa ) );
			$hen->setRypale( utf8_encode ( $row->rypale ) );
			$hen->setHinta ( $row->hinta );
			$hen->setArvio ( $row->arvio );
			$hen->setArvostelu( utf8_encode ( $row->arvostelu ) );
			
			$tulos [] = $hen;
		}
		
		$this->lkm = $stmt->rowCount ();
		
		return $tulos;
	}
	
}
	
?>