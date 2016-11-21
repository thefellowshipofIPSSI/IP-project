<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\Job;

use Ipssi\IntranetBundle\Form\JobType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;


class JobController extends Controller {

    /**
     * List all Jobs in table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {

        $allJobs = $this->get('intranet.repository.job')->findAll();

        return $this->render('IntranetBundle:Job:index.html.twig', [
            'allJobs' => $allJobs
        ]);
    }

    /**
     * Create a new Job
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $job = new Job;

        $form = $this->createForm(JobType::class, $job);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $job = $form->getData();
            $job->setUser($this->getUser());

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($job);
            $em->flush();

            $this->addFlash(
                'success',
                'Nouveau poste créé !'
            );

            return $this->redirectToRoute('intranet_job_homepage');

        }

        return $this->render('IntranetBundle:Job:create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Update existing Job
     * @param $job
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Job $job, Request $request)
    {
        $form = $this->createForm(JobType::class, $job);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $job = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($job);
            $em->flush();

            $this->addFlash(
                'success',
                'Job ' . $job->getTitle() . ' modifiée !'
            );

            return $this->redirectToRoute('intranet_job_homepage');

        }

        return $this->render('IntranetBundle:Job:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a Job
     * @param $job
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Job $job)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($job);
        $em->flush();

        $this->addFlash(
            'success',
            'Job ' . $job->getTitle() . ' supprimée'
        );

        return $this->redirectToRoute('intranet_job_homepage');
    }


    /**
     * Display a Job
     * @param $job
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Job $job)
    {
        return $this->render('IntranetBundle:Job:view.html.twig', [
            'job' => $job
        ]);
    }


//    /**
//     * Make a Job online
//     * @param $job
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function onlineAction(Job $job)
//    {
//        $job->setStatus(1);
//
//        $em = $this->getDoctrine()->getEntityManager();
//        $em->persist($job);
//        $em->flush();
//
//        return $this->redirectToRoute('intranet_job_homepage');
//    }
//
//    /**
//     * Make a Job offline
//     * @param $job
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function offlineAction(Job $job)
//    {
//        $job->setStatus(0);
//
//        $em = $this->getDoctrine()->getEntityManager();
//        $em->persist($job);
//        $em->flush();
//
//        return $this->redirectToRoute('intranet_job_homepage');
//    }

}
