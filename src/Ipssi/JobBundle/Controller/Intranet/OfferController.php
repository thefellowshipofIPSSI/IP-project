<?php


namespace Ipssi\JobBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OfferController extends Controller
{

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('JobBundle:Offer')->findAll();


        return $this->render('JobBundle:Intranet/Offer:index.html.twig', array(
            'offers' => $offers
        ));


    }

}