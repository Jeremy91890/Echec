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

	
	private function verif($pmunx, $pmuny, &$caseLibre) {

		$x = $this->x + $pmunx;
		$y = $this->y + $pmuny;
		if ($this->plateau->get($x, $y) != false){
			if ($this->plateau->get($x, $y)->toString() == 'vide') {
					$caseLibre[] = array ($x, $y);
				}
				else {
					if ($this->couleur != $this->plateau->get($x, $y)->getCouleur()){
						$caseLibre[] = array($x, $y);
					}
			}
		}
	}
	
	public function caseLibre() {

		$caseLibre = array();

		$this->verif(-1,1, $caseLibre);
		$this->verif(1,-1, $caseLibre);
		$this->verif(1,1, $caseLibre);
		$this->verif(-1,-1, $caseLibre);
		$this->verif(0,-1, $caseLibre);
		$this->verif(0,1, $caseLibre);
		$this->verif(1,0, $caseLibre);
		$this->verif(-1,0, $caseLibre);
		
		return $caseLibre;
	}
	
	public function deplacementPossible(){
	
		$casesLibres = $this->caseLibre();
		foreach ($casesLibres as $case){
			$this->plateau->get($case[0], $case[1])->setEnDanger(true) ;
		}
	}
	
}