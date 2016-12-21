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

        $societies = $em->getRepository('JobBundle:Offer')->findAll();


        return $this->render('JobBundle:Intranet/Offer:index.html.twig', array(
            'societies' => $societies
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


        $form = $this->createForm(OfferType::class, $offer);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Créer',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $offer = $form->getData();

            $offer->setStatus(0);

            $em->persist($offer);
            $em->flush();


            $this->addFlash(
                'success',
                'Nouvelle société créée !'
            );

            return $this->redirectToRoute('intranet_offers');

        }


        return $this->render('JobBundle:Intranet/Offer:update.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView()
        ));


    }


    public function updateAction(Request $request, $offer)
    {
        $em = $this->getDoctrine()->getManager();

        $offer = $em->getRepository('JobBundle:Offer')->find($offer);


        $form = $this->createForm(OfferType::class, $offer);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Créer',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $offer = $form->getData();

            $file = $offer->getLogo();


            $em->persist($offer);
            $em->persist($file);
            $em->flush();


            $this->addFlash(
                'success',
                'Société modifiée !'
            );

            return $this->redirectToRoute('intranet_offers');

        }


        return $this->render('JobBundle:Intranet/Offer:update.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView()
        ));

    }


    public function deleteAction($offer)
    {
        $em = $this->getDoctrine()->getManager();

        $offer = $em->getRepository('JobBundle:Offer')->find($offer);

        $em->remove($offer);

        $em->flush();


        $this->addFlash(
            'danger',
            'Société supprimée'
        );

        return $this->redirectToRoute('intranet_offers');
    }

}