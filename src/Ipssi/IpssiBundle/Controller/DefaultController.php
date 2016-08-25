<?php

namespace Ipssi\IpssiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('IpssiBundle:Default:index.html.twig');
    }
}
