<?php

namespace EJ\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EJTestBundle:Default:index.html.twig');
    }
}
