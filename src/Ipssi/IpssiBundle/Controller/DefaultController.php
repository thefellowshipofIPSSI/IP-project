<?php

namespace Ipssi\IpssiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {

        $page = $this->get('intranet.repository.page')->findOneBy(['name' => 'accueil']);
        $categories = $this->get('intranet.repository.pagecategorie')->findAll();

        return $this->render('IntranetBundle:Page\Templates:accueil.html.twig', [
            'page' => $page,
            'categories' => $categories,
        ]);
    }
}
