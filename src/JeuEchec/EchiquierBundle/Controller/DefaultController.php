<?php

namespace JeuEchec\EchiquierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	return $this->render('JeuEchecEchiquierBundle:Default:index.html.twig');
    }

}
