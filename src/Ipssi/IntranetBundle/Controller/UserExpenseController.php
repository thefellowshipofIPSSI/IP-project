<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\UserExpense;

use Ipssi\IntranetBundle\Form\UserExpenseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class UserExpenseController extends Controller {

    /**
     * List all Expense in table
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/expense", name="intranet_expense_homepage")
     */
    public function indexAction() {

        $allUserExpenses = $this->get('intranet.repository.expense')->findAll();

        return $this->render('IntranetBundle:UserExpense:index.html.twig', [
            'allUserExpenses' => $allUserExpenses
        ]);
    }

    /**
     * Create a new Expense
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/expense/create", name="intranet_expense_create")
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
     * @Route("/expense/{id}/update", name="intranet_expense_update")
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
     * @Route("/expense/{id}/delete", name="intranet_expense_delete")
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
     * @Route("/expense/{id}/view", name="intranet_expense_view")
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
     * Make a Expense online
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/expense/{id}/online", name="intranet_expense_online")
     */
    public function onlineAction(UserExpense $userExpense)
    {
        $userExpense->setStatus(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userExpense);
        $em->flush();

        $this->addFlash(
            'success',
            'Note de frais du ' . $userExpense->getCreationDate()->format('d-m-Y H:i:s') . ' mis en ligne'
        );

        return $this->redirectToRoute('intranet_expense_homepage');
    }

    /**
     * Make a Expense offline
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/expense/{id}/offline", name="intranet_expense_offline")
     */
    public function offlineAction(UserExpense $userExpense)
    {
        $userExpense->setStatus(0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userExpense);
        $em->flush();

        $this->addFlash(
            'success',
            'Note de frais du ' . $userExpense->getCreationDate()->format('d-m-Y H:i:s') . ' n\'est plus visible sur le site !'
        );

        return $this->redirectToRoute('intranet_expense_homepage');
    }

}
