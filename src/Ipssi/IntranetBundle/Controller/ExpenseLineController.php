<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\ExpenseLine;

use Ipssi\IntranetBundle\Form\ExpenseLineType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;

class ExpenseLineController extends Controller {


    /**
     * Create a new expense line
     * @param $expense_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction($expense_id, Request $request) {
        $expenseLine = new ExpenseLine;

        $userExpenseRepo = $this->get('intranet.repository.expense');
        $userExpense = $userExpenseRepo->find($expense_id);

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

            return $this->redirectToRoute('intranet_expense_view', array('expense_id' => $expense_id));

        }

        return $this->render('IntranetBundle:UserExpense/ExpenseLine:create.html.twig', [
            'form' => $form->createView(),
            'expense_id' => $expense_id
        ]);
    }


    /**
     * Update existing expense line
     * @param $expenseLine_id
     * @param $expense_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($expenseLine_id, $expense_id, Request $request)
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

            return $this->redirectToRoute('intranet_expense_view', array('expense_id' => $expense_id));

        }

        return $this->render('IntranetBundle:UserExpense/ExpenseLine:update.html.twig', [
            'form' => $form->createView(),
            'expense_id' => $expense_id
        ]);

    }

    /**
     * Delete an expense line
     * @param $expenseLine_id
     * @param $expense_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($expenseLine_id, $expense_id)
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

        return $this->redirectToRoute('intranet_expense_view', array('expense_id' => $expense_id));
    }

}
