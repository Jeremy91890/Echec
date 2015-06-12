<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Pion extends Pieces {
	
	
	public function __construct($uneCouleur, $x, $y, $plateau) {
		parent::__construct($uneCouleur, $x, $y, $plateau);
	}
	
	function toString() {
	if($this->couleur == 'Blanc'){
			return 'pionBlanc.png';
		}
		else {
			return 'pionNoir.png';
		}
	}
	
	private function verif($pmunx, $pmuny, &$caseLibre) {

		$x = $this->x + $pmunx;
		$y = $this->y + $pmuny;
		if ($this->plateau->get($x, $y) != false){
			if ($this->plateau->get($x, $y)->toString() == 'vide') {
					$caseLibre[] = array ($x, $y);
				}
			if($this->estDeplace == false && $this->couleur =='Blanc' && $this->plateau->get($x + 1, $y)->toString() == 'vide' &&  $this->plateau->get($x , $y)->toString() == 'vide'){
					$caseLibre[] = array ($x + 1, $y);
			}
			if($this->estDeplace == false && $this->couleur =='Noir' && $this->plateau->get($x - 1, $y)->toString() == 'vide' && $this->plateau->get($x , $y)->toString() == 'vide'){
				$caseLibre[] = array ($x - 1, $y);
			}
			if ($this->plateau->get($x, $y + 1)!= false && $this->plateau->get($x , $y + 1)->toString() != "vide" ){
				if ($this->couleur != $this->plateau->get($x, $y + 1)->getCouleur()){
					$caseLibre[] = array($x, $y + 1);
				}
			}
			if ($this->plateau->get($x, $y - 1) != false && $this->plateau->get($x, $y - 1)->toString() != "vide" ){			
				if ($this->couleur != $this->plateau->get($x, $y - 1)->getCouleur()){
					$caseLibre[] = array($x, $y - 1);
				}
			}
		}
	}
	
	public function caseLibre() {

		$caseLibre = array();
		
		if ($this->couleur == 'Noir'){
			$this->verif( -1, 0, $caseLibre);
		}
		else {
			$this->verif( 1, 0, $caseLibre);
		
		}
		return $caseLibre;
	}
	
	public function deplacementPossible(){
	
		$casesLibres = $this->caseLibre();
		foreach ($casesLibres as $case){
			$this->plateau->get($case[0], $case[1])->setEnDanger(true) ;
		}	
	}

}