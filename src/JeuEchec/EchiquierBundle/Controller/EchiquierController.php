<?php
namespace JeuEchec\EchiquierBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JeuEchec\EchiquierBundle\Entity\Plateau;

class EchiquierController extends Controller
{
	
	public function plateauAction()
	{
		$matrice = new Plateau();
		 
		return $this->render('JeuEchecEchiquierBundle:includes:plateau.html.twig', array('matrice'=> $matrice));
	}
}
