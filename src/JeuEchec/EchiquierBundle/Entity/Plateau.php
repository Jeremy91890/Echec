<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

class Plateau 
{
    private $plateau;

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
		 
		/*$TourBlanc = new Pieces('Tour','Blanc');
		$TourNoir = new Pieces('Tour','Noir');
		$plateau[1][0] = $plateau[1][7]= $TourBlanc->toString();
		$plateau[8][0] = $plateau[8][7] = $TourNoir->toString();*/
		
		$TourBlanc = new Tour('Blanc', 'a', 1, $this);
		//$TourNoir = new Pieces('Tour','Noir','[8][0]');
		
		$this->plateau[$TourBlanc->getX()][$TourBlanc->getY()] = $TourBlanc;

    }
    
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
    
    public function get($x, $y) {
    	if(gettype($x) == "string") {
    		return $this->getCase(ord($x) - 96, $y);
    	} else {
    		return $this->getCase($x, $y);
    	}
    }
}