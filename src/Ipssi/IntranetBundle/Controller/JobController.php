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
     * @param $job_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($job_id, Request $request)
    {
        $jobRepo = $this->get('intranet.repository.job');

        $job = $jobRepo->find($job_id);

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
                'Job ' . $job->getName() . ' modifiée !'
            );

            return $this->redirectToRoute('intranet_job_homepage');

        }

        return $this->render('IntranetBundle:Job:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a Job
     * @param $job_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($job_id)
    {
        $jobRepo = $this->get('intranet.repository.job');

        $job = $jobRepo->find($job_id);

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($job);
        $em->flush();

        $this->addFlash(
            'success',
            'Job ' . $job->getName() . ' supprimée'
        );

        return $this->redirectToRoute('intranet_job_homepage');
    }


    /**
     * Display a Job
     * @param $job_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($job_id)
    {
        $jobRepo = $this->get('intranet.repository.job');

        $job = $jobRepo->find($job_id);
        $jobTemplate = $job->getJobTemplate()->getName();

        return $this->render('IntranetBundle:Job\Templates:'. $jobTemplate .'.html.twig', [
            'job' => $job
        ]);
    }


//    /**
//     * Make a Job online
//     * @param $job_id
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function onlineAction($job_id)
//    {
//        $jobRepo = $this->get('intranet.repository.job');
//
//        $job = $jobRepo->find($job_id);
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
//     * @param $job_id
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function offlineAction($job_id)
//    {
//        $jobRepo = $this->get('intranet.repository.job');
//
//        $job = $jobRepo->find($job_id);
//        $job->setStatus(0);
//
//        $em = $this->getDoctrine()->getEntityManager();
//        $em->persist($job);
//        $em->flush();
//
//        return $this->redirectToRoute('intranet_job_homepage');
//    }

}
