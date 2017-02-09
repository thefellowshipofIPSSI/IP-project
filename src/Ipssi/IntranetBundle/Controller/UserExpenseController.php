<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\UserExpense;

use Ipssi\IntranetBundle\Form\UserExpenseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;


class UserExpenseController extends Controller {

    /**
     * List all Expense in table
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/expense", name="intranet_expense_homepage")
     * @Security("has_role('ROLE_RH') or has_role('ROLE_CREATE_EXPENSE')")
     */
    public function indexAction() {

//        $allUserExpenses = $this->get('intranet.repository.expense')->findAll();
//
//        //Display only user's cra if ROLE_CREATE_EXPENSE
//        if ($this->get('security.authorization_checker')->isGranted('ROLE_CREATE_EXPENSE')) {
//            foreach ($allUserExpenses as $key => $userExpense) {
//                if ($userExpense->isCreator($this->getUser()) == false) {
//                    unset($allUserExpenses[$key]);
//                }
//            }
//        }
//
//        return $this->render('IntranetBundle:UserExpense:index.html.twig', [
//            'allUserExpenses' => $allUserExpenses
//        ]);

        $datatable = $this->get('app.datatable.userexpense');
        $datatable->buildDatatable();

        return $this->render('IntranetBundle:UserExpense:index.html.twig', array(
            'datatable' => $datatable,
        ));

    }

    /**
     * @Route("/expense/results", name="intranet_expense_results", options={"expose"=true})
     */
    public function indexResultsAction()
    {
        $datatable = $this->get('app.datatable.userexpense');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        //Display only user's expense if ROLE_CREATE_EXPENSE
        if ($this->get('security.authorization_checker')->isGranted('ROLE_CREATE_EXPENSE')) {
            $query->buildQuery();
            $qb = $query->getQuery();
            $user = $this->getUser()->getId();
            $qb->andWhere("user_expense.user = " . $user);

            return $query->getResponse(false);
        } else {
            return $query->getResponse();
        }
    }

    /**
     * Create a new Expense
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/expense/create", name="intranet_expense_create", options={"expose"=true})
     * @Security("has_role('ROLE_RH') or has_role('ROLE_CREATE_EXPENSE')")
     */
    public function createAction(Request $request) {
        $userExpense = new UserExpense;

        $form = $this->createForm(UserExpenseType::class, $userExpense);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $userExpense = $form->getData();
            $userExpense->setUser($this->getUser());

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($userExpense);
            $em->flush();

            $this->addFlash(
                'success',
                'Nouvelle note de frais créée !'
            );

            return $this->redirectToRoute('intranet_expense_homepage');

        }

        return $this->render('IntranetBundle:UserExpense:create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Update existing Expense
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/expense/{id}/update", name="intranet_expense_update", options={"expose"=true})
     * @Security("is_granted('edit', userExpense)")
     */
    public function updateAction(UserExpense $userExpense, Request $request)
    {
        $form = $this->createForm(UserExpenseType::class, $userExpense);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $userExpense = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($userExpense);
            $em->flush();

            $this->addFlash(
                'success',
                'Note de frais du ' . $userExpense->getCreationDate()->format('d-m-Y H:i:s') . ' modifiée !'
            );

            return $this->redirectToRoute('intranet_expense_homepage');

        }

        return $this->render('IntranetBundle:UserExpense:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a Expense
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/expense/{id}/delete", name="intranet_expense_delete", options={"expose"=true})
     * @Security("is_granted('edit', userExpense)")
     */
    public function deleteAction(UserExpense $userExpense)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($userExpense);
        $em->flush();

        $this->addFlash(
            'success',
            'Note de frais du ' . $userExpense->getCreationDate()->format('d-m-Y H:i:s') . ' supprimée'
        );

        return $this->redirectToRoute('intranet_expense_homepage');
    }


    /**
     * Display an Expense
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/expense/{id}/view", name="intranet_expense_view", options={"expose"=true})
     * @Security("is_granted('edit', userExpense)")
     */
    public function viewAction(UserExpense $userExpense)
    {
        $expenseLinesRepo = $this->get('intranet.repository.expense_line');
        $allExpenseLines = $expenseLinesRepo->findAllLinesForOneExpense($userExpense);

        return $this->render('IntranetBundle:UserExpense:view.html.twig', [
            'userExpense' => $userExpense,
            'allExpenseLines' => $allExpenseLines
        ]);
    }

    /**
     * Display a expense's pdf
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/expense/{id}/viewpdf", name="intranet_expense_view_pdf", options={"expose"=true})
     * @Security("is_granted('edit', userExpense)")
     */
    public function viewpdfAction(UserExpense $userExpense)
    {
        $expenseLinesRepo = $this->get('intranet.repository.expense_line');
        $allExpenseLines = $expenseLinesRepo->findAllLinesForOneExpense($userExpense);

        $html = $this->renderView('IntranetBundle:UserExpense:viewPdf.html.twig', [
            'userExpense'  => $userExpense,
            'allExpenseLines' => $allExpenseLines
        ]);

        $filename = "note_de_frais_" . $userExpense->getId();

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$filename.'".pdf"'
            )
        );
    }


    /**
     * Make a Expense online
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/expense/{id}/online", name="intranet_expense_online", options={"expose"=true})
     * @Security("is_granted('edit', userExpense)")
     */
    public function onlineAction(UserExpense $userExpense)
    {
        $userExpense->setStatus(1);
        $userExpense->setUserValidation($this->getUser());


        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userExpense);
        $em->flush();

        $this->addFlash(
            'success',
            'Note de frais du ' . $userExpense->getCreationDate()->format('d-m-Y H:i:s') . ' validé'
        );

        return $this->redirectToRoute('intranet_expense_homepage');
    }

    /**
     * Make a Expense offline
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/expense/{id}/offline", name="intranet_expense_offline", options={"expose"=true})
     * @Security("is_granted('edit', userExpense)")
     */
    public function offlineAction(UserExpense $userExpense)
    {
        $userExpense->setStatus(2);
        $userExpense->setUserValidation($this->getUser());

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userExpense);
        $em->flush();

        $this->addFlash(
            'success',
            'Note de frais du ' . $userExpense->getCreationDate()->format('d-m-Y H:i:s') . ' refusé'
        );

        return $this->redirectToRoute('intranet_expense_homepage');
    }

}
