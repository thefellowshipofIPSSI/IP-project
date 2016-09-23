<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\JobOffer;

use Ipssi\IntranetBundle\Form\JobOfferType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;


class JobOfferController extends Controller {

    /**
     * List all Job offers in table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {

        $allJobOffers = $this->get('intranet.repository.jobOffer')->findAll();

        return $this->render('IntranetBundle:JobOffer:index.html.twig', [
            'allJobOffers' => $allJobOffers
        ]);
    }

    /**
     * Create a new Job offer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $jobOffer = new JobOffer;

        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $jobOffer = $form->getData();
            $jobOffer->setUser($this->getUser());

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($jobOffer);
            $em->flush();

            $this->addFlash(
                'success',
                'Nouvelle offer de poste créée !'
            );

            return $this->redirectToRoute('intranet_job_offer_homepage');

        }

        return $this->render('IntranetBundle:JobOffer:create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Update existing JobOffer
     * @param $jobOffer_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($jobOffer_id, Request $request)
    {
        $jobOfferRepo = $this->get('intranet.repository.jobOffer');

        $jobOffer = $jobOfferRepo->find($jobOffer_id);

        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $jobOffer = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($jobOffer);
            $em->flush();

            $this->addFlash(
                'success',
                'JobOffer ' . $jobOffer->getName() . ' modifiée !'
            );

            return $this->redirectToRoute('intranet_job_offer_homepage');

        }

        return $this->render('IntranetBundle:JobOffer:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a JobOffer
     * @param $jobOffer_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($jobOffer_id)
    {
        $jobOfferRepo = $this->get('intranet.repository.jobOffer');

        $jobOffer = $jobOfferRepo->find($jobOffer_id);

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($jobOffer);
        $em->flush();

        $this->addFlash(
            'success',
            'JobOffer ' . $jobOffer->getName() . ' supprimée'
        );

        return $this->redirectToRoute('intranet_job_offer_homepage');
    }


    /**
     * Display a JobOffer
     * @param $jobOffer_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($jobOffer_id)
    {
        $jobOfferRepo = $this->get('intranet.repository.jobOffer');

        $jobOffer = $jobOfferRepo->find($jobOffer_id);
        $jobOfferTemplate = $jobOffer->getJobOfferTemplate()->getName();

        return $this->render('IntranetBundle:JobOffer\Templates:'. $jobOfferTemplate .'.html.twig', [
            'job_offer' => $jobOffer
        ]);
    }


    /**
     * Make a JobOffer online
     * @param $jobOffer_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function onlineAction($jobOffer_id)
    {
        $jobOfferRepo = $this->get('intranet.repository.jobOffer');

        $jobOffer = $jobOfferRepo->find($jobOffer_id);
        $jobOffer->setStatus(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($jobOffer);
        $em->flush();

        return $this->redirectToRoute('intranet_job_offer_homepage');
    }

    /**
     * Make a JobOffer offline
     * @param $jobOffer_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function offlineAction($jobOffer_id)
    {
        $jobOfferRepo = $this->get('intranet.repository.jobOffer');

        $jobOffer = $jobOfferRepo->find($jobOffer_id);
        $jobOffer->setStatus(0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($jobOffer);
        $em->flush();

        return $this->redirectToRoute('intranet_job_offer_homepage');
    }

}
