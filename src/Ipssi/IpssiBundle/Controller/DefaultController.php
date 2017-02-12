<?php

namespace Ipssi\IpssiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {

        $page = $this->get('intranet.repository.page')->findOneBy(['name' => 'accueil']);
        $categories = $this->get('intranet.repository.pagecategorie')->findBy(['parent' => null]);

        return $this->render('IntranetBundle:Page\Templates:accueil.html.twig', [
            'page' => $page,
            'categories' => $categories,
        ]);
    }

    public function menuAction()
    {

        $page = $this->get('intranet.repository.page')->findOneBy(['name' => 'accueil']);
        $categories = $this->get('intranet.repository.pagecategorie')->findBy(['parent' => null]);

        return $this->render('menuFront.html.twig', [
            'page' => $page,
            'categories' => $categories,
        ]);
    }
}
