<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

class Plateau 
{
    private $plateau;

    //initialisation d'un plateau de 64 cases (8x8)
    public function __construct()
    {
		$this->plateau = array();
		for ($i=1;$i<=8;$i++){
			$this->plateau[$i]= array(
					1 => null,
					2 => null,
					3 => null,
					4 => null,
					5 => null,
					6 => null,
					7 => null,
					8 => null);
		}
		 
		//On instancie toutes les pièces
		$TourBlanche = new Tour('Blanc', 'a', 1, $this);
		$TourBlancheBis = new Tour('Blanc', 'h', 1, $this);
		$TourNoire = new Tour('Noir', 'a', 8, $this);
		$TourNoireBis = new Tour('Noir', 'h', 8, $this);
		
		$FouBlanc = new Fou ('Blanc' , 'c', 1, $this);
		$FouBlancBis = new Fou ('Blanc' , 'f', 1, $this);
		$FouNoir = new Fou ('Noir' , 'c', 8, $this);
		$FouNoirBis = new Fou ('Noir' , 'f', 8, $this);
		
		$CavalierBlanc = new Cavalier('Blanc', 'b', 1, $this);
		$CavalierBlancBis = new Cavalier('Blanc', 'g', 1, $this);
		$CavalierNoir = new Cavalier('Noir', 'b', 8, $this);
		$CavalierNoirBis = new Cavalier('Noir', 'g', 8, $this);
		
		$ReineNoire = new Reine('Noir', 'e', 8, $this);
		$ReineBlanche = new Reine('Blanc', 'e', 1, $this);
		
		$RoiNoir = new Roi('Noir', 'd', 8, $this);
		$RoiBlanc = new Roi('Blanc', 'd', 1, $this);
		
		$PionNoir = new Pion('Noir', 'a', 7, $this);
		
		//puis on les pose sur le plateau grâce à leurs coordonnées 
		$this->plateau[$TourBlanche->getX()][$TourBlanche->getY()] = $TourBlanche;
		$this->plateau[$TourBlancheBis->getX()][$TourBlancheBis->getY()] = $TourBlancheBis;
		$this->plateau[$TourNoire->getX()][$TourNoire->getY()] = $TourNoire;
		$this->plateau[$TourNoireBis->getX()][$TourNoireBis->getY()] = $TourNoireBis;
		
		$this->plateau[$FouBlanc->getX()][$FouBlanc->getY()] = $FouBlanc;
		$this->plateau[$FouBlancBis->getX()][$FouBlancBis->getY()] = $FouBlancBis;
		$this->plateau[$FouNoir->getX()][$FouNoir->getY()] = $FouNoir;
		$this->plateau[$FouNoirBis->getX()][$FouNoirBis->getY()] = $FouNoir;
		
		$this->plateau[$CavalierBlanc->getX()][$CavalierBlanc->getY()] = $CavalierBlanc;
		$this->plateau[$CavalierBlancBis->getX()][$CavalierBlancBis->getY()] = $CavalierBlancBis;
		$this->plateau[$CavalierNoir->getX()][$CavalierNoir->getY()] = $CavalierNoir;
		$this->plateau[$CavalierNoirBis->getX()][$CavalierNoirBis->getY()] = $CavalierNoirBis;
		
		$this->plateau[$ReineNoire->getX()][$ReineNoire->getY()] = $ReineNoire;
		$this->plateau[$ReineBlanche->getX()][$ReineBlanche->getY()] = $ReineBlanche;
		
		$this->plateau[$RoiNoir->getX()][$RoiNoir->getY()] = $RoiNoir;
		$this->plateau[$RoiBlanc->getX()][$RoiBlanc->getY()] = $RoiBlanc;
		
		$this->plateau [$PionNoir->getX()][$PionNoir->getY()] = $PionNoir;
 }
    
    //Permet de savoir si une case se trouve sur le plateau ou en dehors 
    private function getCase($x, $y) { 
    	
    	if ($x < 1  && $x > 8 && $y < 1 && $y > 8 ){
    		return false; 
    	}
    	if ( isset($this->plateau[$x][$y]) ) {
    		return $this->plateau[$x][$y]->toString();
    	} else {
    		return "";
    	}
    }
    //Permet de convertir le $x qui est un string en entier avec la fonction ord()
    public function get($x, $y) {
    	if(gettype($x) == "string") {
    		return $this->getCase(ord($x) - 97, $y);
    	} else {
    		return $this->getCase($x, $y);
    	}
    }
}