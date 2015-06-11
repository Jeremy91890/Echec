<?php

namespace JeuEchec\EchiquierBundle\Controller;

session_start();

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	session_destroy();
    	return $this->render('JeuEchecEchiquierBundle:Default:index.html.twig');
    }

}
