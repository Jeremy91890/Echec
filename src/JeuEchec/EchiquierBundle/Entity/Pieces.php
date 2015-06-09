<?php

namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class Pieces
{
    protected $couleur;
    protected $x;
    protected $y;
    protected $plateau;


	public function __construct($uneCouleur, $x, $y, $plateau){
		$this->couleur = $uneCouleur;
		$this->x = $y;
		$this->y = ord($x) - 97;
		$this->plateau = $plateau;
	}
	
	//_______________________________________Modificateurs___________________________________________
	
	public function setCouleur($uneCouleur){
		$this->couleur=$uneCouleur;
	}
	public function setPosition($x, $y){
		$this->x = $y;
		$this->y = ord($x) - 97;
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
	//______________________________________________________________________________________________
	
	//La création de classes abstraites va servir de base à toutes les classes filles (elles devront obligatoirement posséder ces fonctions)
	public abstract function deplacementPossible();
	public abstract function deplacement($x, $y);
	
}