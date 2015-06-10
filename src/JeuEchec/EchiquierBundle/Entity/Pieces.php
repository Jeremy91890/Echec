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
		$this->couleur=$uneCouleur;
	}
	public function setPosition($x, $y){
		$this->x = $x;
		if(gettype($y) == "string") {
			$this->y = ord($y) - 97;
		} else {
			$this->y = $y;
		}
	}
	public function setEndanger($danger)
		{
			$this->enDanger = $danger;
		}
	
	//_______________________________________Accesseurs_______________________________________________
	
	public function getType(){
		return $this->type;
	}
	
	public function getCouleur(){
		return $this->couleur;
	}
	
	public function getX(){
		return $this->x;
	}
	
	public function getY(){
		return $this->y;
	}
	
	public function lienString(){
		return 'voir'.$this->getX().chr($this->getY() + 97);
	}
	//______________________________________________________________________________________________
	
	//La création de classes abstraites va servir de base à toutes les classes filles (elles devront obligatoirement posséder ces fonctions)
	public abstract function deplacementPossible();
	//public abstract function deplacement($x, $y);
	
}