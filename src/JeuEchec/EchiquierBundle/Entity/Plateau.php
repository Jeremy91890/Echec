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
					0 => new Vide($i, 'a', $this),
					1 => new Vide($i, 'b', $this),
					2 => new Vide($i, 'c', $this),
					3 => new Vide($i, 'd', $this),
					4 => new Vide($i, 'e', $this),
					5 => new Vide($i, 'f', $this),
					6 => new Vide($i, 'g', $this),
					7 => new Vide($i, 'h', $this));
		}
		 
		//puis on les pose sur le plateau grâce à leurs coordonnées 
		$this->plateau [1][0] = new Tour('Blanc', 1, 'a', $this);
		$this->plateau [1][7] = new Tour('Blanc', 1, 'h', $this);
		$this->plateau [8][0] = new Tour('Noir', 8, 'a', $this);
		$this->plateau [8][7] = new Tour('Noir', 8, 'h', $this);
		
		$this->plateau [1][2] = new Fou('Blanc', 1, 'c', $this);
		$this->plateau [1][5] = new Fou('Blanc', 1, 'f', $this);
		$this->plateau [8][2] = new Fou('Noir', 8, 'c', $this);
		$this->plateau [8][5] = new Fou('Noir', 8, 'f', $this);
		
		
		$this->plateau [1][1] = new Cavalier('Blanc', 1, 'b', $this);
		$this->plateau [1][6] = new Cavalier('Blanc', 1, 'g', $this);
		$this->plateau [8][1] = new Cavalier('Noir', 8, 'b', $this);
		$this->plateau [8][6] = new Cavalier('Noir', 8, 'g', $this);
		
		$this->plateau [1][4] = new Reine('Blanc', 1, 'e', $this);
		$this->plateau [8][4] = new Reine('Noir', 8, 'e', $this);
		
		$this->plateau [1][3] = new Roi('Blanc', 1, 'd', $this);
		$this->plateau [8][3] = new Roi('Noir', 8, 'd', $this);
		
		$this->plateau [7][0] = new Pion('Noir', 7, 'a', $this);
		$this->plateau [7][1] = new Pion('Noir', 7, 'b', $this);
		$this->plateau [7][2] = new Pion('Noir', 7, 'c', $this);
		$this->plateau [7][3] = new Pion('Noir', 7, 'd', $this);
		$this->plateau [7][4] = new Pion('Noir', 7, 'e', $this);
		$this->plateau [7][5] = new Pion('Noir', 7, 'f', $this);
		$this->plateau [7][6] = new Pion('Noir', 7, 'g', $this);
		$this->plateau [7][7] = new Pion('Noir', 7, 'h', $this);
		
		$this->plateau [2][0] = new Pion('Blanc', 2, 'a', $this);
		$this->plateau [2][1] = new Pion('Blanc', 2, 'b', $this);
		$this->plateau [2][2] = new Pion('Blanc', 2, 'c', $this);
		$this->plateau [2][3] = new Pion('Blanc', 2, 'd', $this);
		$this->plateau [2][4] = new Pion('Blanc', 2, 'e', $this);
		$this->plateau [2][5] = new Pion('Blanc', 2, 'f', $this);
		$this->plateau [2][6] = new Pion('Blanc', 2, 'g', $this);
		$this->plateau [2][7] = new Pion('Blanc', 2, 'h', $this);
 }
    
    //Permet de savoir si une case se trouve sur le plateau ou en dehors 
    private function getCase($x, $y) {
    	if ($x < 1  && $x > 8 && $y < 1 && $y > 8 ){
    		return false; 
    	}	
    	if ( isset($this->plateau[$x][$y]) ) {
    		return $this->plateau[$x][$y];
    	}
    }
    //Permet de convertir le $x qui est un caractère en entier avec la fonction ord()
    public function get($x, $y) {
    	if(gettype($y) == "string") {
    		return $this->getCase($x, ord($y) - 97);
    	} else {
    		return $this->getCase($x, $y);
    	}
    }
    public function setCase($x, $y, $piece) {
    	$this->plateau [$x][$y] = $piece;
    }
}