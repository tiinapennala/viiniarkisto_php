<?php

class Viini implements JsonSerializable {
	// Virhekoodit taulukko
	private static $virhelista = array (
			- 1 => "Virheellinen tieto",
			0 => "",
			11 => "Tieto on pakollinen",
			12 => "Tieto on liian lyhyt",
			13 => "Tieto on liian pitkä",
			14 => "Käytä vain kirjaimia, numeroita ja - ,.!?" ,
			21 => "Vuosi muodossa vvvv (numeroilla)",
			22 => "Vuosi on liian pieni, aloita vuodesta 1700",
			23 => "Vuosi ei voi olla tulevaisuudessa",
			31 => "Hinta on virheellinen",
			32 => "Hinta on liian pieni",
			33 => "Hinta on liian suuri",
			41 => "Arvio on pakollinen",
			42 => "Anna arvio 1-5"
	);
	
	// Attribuutit
	private $nimi;
	private $vuosi;
	private $tyyppi;
	private $maa;
	private $rypale;
	private $hinta;
	private $arvio;
	private $arvostelu;
	private $id; 
	
	
	public function jsonSerialize() {
        return [
            "nimi" 			=> $this->nimi,
            "vuosi" 		=> $this->vuosi,
            "tyyppi" 		=> $this->tyyppi,
			"maa" 			=> $this->maa,
			"rypale" 		=> $this->rypale,
			"hinta" 		=> $this->hinta,
			"arvio" 		=> $this->arvio,
			"arvostelu" 	=> $this->arvostelu,
	         "id" 			=> $this->id
        ];
    }
	
	
	
	// Konstruktori
	function __construct($nimi = "", $vuosi = "", $tyyppi = "", $maa = "", $rypale = "", $hinta = "", $arvio = "", $arvostelu = "", $id = 0) {
		$this->nimi = trim ( $nimi );
		$this->vuosi = trim ( $vuosi );
		$this->tyyppi = trim ( $tyyppi );
		$this->maa = trim ( $maa );
		$this->rypale = trim ( $rypale );
		$this->hinta = trim ( $hinta );
		$this->arvio = trim ( $arvio );
		$this->arvostelu = trim ( $arvostelu );
		$this->id = $id;
	}
	
	// Get ja Set metodit / funktiot
	public function setNimi($nimi) {
		$this->nimi = trim ( $nimi );
	}
	public function getNimi() {
		return $this->nimi;
	}
	
	public function checkNimi($required = true, $min = 1, $max = 60) {			
		// ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->nimi ) == 0) {
			return 11;
		}
		// Jos kenttä on liian lyhyt tai pitkä
		if (strlen ( $this->nimi ) < $min) {
			return 12;
		}	
		// Jos kenttä on liian pitkä
		if (strlen ( $this->nimi ) > $max) {
			return 13;
		}
					
		return 0;
	}
	
	
	public function setVuosi($vuosi) {
		$this->vuosi = trim ( $vuosi );
	}
	public function getVuosi() {
		return $this->vuosi;
	}
	
	public function checkVuosi($required = false, $min = 1700) {
		
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->vuosi ) == 0) {
			return 0;
		}
		if(!isset($vuosi)){
			// Onko neljällä numerolla
			if (!preg_match ( "/^\d{4}$/", $this->vuosi )) {
				return 21;
			}
			// Jos vuosi on liian pieni
			if ($this->vuosi < $min) {
				return 22;
			}
			// Jos vuosi on liian suuri
			// ei strlen, koska ei tutkita merkkijonon pituutta vaan muuttujan arvoa
			$max = date ( "Y", time () );
			if ($this->vuosi > $max) {
				return 23;
			}		
		}	
		return 0;
	}
		

	
	public function setTyyppi($tyyppi) {
		$this->tyyppi = trim ( $tyyppi );
	}
	public function getTyyppi() {
		return $this->tyyppi;
	}

	public function checkTyyppi($required = true, $min = 1, $max = 60) {			
		// ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->tyyppi ) == 0) {
			return 11;
		}
		if (strlen ( $this->tyyppi ) < $min) {
			return 12;
		}	
		if (strlen ( $this->tyyppi ) > $max) {
			return 13;
		}			
		return 0;
	}
	
	
	
	public function setMaa($maa) {
		$this->maa = trim ( $maa );
	}
	public function getMaa() {
		return $this->maa;
	}
	
	public function checkMaa($required = true, $min = 0, $max = 60) {			

		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->maa ) == 0) {
			return 0;
		}
		if (strlen ( $this->maa ) < $min) {
			return 12;
		}	
		if (strlen ( $this->maa ) > $max) {
			return 13;
		}			
		return 0;
	}
		
	
	public function setRypale($rypale) {
		$this->rypale = trim ( $rypale );
	}
	public function getRypale() {
		return $this->rypale;
	}

	public function checkRypale($required = true, $min = 0, $max = 60) {			
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->rypale ) == 0) {
			return 0;
		}
		if (strlen ( $this->rypale ) < $min) {
			return 12;
		}	
		if (strlen ( $this->rypale ) > $max) {
			return 13;
		}	
		return 0;
	}
	
		
	public function setHinta($hinta) {
		$this->hinta = trim ( $hinta );
	}
	public function getHinta() {
		return $this->hinta;
	}
	
	public function checkHinta($required = false, $min = 0.0, $max = 10000.0) {
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->hinta ) == 0) {
			return 0;
		}
		// Jos hinta ei ole tyhjä
		if(!isset($hinta)){
			// Jos hinnan muoto ei ole oikea
			if (!preg_match("/^(-)?\d+(\.\d{2})?$/", $this->hinta)) {
				return 31;
			}
			// Jos hinta on liian pieni
			if ($this->hinta < $min) {
				return 32;
			}
			// Jos hinta on liian suuri
			if ($this->hinta > $max) {
				return 33;
			}			
		}
		return 0;
	}
	

	public function setArvio($arvio) {
		$this->arvio = trim ( $arvio );
	}
	public function getArvio() {
		return $this->arvio;
	}
		
	
	public function checkArvio($required = true, $min = 1, $max = 5) {
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->arvio ) == 0) {
			return 0;
		}
		// Jos ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->arvio ) == 0) {
			return 41;
		}
		// Jos arvio on liian pieni
 		if ($this->arvio < $min) {
 			return 42;
 		}
		// Jos arvio on liian suuri
 		if ($this->arvio > $max) {
 			return 42;
 		}
		return 0;
	}
	
		
	
	public function setArvostelu($arvostelu) {
		$this->arvostelu = trim ( $arvostelu );
	}
	public function getArvostelu() {
		return $this->arvostelu;
	}
	
	public function checkArvostelu($required = true, $min = 0, $max = 300) {
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->arvostelu ) == 0) {
			return 0;
		}
			
		// Jos kommentti on liian lyhyt
		if (strlen ( $this->arvostelu ) < $min) {
			return 12;
		}
			
		// Jos kommentti on liian pitkä
		if (strlen ( $this->arvostelu ) > $max) {
			return 13;
		}
			
		// Kommentissa saa olla vain kirjaimia, numeroita ja - ,.!?
		if (preg_match ( "/^[a-zöåä0-9\-.,!?]$/i", $this->arvostelu )) {
			return 14;
		}
		
		return 0;
	}
	
	
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getId() {
		return $this->id;
	}
	
	// Metodilla näytetään virhekoodia vastaava teksti
	public static function getError($virhekoodi) {
		if (isset ( self::$virhelista [$virhekoodi] ))
			return self::$virhelista [$virhekoodi];
		
		return self::$virhelista [- 1];
	}

	
}

?>