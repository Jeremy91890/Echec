<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Cavalier extends Pieces {

	public function __construct($uneCouleur, $x, $y, $plateau) {
		parent::__construct($uneCouleur, $x, $y, $plateau);
	}
	function toString() {
	if($this->couleur == 'Blanc'){
			return 'cavalierBlanc.png';
		}
		else {
			return 'cavalierNoir.png';
		}
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

		$this->verif(1, -2, $caseLibre);
		$this->verif(-1, -2, $caseLibre);
		$this->verif(1, 2, $caseLibre);
		$this->verif(-1, 2, $caseLibre);
		$this->verif(2, 1, $caseLibre);
		$this->verif(-2, 1, $caseLibre);
		$this->verif(2, -1, $caseLibre);
		$this->verif(-2 , -1, $caseLibre);
		
		return $caseLibre;
	}

	public function deplacementPossible(){
	
		$casesLibres = $this->caseLibre();
		foreach ($casesLibres as $case){
			$this->plateau->get($case[0], $case[1])->setEnDanger(true) ;
		}
	}
	
	
}