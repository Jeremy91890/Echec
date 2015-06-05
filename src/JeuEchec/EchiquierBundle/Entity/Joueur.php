<?php
namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Joueur{
	
	private $couleur;
	
	public function __construct($uneCouleur){
		$this->couleur=$uneCouleur;
	}
	
	
}