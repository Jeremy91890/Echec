<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Pion extends Pieces {
	
	private $deplace = false;
	
	public function __construct($uneCouleur, $x, $y, $plateau) {
		parent::__construct($uneCouleur, $x, $y, $plateau);
	}
	
	function toString() {
		return 'Pion-'.$this->couleur;
	}
	
	private function verif($pmunx, $pmuny, $caseLibre) {

		$x = $this->x + $pmunx;
		$y = $this->y + $pmuny;

		if ($this->plateau->get($x, $y) == "") {
				$caseLibre[] = array ($x, $y);
			}
		if (get_class($this->plateau->get($x + 1, $y)) == Pieces && $pmuny < 2 && $pmuny > -2){
			$couleur = explode('-', $this->plateau->get($x + 1, $y))[1];
			if ($this->couleur != $couleur){
				$caseLibre[] = array($x + 1, $y);
			}
		}
		if (get_class($this->plateau->get($x - 1, $y)) == Pieces && $pmuny < 2 && $pmuny > -2){			
			$couleur = explode('-', $this->plateau->get($x - 1, $y))[1];
			if ($this->couleur != $couleur){
				$caseLibre[] = array($x - 1, $y);
			}
		}
	}
	
	public function deplacementPossible() {

		$caseLibre = array();
		
		if ($this->couleur == 'Noir'){
			verif(0, - 1, $caseLibre);
			if ($this->deplace == false){
				verif(0, - 2, $caseLibre);
			}
		}
		else {
			verif(0, 1, $caseLibre);
			if ($this->deplace == false){
				verif(0, 2, $caseLibre);
			}
		}
		return $caseLibre;
	}

	public function deplacement($x, $y) {

	}
}