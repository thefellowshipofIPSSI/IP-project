<?php

namespace Ipssi\IpssiBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BackController extends Controller
{
    
    /**
     * @Route("/intranet", name="intranet")
     * @Template("IpssiBundle:Back:index.html.twig")
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}
