<?php

namespace Ipssi\IpssiBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BackController extends Controller
{
    
    /**
     * @Route("/intranet")
     * @return type
     */
    public function indexAction()
    {        
        
        return $this->render('IpssiBundle:Default:index.html.twig');
    }
}
