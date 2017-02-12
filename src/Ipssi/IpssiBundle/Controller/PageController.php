<?php

namespace Ipssi\IpssiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\Page;

use Ipssi\IntranetBundle\Form\PageType;
use Symfony\Component\HttpFoundation\Session\Session;

class PageController extends Controller {

    /**
     * Display a Page in front
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewFrontAction($slug)
    {
        $page = $this->get('intranet.repository.page')->FindOneBy(['slug'=> $slug]);

        $pageTemplate = $page->getPageTemplate()->getName();

        return $this->render('IntranetBundle:Page\Templates:'. $pageTemplate .'.html.twig', [
            'page' => $page
        ]);
    }
}
