<?php

namespace Ipssi\IpssiBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{
    
    /**
     * @Route("/intranet/page", name="intranet/page")
     * @Template("IpssiBundle:Back:Page:index.html.twig")
     * @return type
     */
    public function indexAction()
    {
        return $this->render('IpssiBundle:Back:Page:index.html.twig');
    }
}