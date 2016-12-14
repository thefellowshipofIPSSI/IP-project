<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\Skill;

use Ipssi\IntranetBundle\Form\SkillType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class SkillController extends Controller {

    /**
     * List all Skills in table
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/skill", name="intranet_skill_homepage")
     * @Security("has_role('ROLE_SUPERVISEUR')")
     */
    public function indexAction() {

        $allSkills = $this->get('intranet.repository.skill')->findAll();

        return $this->render('IntranetBundle:Skill:index.html.twig', [
            'allSkills' => $allSkills
        ]);
    }

    /**
     * Create a new Skill
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/skill/create", name="intranet_skill_create")
     * @Security("has_role('ROLE_SUPERVISEUR')")
     */
    public function createAction(Request $request) {
        $skill = new Skill;

        $form = $this->createForm(SkillType::class, $skill);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $skill = $form->getData();
            $skill->setUser($this->getUser());

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($skill);
            $em->flush();

            $this->addFlash(
                'success',
                'Nouveau poste créé !'
            );

            return $this->redirectToRoute('intranet_skill_homepage');

        }

        return $this->render('IntranetBundle:Skill:create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Update existing Skill
     * @param $skill
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/skill/{id}/update", name="intranet_skill_update")
     * @Security("has_role('ROLE_SUPERVISEUR')")
     */
    public function updateAction(Skill $skill, Request $request)
    {
        $form = $this->createForm(SkillType::class, $skill);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $skill = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($skill);
            $em->flush();

            $this->addFlash(
                'success',
                'Skill ' . $skill->getTitle() . ' modifiée !'
            );

            return $this->redirectToRoute('intranet_skill_homepage');

        }

        return $this->render('IntranetBundle:Skill:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a Skill
     * @param $skill
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/skill/{id}/delete", name="intranet_skill_delete")
     * @Security("has_role('ROLE_SUPERVISEUR')")
     */
    public function deleteAction(Skill $skill)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($skill);
        $em->flush();

        $this->addFlash(
            'success',
            'Skill ' . $skill->getTitle() . ' supprimée'
        );

        return $this->redirectToRoute('intranet_skill_homepage');
    }


    /**
     * Display a Skill
     * @param $skill
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/skill/{id}/view", name="intranet_skill_view")
     * @Security("has_role('ROLE_SUPERVISEUR')")
     */
    public function viewAction(Skill $skill)
    {
        return $this->render('IntranetBundle:Skill:view.html.twig', [
            'skill' => $skill
        ]);
    }


//    /**
//     * Make a Skill online
//     * @param $skill
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     * @Route("/skill/{id}/online", name="intranet_skill_online")
//     * @Security("has_role('ROLE_SUPERVISEUR')")
//     */
//    public function onlineAction(Skill $skill)
//    {
//        $skill->setStatus(1);
//
//        $em = $this->getDoctrine()->getEntityManager();
//        $em->persist($skill);
//        $em->flush();
//
//        return $this->redirectToRoute('intranet_skill_homepage');
//    }
//
//    /**
//     * Make a Skill offline
//     * @param $skill
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     * @Route("/skill/{id}/offline", name="intranet_skill_offline")
//     * @Security("has_role('ROLE_SUPERVISEUR')")
//     */
//    public function offlineAction(Skill $skill)
//    {
//        $skill->setStatus(0);
//
//        $em = $this->getDoctrine()->getEntityManager();
//        $em->persist($skill);
//        $em->flush();
//
//        return $this->redirectToRoute('intranet_skill_homepage');
//    }

}
