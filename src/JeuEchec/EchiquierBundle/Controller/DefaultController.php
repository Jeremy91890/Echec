<?php

namespace JeuEchec\EchiquierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	return $this->render('JeuEchecEchiquierBundle:Default:index.html.twig');
    }
    /*public function plateauAction()
    {
    	$matrice = array();
    	$matrice[0] = array(0,1,2,3,4,5,6,7);
    	$matrice[1] = array(8,9,10,11,12,13,14,15);
    	$matrice[2] = array(16,17,18,19,20,21,22,23);
    	$matrice[3] = array(24,25,26,27,28,29,30,31);
    	$matrice[4] = array(32,33,34,35,36,37,38,39);
    	$matrice[5] = array(40,41,42,43,44,45,46,47);
    	$matrice[6] = array(48,49,50,51,52,53,54,55);
    	$matrice[7] = array(56,57,58,59,60,61,62,63);
    	
        return $this->render('JeuEchecEchiquierBundle:includes:plateau.html.twig', array('matrice'=> $matrice));
    }*/
}
