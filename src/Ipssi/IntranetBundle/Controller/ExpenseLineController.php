<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\ExpenseLine;
use Ipssi\IntranetBundle\Entity\UserExpense;

use Ipssi\IntranetBundle\Form\ExpenseLineType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;

class ExpenseLineController extends Controller {


    /**
     * Create a new expense line
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(UserExpense $userExpense, Request $request) {
        $expenseLine = new ExpenseLine;

        $form = $this->createForm(ExpenseLineType::class, $expenseLine);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $expenseLine = $form->getData();
            $expenseLine->setUserExpense($userExpense);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($expenseLine);
            $em->flush();

            $this->addFlash(
                'success',
                'Nouvelle ligne créée !'
            );

            return $this->redirectToRoute('intranet_expense_view', array('id' => $userExpense->getId()));

        }

        return $this->render('IntranetBundle:UserExpense/ExpenseLine:create.html.twig', [
            'form' => $form->createView(),
            'userExpense' => $userExpense
        ]);
    }


    /**
     * Update existing expense line
     * @param $expenseLine_id
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($expenseLine_id, UserExpense $userExpense, Request $request)
    {
        $expenseLineRepo = $this->get('intranet.repository.expense_line');
        $expenseLine = $expenseLineRepo->find($expenseLine_id);

        $form = $this->createForm(ExpenseLineType::class, $expenseLine);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $expenseLine = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($expenseLine);
            $em->flush();

            $this->addFlash(
                'success',
                'La ligne a bien été modifiée !'
            );

            return $this->redirectToRoute('intranet_expense_view', array('id' => $userExpense->getId()));

        }

        return $this->render('IntranetBundle:UserExpense/ExpenseLine:update.html.twig', [
            'form' => $form->createView(),
            'userExpense' => $userExpense
        ]);

    }

    /**
     * Delete an expense line
     * @param $expenseLine_id
     * @param $userExpense
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($expenseLine_id, UserExpense $userExpense)
    {
        $expenseLineRepo = $this->get('intranet.repository.expense_line');

        $expenseLine = $expenseLineRepo->find($expenseLine_id);

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($expenseLine);
        $em->flush();

        $this->addFlash(
            'success',
            'Ligne supprimée'
        );

        return $this->redirectToRoute('intranet_expense_view', array('id' => $userExpense->getId()));
    }

}
