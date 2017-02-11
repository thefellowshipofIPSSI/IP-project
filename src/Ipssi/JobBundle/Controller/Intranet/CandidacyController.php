<?php


namespace Ipssi\JobBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\JobBundle\Entity\Offer;
use Ipssi\JobBundle\Entity\Candidacy;

use Ipssi\JobBundle\Form\OfferType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class CandidacyController extends Controller
{

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('JobBundle:Offer')->findAll();


        return $this->render('JobBundle:Intranet/Offer:index.html.twig', array(
            'offers' => $offers
        ));

    }

    /**
     * List all Candidacies for an Offer
     *
     * @param $offer
     * @return Response
     */
    public function listByOfferAction($offer)
    {
        $em = $this->getDoctrine()->getManager();

        if($offer = $em->getRepository('JobBundle:Offer')->find($offer)) {
            $candidacies = $offer->getCandidacies()->toArray();

            $datatable = $this->get('app.datatable.candidacy');
            $datatable->buildDatatable(array('data' => $candidacies));

        }
        else {
            throw new NotFoundResourceException("L'offre n'existe pas");
        }

        return $this->render('JobBundle:Intranet/Candidacy:list_by_offer.html.twig', array(
            'offer' => $offer,
            'candidacies' => $candidacies,
            'datatable' => $datatable
        ));
    }


    public function viewAction($candidacy)
    {
        $em = $this->getDoctrine()->getManager();

        $offer = $em->getRepository('JobBundle:Candidacy')->find($candidacy);


        return $this->render('JobBundle:Intranet/Offer:view.html.twig', array(
            'offer' => $offer
        ));

    }


}