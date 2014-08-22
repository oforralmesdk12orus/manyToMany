<?php

namespace Mesd\ManyToManyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MesdManyToManyBundle:Default:index.html.twig', array('name' => $name));
    }
}
