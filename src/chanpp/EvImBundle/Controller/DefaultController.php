<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('chanppEvImBundle:Default:index.html.twig', array('name' => $name));
    }
}
