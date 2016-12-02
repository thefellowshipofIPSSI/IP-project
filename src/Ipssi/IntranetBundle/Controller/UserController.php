<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use UserBundle\Entity\User;

use UserBundle\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class UserController extends Controller
{

    /**
     * List all Users
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/users", name="intranet_user_homepage")
     */
    public function indexAction()
    {
        $allUsers = $this->get('user.repository.user')->findAll();

        return $this->render('IntranetBundle:User:index.html.twig', [
            'allUsers' => $allUsers
        ]);
    }


    /**
     * Profile of a user
     * @param $user_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
//    public function profileAction($user_id)
//    {
//
//        $userRepo = $this->get('user.repository.user');
//
//        $user = $userRepo->find($user_id);
//
//        return $this->render('IntranetBundle:User:profile.html.twig', [
//            'user' => $user
//        ]);
//    }

    /**
     * Create new User
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/user/create", name="intranet_user_create")
     */
    public function createAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Utilisateur ' . $user->getUsername() . ' créé'
            );

            return $this->redirectToRoute('intranet_user_homepage');

        }


        return $this->render('IntranetBundle:User:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Update an User
     * @param $user
     * @param Request $request
     * @Route("/user/{id}/update", name="intranet_user_update")
     */
    public function updateAction(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Utilisateur ' . $user->getUsername() . ' modifié'
            );

            return $this->redirectToRoute('intranet_user_homepage');

        }


        return $this->render('IntranetBundle:User:update.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Delete an User
     * @param $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/user/{id}/delete", name="intranet_user_delete")
     */
    public function deleteAction(User $user)
    {
        if($user === $this->getUser()){
            $this->addFlash(
                'danger',
                'Impossible de supprimer l\'utilisateur courant'
            );

            return $this->redirectToRoute('intranet_user_homepage');
        }


        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash(
            'success',
            'Utilisateur ' . $user->getUsername() . ' supprimé'
        );

        return $this->redirectToRoute('intranet_user_homepage');
    }


    /**
     * Display an User
     * @param $user
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/user/{id}/view", name="intranet_user_view")
     */
    public function viewAction(User $user)
    {
        return $this->render('IntranetBundle:User:view', [
            'user' => $user
        ]);
    }

    /**
     * Enable an User
     * @param $user
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/user/{id}/online", name="intranet_user_enable")
     */
    public function enableAction(User $user)
    {
        $user->setEnabled(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash(
            'success',
            'Utilisateur ' . $user->getUsername() . ' activé'
        );

        return $this->redirectToRoute('intranet_user_homepage');
    }


    /**
     * Disable an User
     * @param $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/user/{id}/offline", name="intranet_user_disable")
     */
    public function disableAction(User $user)
    {
        $user->setEnabled(0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash(
            'success',
            'Utilisateur ' . $user->getUsername() . ' désactivé'
        );

        return $this->redirectToRoute('intranet_user_homepage');
    }
}