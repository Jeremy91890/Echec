<?php
namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Tour extends Pieces {
	
	public function __construct($uneCouleur, $x, $y, $plateau) {
		parent::__construct($uneCouleur, $x, $y, $plateau);
	}
	
	function toString() {
		return 'Tour-'.$this->couleur;	
	}
	
	private function boucle($pmunx, $pmuny, $caseLibre) {
		$direction = true;
		$x = $this->x + $pmunx;
		$y = $this->y + $pmuny;
		
		while($direction) {
			if ($this->plateau->get($x, $y) == false){
				$direction = false;
			}
			else if ($this->plateau->get($x, $y) == "") {
				$caseLibre[] = array ($x, $y);
			}
			else {
				$couleur = explode('-', $this->plateau->get($x, $y))[1];
				if ($this->couleur == $couleur){
					$direction = false;
				}
				else {
					$caseLibre[] = array($x, $y);
					$direction = false ;
				}
			}
			$x = $this->x + $pmunx;
			$y = $this->y + $pmuny;
		}
	}
	
	public function deplacementPossible() {
		
		$caseLibre = array();
		
		boucle(0,-1, $caseLibre);
		boucle(0,1, $caseLibre);
		boucle(1,0, $caseLibre);
		boucle(-1,0, $caseLibre);
		
		return $caseLibre;
	}

	public function deplacement($x, $y) {
		
	}
}