<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Roi extends Pieces {

	public function __construct($uneCouleur, $x, $y, $plateau) {
		parent::__construct($uneCouleur, $x, $y, $plateau);
	}
	function toString() {
		return 'Roi-'.$this->couleur;
	}

	
	private function verif($pmunx, $pmuny, $caseLibre) {

		$x = $this->x + $pmunx;
		$y = $this->y + $pmuny;

		if ($this->plateau->get($x, $y) == "") {
				$caseLibre[] = array ($x, $y);
			}
			else {
				$couleur = explode('-', $this->plateau->get($x, $y))[1];
				if ($this->couleur != $couleur){
					$caseLibre[] = array($x, $y);
				}
		}
	}
	
	public function deplacementPossible() {

		$caseLibre = array();

		verif(-1,1, $caseLibre);
		verif(1,-1, $caseLibre);
		verif(1,1, $caseLibre);
		verif(-1,-1, $caseLibre);
		verif(0,-1, $caseLibre);
		verif(0,1, $caseLibre);
		verif(1,0, $caseLibre);
		verif(-1,0, $caseLibre);
		
		return $caseLibre;
	}

	public function deplacement($x, $y) {

	}
}