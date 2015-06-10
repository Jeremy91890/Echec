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

		if ($this->plateau->get($x - 1, $y)!= false && $this->plateau->get($x, $y)->toString() == '') {
				$caseLibre[] = array ($x, $y);
			}
		if ($this->plateau->get($x - 1, $y)!= false && $this->plateau->get($x + 1, $y)->toString() != "" && $pmuny < 2 && $pmuny > -2){
			if ($this->couleur != $this->plateau->get($x + 1, $y)){
				$caseLibre[] = array($x + 1, $y);
			}
		}
		if ($this->plateau->get($x - 1, $y)!= false && $this->plateau->get($x - 1, $y)->toString() != "" && $pmuny < 2 && $pmuny > -2){			
			if ($this->couleur != $this->plateau->get($x - 1, $y)){
				$caseLibre[] = array($x - 1, $y);
			}
		}
	}
	
	public function caseLibre() {

		$caseLibre = array();
		
		if ($this->couleur == 'Noir'){
			$this->verif(0, - 1, $caseLibre);
			if ($this->deplace == false){
				$this->verif(0, - 2, $caseLibre);
			}
		}
		else {
			$this->verif(0, 1, $caseLibre);
			if ($this->deplace == false){
				$this->verif(0, 2, $caseLibre);
			}
		}
		return $caseLibre;
	}
	
	public function deplacementPossible(){
	
		$casesLibres = $this->caseLibre();
		foreach ($casesLibres as $case){
			$this->plateau[$case]->setEnDanger(true) ;
		}
	}

	public function deplacement($x, $y) {

	}
}