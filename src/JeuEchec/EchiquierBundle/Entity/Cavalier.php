<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Cavalier extends Pieces {

	public function __construct($uneCouleur, $x, $y, $plateau) {
		parent::__construct($uneCouleur, $x, $y, $plateau);
	}
	function toString() {
		return 'Cavalier-'.$this->couleur;
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

		verif(1, -2, $caseLibre);
		verif(-1, -2, $caseLibre);
		verif(1, 2, $caseLibre);
		verif(-1, 2, $caseLibre);
		verif(2, 1, $caseLibre);
		verif(-2, 1, $caseLibre);
		verif(2, -1, $caseLibre);
		verif(-2 , -1, $caseLibre);
		
		return $caseLibre;
	}

	public function deplacement($x, $y) {

	}
}