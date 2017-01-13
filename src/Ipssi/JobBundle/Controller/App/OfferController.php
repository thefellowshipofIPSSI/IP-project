<?php


namespace Ipssi\JobBundle\Controller\App;


use Ipssi\JobBundle\Entity\Candidacy;
use Ipssi\JobBundle\Form\CandidacyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class OfferController extends Controller
{

    /**
     * Display view with all offers
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $offers = $em->getRepository('JobBundle:Offer')->findAllOnline();


        return $this->render('JobBundle:App/Offer:index.html.twig', array(
            'offers' => $offers
        ));

    }


    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $offer = $em->getRepository('JobBundle:Offer')->findBySlug($slug);

        return $this->render('JobBundle:App/Offer:show.html.twig', [
            'offer' => $offer
        ]);
    }


    public function candidateAction($slug, Request $request)
    {
        // Check if user is connected
        if($this->getUser()) {

            $em = $this->getDoctrine()->getEntityManager();

            $offer = $em->getRepository('JobBundle:Offer')->findBySlug($slug);
            $user = $this->getUser();

            $candidacy = new Candidacy();
            $form = $this->createForm(CandidacyType::class, $candidacy);
            $form->add('submit', SubmitType::class, array(
                'label' => 'Postuler à l\'offre',
                'attr'  => array('class' => 'btn btn-success')
            ));

            $form->handleRequest($request);

            if($form->isSubmitted()) {

                // Create candidacy
                $candidacy = $form->getData();

                // Status 0 : created
                $candidacy->setStatus(0);
                $candidacy->setDecision(0);
                $candidacy->setCandidate($user);
                $candidacy->setOffer($offer);

                // Upload CV
                $cv = $candidacy->getCV();
                $cv->setUser($user);

                $file = $cv->getFile();


                // Update profile informations
                $profile = $em->getRepository('UserBundle:Profile')->updateCandidateProfile($user->getProfile(), $form->get('profile')->getData(), $em);

                $em->persist($candidacy);
                $em->persist($file);
                $em->persist($cv);
                $em->persist($profile);


                $em->flush();


                $this->addFlash(
                    'success',
                    'Votre candidature a bien été enregistrée, vous pouvez suivre son état dans votre profil'
                );

                return $this->redirectToRoute('user_profile');

            }


            return $this->render('JobBundle:App/Offer:candidate.html.twig', [
                'form' => $form->createView(),
                'offer' => $offer,
                'user' => $user
            ]);


        }
        // If not connected => redirect for login
        else {
            return $this->redirectToRoute('user_login');
        }



    }
}