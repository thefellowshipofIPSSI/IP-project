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
            $datatable->buildDatatable(array(), $offer->getId());

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


    /**
     * @param $candidacy
     * @return Response
     */
    public function viewAction($candidacy)
    {
        $em = $this->getDoctrine()->getManager();

        $offer = $em->getRepository('JobBundle:Candidacy')->find($candidacy);


        return $this->render('JobBundle:Intranet/Candidacy:view.html.twig', array(
            'offer' => $offer
        ));

    }


    /*********** Results AJAX  **********/

    /**
     * Return candidacies for an offer for Datatables
     *
     * @param $offer Offer
     * @return mixed
     */
    public function candidaciesByOfferResultsAction($offer)
    {

        $datatable = $this->get('app.datatable.candidacy');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        //Display only user's cra if ROLE_RH or ROLE_SUPERVISEUR or ROLE_MANAGER
        if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPERVISEUR')
            || $this->get('security.authorization_checker')->isGranted('ROLE_RH')
            ||$this->get('security.authorization_checker')->isGranted('ROLE_MANAGER')
        ) {
            $query->buildQuery();
            $qb = $query->getQuery();
            $qb->andWhere("job_candidacy.offer = " . $offer);

            return $query->getResponse(false);
        } else {
            return $query->getResponse();
        }
    }


    /**
     * Return all candidacies for Datatables
     *
     * @return mixed
     */
    public function candidaciesResultsAction()
    {
        $datatable = $this->get('app.datatable.usercra');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        //Display only user's cra if ROLE_CREATE_CRA
        if ($this->get('security.authorization_checker')->isGranted('ROLE_CREATE_CRA')) {
            $query->buildQuery();
            $qb = $query->getQuery();

            return $query->getResponse(false);
        } else {
            return $query->getResponse();
        }
    }


}