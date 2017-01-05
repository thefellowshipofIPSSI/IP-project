<?php


namespace Ipssi\JobBundle\Controller\App;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OfferController extends Controller
{

    /**
     * Display view with all offers
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $offers = $em->getRepository('JobBundle:Offer')->findAllOnline();

        return $this->render('JobBundle:App/Offer:index.html.twig', array(
            'offers' => $offers
        ));

    }


    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $offer = $em->getRepository('JobBundle:Offer')->findBySlug($slug);

        return $this->render('JobBundle:App/Offer:show.html.twig', [
            'offer' => $offer
        ]);
    }


    public function candidateAction($slug)
    {

    }
}