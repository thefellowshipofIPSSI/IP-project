<?php


namespace Ipssi\JobBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\JobBundle\Entity\Offer;

use Ipssi\JobBundle\Form\OfferType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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


    public function viewAction($offer)
    {
        $em = $this->getDoctrine()->getManager();

        $offer = $em->getRepository('JobBundle:Offer')->find($offer);


        return $this->render('JobBundle:Intranet/Offer:view.html.twig', array(
            'offer' => $offer
        ));

    }


    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $offer = new Offer();


        // Pass EntityManager for using ArrayToSkillTransformer
        $form = $this->createForm(OfferType::class, $offer, array('manager' => $em));
        $form->add('submit', SubmitType::class, array(
            'label' => 'Créer l\'offre',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {


            $offer = $form->getData();

            $offer->setStatus(0);
            $offer->setCreatedBy($this->getUser());

            $em->persist($offer);
            $em->flush();


            $this->addFlash(
                'success',
                'Nouvelle offre créée !'
            );

            return $this->redirectToRoute('intranet_offers');

        }


        $skills = $em->getRepository('JobBundle:Skill')->allNamesToArray();


        return $this->render('JobBundle:Intranet/Offer:create.html.twig', array(
            'offer' => $offer,
            'skills' => $skills,
            'form' => $form->createView()
        ));


    }


    public function updateAction(Request $request, $offer)
    {
        // Get current Offer
        $em = $this->getDoctrine()->getManager();
        $offer = $em->getRepository('JobBundle:Offer')->find($offer);


        // Pass EntityManager for using ArrayToSkillTransformer
        $form = $this->createForm(OfferType::class, $offer, array('manager' => $em));

        // Add submit btn
        $form->add('submit', SubmitType::class, array(
            'label' => 'Valider les modifications',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {


            // Get form data and save Offer
            $offer = $form->getData();

            $offer->setStatus(0);
            $offer->setUpdatedBy($this->getUser());


            $em->persist($offer);
            $em->flush();


            $this->addFlash(
                'success',
                'Nouvelle offre créée !'
            );

            return $this->redirectToRoute('intranet_offers');

        }


        // Get all names for Skill Input
        $skills = $em->getRepository('JobBundle:Skill')->allNamesToArray();


        return $this->render('JobBundle:Intranet/Offer:create.html.twig', array(
            'offer' => $offer,
            'skills' => $skills,
            'form' => $form->createView()
        ));

    }


    public function deleteAction($offer)
    {

        $em = $this->getDoctrine()->getManager();

        // Get current offer and delete it
        $offer = $em->getRepository('JobBundle:Offer')->find($offer);
        $em->remove($offer);
        $em->flush();


        $this->addFlash(
            'danger',
            'Offre supprimée'
        );

        return $this->redirectToRoute('intranet_offers');
    }


    public function publishAction($offer)
    {
        $em = $this->getDoctrine()->getManager();

        // Get current offer and delete it
        $offer = $em->getRepository('JobBundle:Offer')->find($offer);

        $offer->setStatus(1);

        $em->persist($offer);
        $em->flush();


        $this->addFlash(
            'success',
            'Offre mise en ligne'
        );

        return $this->redirectToRoute('intranet_offers');

    }

}