<?php

namespace JeuEchec\EchiquierBundle\Controller;

session_start();

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JeuEchec\EchiquierBundle\Entity\Plateau;

class EchiquierController extends Controller
{
	private $matrice;
	
	private function initMatrice() {
		if(isset($_SESSION['map'])) {
			$this->matrice = $_SESSION['map'];
		} else {
			$this->matrice = new Plateau();
		}
	}
	
	public function plateauAction()
	{
		
		//session_destroy();
		
		$this->initMatrice();
		
		return $this->render('JeuEchecEchiquierBundle:includes:plateau.html.twig', array('matrice'=> $this->matrice));
	}
	
	public function voirAction($x , $y) {
		
		$this->initMatrice();
		$this->matrice->get(intval($x), $y)->deplacementPossible();
		
		return $this->render('JeuEchecEchiquierBundle:includes:plateau.html.twig', array('matrice'=> $this->matrice));
		
	}
}
