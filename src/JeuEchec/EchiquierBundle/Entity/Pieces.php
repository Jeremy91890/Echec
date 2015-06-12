<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class Pieces
{
    protected $couleur;
    protected $x;
    protected $y;
    protected $plateau;
    protected $enDanger = false;
    protected $estDeplace = false;    
	
    
	public function __construct($uneCouleur, $x, $y, $plateau){
		
		if(gettype($y) == "string") {
			$y = ord($y) - 97;
		}
		$this->couleur = $uneCouleur;
		$this->x = $x;
		$this->y = $y;
		$this->plateau = $plateau;
	}
	//_______________________________________Modificateurs___________________________________________
	
	public function setCouleur($uneCouleur){
		$this->couleur = $uneCouleur;
	}
	public function setPosition($x, $y){
		$this->x = $x;
		if(gettype($y) == "string") {
			$this->y = ord($y) - 97;
		} else {
			$this->y = $y;
		}
	}
	public function setEnDanger($danger)
		{
			$this->enDanger = $danger;
		}
	
	//________________________________________Accesseurs______________________________________________
	
	public function getCouleur(){
		return $this->couleur;
	}
	
	public function getX(){
		return $this->x;
	}
	
	public function getY(){
		return $this->y;
	}
	public function estEnDanger(){
		return $this->enDanger;
	}
	//_______________________________________________________________________________________________
	
	private function lienString(){
		if ($this->plateau->getCouleurJoueur() == $this->couleur ){
			return 'voir'.$this->getX().chr($this->getY() + 97);		
		}
	
	}
	
	private function lienDeplace(){
			return 'deplacer'.$this->getX().chr($this->getY() + 97);
		
	}
	
	public function lien() {
			if($this->enDanger) {
				return $this->lienDeplace();
			} else {
				return $this->lienString();
			}
	}
	
	public function deplacement($x, $y) {
		if ($this->plateau->getCouleurJoueur() == $this->couleur ){
			
			$this->plateau->setCase($this->x, $this->y , new Vide($this->x, $this->y, $this->plateau));
			$this->setPosition($x, $y);
			$this->plateau->setCase($x, $y, $this);
			$this->estDeplace = true;
			$this->estSelectionne = false;
			$this->plateau->joueurSuivant();
		}
		
	}
	
	//La création de classes abstraites va servir de base à toutes les classes filles (elles devront obligatoirement posséder ces fonctions)
	public abstract function deplacementPossible();
	
	
}