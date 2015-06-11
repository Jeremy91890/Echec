<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Vide extends Pieces {
		
	public function __construct($x , $y, $plateau) {
		parent::__construct(null, $x, $y, $plateau);
		//var_dump($this->enDanger);
	}
	
	function toString() {
		return "vide";
	} 
	public function deplacementPossible() {
		return array();
	}

}