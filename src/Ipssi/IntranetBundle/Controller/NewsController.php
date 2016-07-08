<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ipssi\IpssiBundle\Entity\News;
use Ipssi\IntranetBundle\Form\NewsType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewsController extends Controller {

    public function indexAction() {
        return $this->render('IntranetBundle:News:index.html.twig');
    }

    public function createAction() {
        $news = new News;

        $form = $this->createForm(NewsType::class, $news);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer'
        ]);

        
        
        
        return $this->render('IntranetBundle:News:form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
