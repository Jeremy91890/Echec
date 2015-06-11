<?php

namespace JeuEchec\EchiquierBundle\Controller;

session_start();

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JeuEchec\EchiquierBundle\Entity\Plateau;
use JeuEchec\EchiquierBundle\Entity\Vide;
use JeuEchec\EchiquierBundle\Entity\Joueur;

class EchiquierController extends Controller
{
	private $matrice;
	private $x;
	private $y;
/*	private $joueurBlanc;
	private $joueurNoir;*/

	private function initMatrice() {
		if(isset($_SESSION['map'])) {
			$this->matrice = unserialize($_SESSION['map']);
			$this->x = $_SESSION['x'];
			$this->y = $_SESSION['y'];
			/*$this->joueurBlanc = $_SESSION['joueurBlanc'];
			$this->joueurNoir = $_SESSION['joueurNoir'];*/
		} 
		else {
			$this->matrice = new Plateau();
			/*$this->joueurBlanc = new Joueur('Blanc', 'joueur1');
			$this->joueurNoir = new Joueur('Noir', 'joueur2');*/
		}
	}
	
	public function plateauAction()
	{
		session_destroy();
		$this->initMatrice();
		
		return $this->render('JeuEchecEchiquierBundle:includes:plateau.html.twig', array('matrice'=> $this->matrice));
	}
	
	public function voirAction($x , $y) {
		
		$this->initMatrice();
		
		$_SESSION['map'] = serialize($this->matrice);
		$_SESSION['x'] = intval($x);
		$_SESSION['y'] = $y;
		/*$_SESSION['joueurBlanc'] = $this->joueurBlanc;
		$_SESSION['joueurNoir'] = $this->joueurNoir;*/
		
		$this->matrice->get(intval($x), $y)->deplacementPossible();
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
