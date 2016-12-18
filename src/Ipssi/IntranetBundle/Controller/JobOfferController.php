<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\JobOffer;

use Ipssi\IntranetBundle\Form\JobOfferType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class JobOfferController extends Controller {

    /**
     * List all Job offers in table
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/job_offer", name="intranet_job_offer_homepage")
     * @Security("has_role('ROLE_VIEW_JOBOFFER') or has_role('ROLE_RH')")
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
     * @Route("/job_offer/create", name="intranet_job_offer_create")
     * @Security("has_role('ROLE_VIEW_JOBOFFER') or has_role('ROLE_RH')")
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
                'Nouvelle offre de poste créée !'
            );

            return $this->redirectToRoute('intranet_job_offer_homepage');

        }

        return $this->render('IntranetBundle:JobOffer:create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Update existing JobOffer
     * @param $jobOffer
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/job_offer/{id}/update", name="intranet_job_offer_update")
     * @Security("is_granted('edit', joboffer) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function updateAction(JobOffer $jobOffer, Request $request)
    {
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
                'L\'offre d\'emploi sur le poste ' . $jobOffer->getJob()->getTitle() . ' modifiée !'
            );

            return $this->redirectToRoute('intranet_job_offer_homepage');

        }

        return $this->render('IntranetBundle:JobOffer:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a JobOffer
     * @param $jobOffer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/job_offer/{id}/delete", name="intranet_job_offer_delete")
     * @Security("is_granted('edit', joboffer) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function deleteAction(JobOffer $jobOffer)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($jobOffer);
        $em->flush();

        $this->addFlash(
            'success',
            'L\'offre d\'emploi sur le poste ' . $jobOffer->getJob()->getTitle() . ' supprimée !'
        );

        return $this->redirectToRoute('intranet_job_offer_homepage');
    }


    /**
     * Display a JobOffer
     * @param $jobOffer
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/job_offer/{id}/view", name="intranet_job_offer_view")
     */
    public function viewAction(JobOffer $jobOffer)
    {
        return $this->render('IntranetBundle:JobOffer:view.html.twig', [
            'jobOffer' => $jobOffer
        ]);
    }


    /**
     * Make a JobOffer online
     * @param $jobOffer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/job_offer/{id}/online", name="intranet_job_offer_online")
     * @Security("is_granted('edit', joboffer) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function onlineAction(JobOffer $jobOffer)
    {
        $jobOffer->setStatus(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($jobOffer);
        $em->flush();

        $this->addFlash(
            'success',
            'L\'offre d\'emploi sur le poste ' . $jobOffer->getJob()->getTitle() . ' mise en ligne !'
        );

        return $this->redirectToRoute('intranet_job_offer_homepage');
    }

    /**
     * Make a JobOffer offline
     * @param $jobOffer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/job_offer/{id}/offline", name="intranet_job_offer_offline")
     * @Security("is_granted('edit', joboffer) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function offlineAction(JobOffer $jobOffer)
    {
        $jobOffer->setStatus(0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($jobOffer);
        $em->flush();

        $this->addFlash(
            'success',
            'L\'offre d\'emploi sur le poste ' . $jobOffer->getJob()->getTitle() . ' n\'est plus visible sur le site !'
        );

        return $this->redirectToRoute('intranet_job_offer_homepage');
    }

}
