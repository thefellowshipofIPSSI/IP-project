<?php


namespace Ipssi\JobBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\JobBundle\Entity\Skill;
use Ipssi\JobBundle\Entity\SkillType;

use Ipssi\JobBundle\Form\SkillType as SkillForm;
use Ipssi\JobBundle\Form\SkillTypeType as SkillTypeForm;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SkillController extends Controller
{


    /**
     * List all SkillType with their Skills
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $skillTypes = $em->getRepository('JobBundle:SkillType')->findAll();
        $orphanSkills = $em->getRepository('JobBundle:Skill')->findBy(['type' => null]);


        return $this->render('JobBundle:Intranet/Skill:index.html.twig', array(
            'skillTypes' => $skillTypes,
            'orphanSkills' => $orphanSkills
        ));

    }

    /************************************ CRUD Skill ************************************/


    /**
     * View current Skill
     *
     * @param $skill
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($skill)
    {
        $em = $this->getDoctrine()->getManager();

        $skill = $em->getRepository('JobBundle:Skill')->find($skill);


        return $this->render('JobBundle:Intranet/Skill:view.html.twig', array(
            'skill' => $skill
        ));

    }


    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $skill = new Skill();


        // Pass EntityManager for using ArrayToSkillTransformer
        $form = $this->createForm(SkillForm::class, $skill, array('manager' => $em));
        $form->add('submit', SubmitType::class, array(
            'label' => 'Créer l\'offre',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {


            $skill = $form->getData();

            $skill->setStatus(0);

            $em->persist($skill);
            $em->flush();


            $this->addFlash(
                'success',
                'Nouvelle offre créée !'
            );

            return $this->redirectToRoute('intranet_skills');

        }


        $skills = $em->getRepository('JobBundle:Skill')->allNamesToArray();


        return $this->render('JobBundle:Intranet/Skill:create.html.twig', array(
            'skill' => $skill,
            'skills' => $skills,
            'form' => $form->createView()
        ));


    }


    public function updateAction(Request $request, $skill)
    {
        // Get current Skill
        $em = $this->getDoctrine()->getManager();
        $skill = $em->getRepository('JobBundle:Skill')->find($skill);


        // Pass EntityManager for using ArrayToSkillTransformer
        $form = $this->createForm(SkillForm::class, $skill, array('manager' => $em));

        // Add submit btn
        $form->add('submit', SubmitType::class, array(
            'label' => 'Valider les modifications',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {


            // Get form data and save Skill
            $skill = $form->getData();

            $skill->setStatus(0);

            $em->persist($skill);
            $em->flush();


            $this->addFlash(
                'success',
                'Nouvelle offre créée !'
            );

            return $this->redirectToRoute('intranet_skills');

        }


        // Get all names for Skill Input
        $skills = $em->getRepository('JobBundle:Skill')->allNamesToArray();


        return $this->render('JobBundle:Intranet/Skill:create.html.twig', array(
            'skill' => $skill,
            'skills' => $skills,
            'form' => $form->createView()
        ));

    }


    public function deleteAction($skill)
    {

        $em = $this->getDoctrine()->getManager();

        // Get current skill and delete it
        $skill = $em->getRepository('JobBundle:Skill')->find($skill);
        $em->remove($skill);
        $em->flush();


        $this->addFlash(
            'danger',
            'Offre supprimée'
        );

        return $this->redirectToRoute('intranet_skills');
    }




    /******************************** CRUD SkillType ************************************/


    /**
     * Create new SkillType
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createTypeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $skillType = new SkillType();


        // Pass EntityManager for using ArrayToSkillTransformer
        $form = $this->createForm(SkillTypeForm::class, $skillType, array('manager' => $em));
        $form->add('submit', SubmitType::class, array(
            'label' => 'Créer l\'offre',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {


            // Get form data and save Skill
            $skillType = $form->getData();

            $em->persist($skillType);

            // Set SkillType as Type for each Skill
            foreach($skillType->getSkills() as $skill) {
                $skill->setType($skillType);
                $em->persist($skill);
            }

            $em->flush();


            $this->addFlash(
                'success',
                'Catégorie ajoutée !'
            );

            return $this->redirectToRoute('intranet_skills');

        }


        // Get all names for Skill Input
        $skills = $em->getRepository('JobBundle:Skill')->allUnusedNamesToArray();


        return $this->render('JobBundle:Intranet/Skill/Type:create.html.twig', array(
            'skillType' => $skillType,
            'skills' => $skills,
            'form' => $form->createView()
        ));


    }


    public function updateTypeAction(Request $request, $skillType)
    {
        // Get current Skill
        $em = $this->getDoctrine()->getManager();
        $skillType = $em->getRepository('JobBundle:SkillType')->find($skillType);


        // Pass EntityManager for using ArrayToSkillTransformer
        $form = $this->createForm(SkillTypeForm::class, $skillType, array('manager' => $em));

        // Add submit btn
        $form->add('submit', SubmitType::class, array(
            'label' => 'Valider les modifications',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {


            // Get form data and save Skill
            $skillType = $form->getData();

            $em->persist($skillType);

            // Set SkillType as Type for each Skill
            foreach($skillType->getSkills() as $skill) {
                $skill->setType($skillType);
                $em->persist($skill);
            }

            $em->flush();


            $this->addFlash(
                'success',
                'Catégorie modifiée !'
            );

            return $this->redirectToRoute('intranet_skills');

        }


        // Get all names for Skill Input
        $skills = $em->getRepository('JobBundle:Skill')->allUnusedNamesToArray($skillType);


        return $this->render('JobBundle:Intranet/Skill/Type:update.html.twig', array(
            'skillType' => $skillType,
            'skills' => $skills,
            'form' => $form->createView()
        ));

    }


    /**
     * Delete SkillType if no contain skills
     *
     * @param $skillType
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteTypeAction($skillType)
    {

        $em = $this->getDoctrine()->getManager();

        // Get current skill and delete it
        $skillType = $em->getRepository('JobBundle:SkillType')->find($skillType);

        foreach($skillType->getSkills() as $skill) {
            $skill->setType(null);
            $em->persist($skill);
        }

        $em->remove($skillType);
        $em->flush();


        $this->addFlash(
            'danger',
            'Type de compétence supprimée'
        );

        return $this->redirectToRoute('intranet_skills');
    }

}