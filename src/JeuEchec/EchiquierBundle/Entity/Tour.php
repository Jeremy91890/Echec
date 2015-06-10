<?php
namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Tour extends Pieces {
	
	//La classe Tour hérite de la classe Pieces
	//on creer donc une nouvelle piece 
	public function __construct($uneCouleur, $x, $y, $plateau) {
		parent::__construct($uneCouleur, $x, $y, $plateau);
	}
	
	function toString() {
		return 'Tour-'.$this->couleur;	
	}
	
	//Créer une fonction pour ne pas avoir a faire la meme boucle 4 fois 
	//on indique dans les paramètres la direction vers laquelle nous vérifions les cases libres 
	//et on stock les cases libres dans un tableau
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
				if ($this->couleur == $this->plateau->get($x, $y)->getCouleur()){
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
	//
	public function caseLibre() {
		
		$caseLibre = array();
	
		$this->boucle(0,-1, $caseLibre);
		$this->boucle(0,1, $caseLibre);
		$this->boucle(1,0, $caseLibre);
		$this->boucle(-1,0, $caseLibre);
		
		return $caseLibre;
	}

	public function deplacementPossible(){
		
		$casesLibres = caseLibre();
		foreach ($casesLibres as $case){
			$this->plateau[$case]->setEnDanger(true) ;
		}
	}
	public function deplacement($x, $y) {
		
	}
}