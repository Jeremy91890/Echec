<?php

namespace JeuEchec\EchiquierBundle\Controller;

session_start();

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JeuEchec\EchiquierBundle\Entity\Plateau;
use JeuEchec\EchiquierBundle\Entity\Vide;

class EchiquierController extends Controller
{
	private $matrice;
	private $x;
	private $y;

	private function initMatrice() {
		if(isset($_SESSION['map'])) {
			$this->matrice = unserialize($_SESSION['map']);
			$this->x = $_SESSION['x'];
			$this->y = $_SESSION['y'];
		} 
		else {
			$this->matrice = new Plateau();
		}
	}
	
	public function plateauAction()
	{
		$this->initMatrice();
		
		return $this->render('JeuEchecEchiquierBundle:includes:plateau.html.twig', array('matrice'=> $this->matrice));
	}
	
	public function voirAction($x , $y) {
		
		$this->initMatrice();
		$this->matrice->get(intval($x), $y)->deplacementPossible();
	
		
		$_SESSION['map'] = serialize($this->matrice);
		$_SESSION['x'] = intval($x);
		$_SESSION['y'] = $y;
		
		return $this->render('JeuEchecEchiquierBundle:includes:plateau.html.twig', array('matrice'=> $this->matrice));
	}
	
	public function deplacerAction($x, $y){
		
		$x = intval($x);
		$y = ord($y) -97;
		
		$this->initMatrice();
		$this->matrice->get(intval($this->x), $this->y)->deplacement($x, $y); 
		$_SESSION['map'] = serialize($this->matrice);
		return $this->render('JeuEchecEchiquierBundle:includes:plateau.html.twig', array('matrice'=> $this->matrice));
	}
}
