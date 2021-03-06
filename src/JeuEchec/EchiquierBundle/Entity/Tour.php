<?php
namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Tour extends Pieces {
	
	//La classe Tour h�rite de la classe Pieces
	//on creer donc une nouvelle piece 
	public function __construct($uneCouleur, $x, $y, $plateau) {
		parent::__construct($uneCouleur, $x, $y, $plateau);
	}
	
	function toString() {
		if($this->couleur == 'Blanc'){
				return 'tourBlanche.png';
			}
			else {
				return 'tourNoire.png';
			}
	}
	
	//Cr�er une fonction pour ne pas avoir a faire la meme boucle 4 fois 
	//on indique dans les param�tres la direction vers laquelle nous v�rifions les cases libres 
	//et on stock les cases libres dans un tableau
	private function boucle($pmunx, $pmuny, &$caseLibre) {
		$direction = true;
		$x = $this->x + $pmunx;
		$y = $this->y + $pmuny;
		
		while($direction) {
			if ($this->plateau->get($x, $y) == false){
				$direction = false;
			}
			else if ($this->plateau->get($x, $y)->toString() == 'vide') {
				$caseLibre[] =  array ($x, $y);
			}
			else {
				if ($this->couleur == $this->plateau->get($x, $y)->getCouleur()){
					$direction = false;
				}
				else {
					$caseLibre[] = array($x, $y);
					$direction = false;
				}
			}
			$x += $pmunx;
			$y += $pmuny;
		}
	}
	
	public function caseLibre() {
		
		$caseLibre = array();
	
		$this->boucle(0, -1, $caseLibre);
		$this->boucle(0, 1, $caseLibre);
		$this->boucle(1, 0, $caseLibre);
		$this->boucle(-1, 0, $caseLibre);
		
		return $caseLibre;	
	}

	public function deplacementPossible(){
		
		$casesLibres = $this->caseLibre();
		foreach ($casesLibres as $case){
			$this->plateau->get($case[0], $case[1])->setEnDanger(true) ;
		}
	}
	
}