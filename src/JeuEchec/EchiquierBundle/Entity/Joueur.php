<?php
namespace JeuEchec\EchiquierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Joueur{
	
	private $tour = 0;
	private $couleur;
	private $nom; 
	
/*	public function __construct($uneCouleur, $unNom){
		$this->couleur = $uneCouleur;
		$this->nom = $unNom;
	}	
	
	public function getCouleur(){
		return $this->couleur;
	}
	 public function getNom(){
	 	return $this->nom;
	 }
	 
	public function setCouleur($uneCouleur){
		$this->couleur = $uneCouleur;
	}
	
	public function joueurSuivant(){
		
		if ($this->tour % 2 == 0){
			$this->couleur = 'Blanc';
		}
		else{
			$this->couleur = 'Noir';
		}
		$this->tour ++;
		return $this->couleur;
	}*/
}