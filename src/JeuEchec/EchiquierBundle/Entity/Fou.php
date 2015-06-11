<?php
namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Fou extends Pieces {

	
	public function __construct($uneCouleur, $x, $y, $plateau) {
		parent::__construct($uneCouleur, $x, $y, $plateau);
	}

	function toString() {
		return 'Fou-'.$this->couleur;
	}

	private function boucle($pmunx, $pmuny, &$caseLibre) {
		$direction = true;
		$x = $this->x + $pmunx;
		$y = $this->y + $pmuny;

		while($direction) {
			if ($this->plateau->get($x, $y) == false){
				$direction = false;
			}
			else if ($this->plateau->get($x, $y)->toString() == 'vide') {
				$caseLibre[] = array ($x, $y);
			}
			else {
				if ($this->couleur == $this->plateau->get($x, $y)->getCouleur()){
					$direction = false;
				}
				else {
					$caseLibre[] = array($x, $y);
					$direction = false ;
				}
			}
			$x += $pmunx;
			$y += $pmuny;
		}
	}
	//
	public function caseLibre() {

		$caseLibre = array();

		$this->boucle(-1,1, $caseLibre);
		$this->boucle(1,-1, $caseLibre);
		$this->boucle(1,1, $caseLibre);
		$this->boucle(-1,-1, $caseLibre);

		return $caseLibre;
	}
	public function deplacementPossible(){
	
		$casesLibres = $this->caseLibre();
		foreach ($casesLibres as $case){
			$this->plateau->get($case[0], $case[1])->setEnDanger(true) ;
		}
	}
	public function deplacement($x, $y) {

	}
}