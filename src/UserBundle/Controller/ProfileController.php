<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Controller;

use Ipssi\IpssiBundle\Entity\File;
use UserBundle\Entity\Newsletter;

use UserBundle\Form\UserType;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Controller\ProfileController as BaseController;

use UserBundle\Form\ImageType;
use UserBundle\Form\SwitchAvatarType;


/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends BaseController
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('UserBundle:Profile:show.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        //$formFactory = $this->get('fos_user.profile.form.factory');

        $form = $this->createForm(UserType::class, $user);
        $form->setData($user);

        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */

            $userManager = $this->get('fos_user.user_manager');

            if (!empty($form->get('password')->getData()))  {

                //encode the password
                $encoder = $this->container->get('security.encoder_factory')->getEncoder($user); //get encoder for hashing pwd later
                $tempPassword = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt());
                $user->setPassword($tempPassword);
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);


            return $this->redirectToRoute('user_profile');
        }


        return $this->render('UserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function changeAvatarAction(Request $request)
    {

        $profile = $this->getUser()->getProfile();

        $form = $this->createForm(SwitchAvatarType::class, $profile);

        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $gravatar = $form->get('gravatar')->getData();

            // Gravatar
            if($gravatar === true) {
                $profile->setGravatar(1);
            } else {
                $profile->setGravatar(0);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();

            return $this->redirectToRoute('user_profile');

        }

        return $this->render('UserBundle:Profile:change-avatar.html.twig', [
            'form' => $form->createView(),
            'profile' => $profile
        ]);
    }

    /**
     * Upload a file and set it to User avatar
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadAvatarAction(Request $request, Response $response = null)
    {
        $profile = $this->getUser()->getProfile();

        $file = new File();
        $form = $this->createForm(ImageType::class, $file);

        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($file);
            $em->flush();

            $profile->setAvatar($file);
            $profile->setGravatar(0);

            $em->persist($profile);
            $em->flush();

            $response = new Response();
            $response->setContent(json_encode(array('code' => 200, "success" => true)));
            return $response;

        }

        return $this->render('UserBundle:Profile:upload-avatar.html.twig', [
            'formFile' => $form->createView()
        ]);

    }

    public function subscribeAction()
    {
        $user = $this->getUser();

        // On teste si une entrée Newsletter existe pour cet User
        // Si aucune entrée, on l'ajoute à la table
        if(!$user->getNewsletter()) {
            $newsletter = new Newsletter;
            $newsletter->setEmail($user->getEmail());
            $newsletter->setUser($user);
        } else {
            $newsletter = $user->getNewsletter();
        }


        $newsletter->setEnabled(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($newsletter);
        $em->flush();

        $this->addFlash(
            'success',
            'Vous êtes inscrit à la liste de diffusion Echos-Libres'
        );

        return $this->redirectToRoute('user_profile');
    }

    public function unsubscribeAction()
    {
        $user = $this->getUser();

        if($newsletter = $user->getNewsletter())
        {
            $newsletter->setEnabled(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'warning',
                'Vous êtes désinscrit à la liste de diffusion Echos-Libres'
            );

        }

        return $this->redirectToRoute('user_profile');
    }

    public function publicProfileAction($pseudo)
    {
        $userRepo = $this->getDoctrine()->getRepository('UserBundle:User');

        $user = $userRepo->getByPseudo($pseudo);

        return $this->render('UserBundle:Profile:public_profile.html.twig', array(
            'user' => $user
        ));
    }


}
