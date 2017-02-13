<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use Ipssi\IntranetBundle\Entity\ExpenseLine;

class ExpenseLineData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $ExpenseLine = new ExpenseLine();
        $ExpenseLine->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine->setType('Dépense');
        $ExpenseLine->setDescription('Déjeuné');
        $ExpenseLine->setPrix(30);
        $ExpenseLine->setUserExpense($this->getReference('userExpense'));
        $manager->persist($ExpenseLine);

        $ExpenseLine2 = new ExpenseLine();
        $ExpenseLine2->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine2->setType('Dépense');
        $ExpenseLine2->setDescription('Déjeuné');
        $ExpenseLine2->setPrix(3);
        $ExpenseLine2->setUserExpense($this->getReference('userExpense'));
        $manager->persist($ExpenseLine2);

        $ExpenseLine3 = new ExpenseLine();
        $ExpenseLine3->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine3->setType('Dépense');
        $ExpenseLine3->setDescription('Déjeuné');
        $ExpenseLine3->setPrix(36);
        $ExpenseLine3->setUserExpense($this->getReference('userExpense'));
        $manager->persist($ExpenseLine3);

        $ExpenseLine4 = new ExpenseLine();
        $ExpenseLine4->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine4->setType('Dépense');
        $ExpenseLine4->setDescription('Déjeuné');
        $ExpenseLine4->setPrix(50);
        $ExpenseLine4->setUserExpense($this->getReference('userExpense'));
        $manager->persist($ExpenseLine4);

        $ExpenseLine5 = new ExpenseLine();
        $ExpenseLine5->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine5->setType('Dépense');
        $ExpenseLine5->setDescription('Déjeuné');
        $ExpenseLine5->setPrix(150);
        $ExpenseLine5->setUserExpense($this->getReference('userExpense'));
        $manager->persist($ExpenseLine5);




        $ExpenseLine = new ExpenseLine();
        $ExpenseLine->setExpenseLineDate(new \DateTime('now - 3 days'));
        $ExpenseLine->setType('Dépense');
        $ExpenseLine->setDescription('Déjeuné');
        $ExpenseLine->setPrix(10);
        $ExpenseLine->setUserExpense($this->getReference('userExpense2'));
        $manager->persist($ExpenseLine);

        $ExpenseLine4 = new ExpenseLine();
        $ExpenseLine4->setExpenseLineDate(new \DateTime('now - 3 days'));
        $ExpenseLine4->setType('Essence');
        $ExpenseLine4->setDescription('Essence');
        $ExpenseLine4->setPrix(3);
        $ExpenseLine4->setUserExpense($this->getReference('userExpense2'));
        $manager->persist($ExpenseLine4);

        $ExpenseLine5 = new ExpenseLine();
        $ExpenseLine5->setExpenseLineDate(new \DateTime('now - 3 days'));
        $ExpenseLine5->setType('Réparation');
        $ExpenseLine5->setDescription('Réparation');
        $ExpenseLine5->setPrix(90);
        $ExpenseLine5->setUserExpense($this->getReference('userExpense2'));
        $manager->persist($ExpenseLine5);




        $ExpenseLine = new ExpenseLine();
        $ExpenseLine->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine->setType('Dépense');
        $ExpenseLine->setDescription('Déjeuné');
        $ExpenseLine->setPrix(30);
        $ExpenseLine->setUserExpense($this->getReference('userExpense3'));
        $manager->persist($ExpenseLine);

        $ExpenseLine4 = new ExpenseLine();
        $ExpenseLine4->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine4->setType('Essence');
        $ExpenseLine4->setDescription('Essence');
        $ExpenseLine4->setPrix(26);
        $ExpenseLine4->setUserExpense($this->getReference('userExpense3'));
        $manager->persist($ExpenseLine4);

        $ExpenseLine5 = new ExpenseLine();
        $ExpenseLine5->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine5->setType('Réparation');
        $ExpenseLine5->setDescription('Réparation');
        $ExpenseLine5->setPrix(450);
        $ExpenseLine5->setUserExpense($this->getReference('userExpense3'));
        $manager->persist($ExpenseLine5);



        $ExpenseLine = new ExpenseLine();
        $ExpenseLine->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine->setType('Dépense');
        $ExpenseLine->setDescription('Déjeuné');
        $ExpenseLine->setPrix(3000);
        $ExpenseLine->setUserExpense($this->getReference('userExpense4'));
        $manager->persist($ExpenseLine);

        $ExpenseLine4 = new ExpenseLine();
        $ExpenseLine4->setExpenseLineDate(new \DateTime('now - 30 days'));
        $ExpenseLine4->setType('Essence');
        $ExpenseLine4->setDescription('Essence');
        $ExpenseLine4->setPrix(32);
        $ExpenseLine4->setUserExpense($this->getReference('userExpense4'));
        $manager->persist($ExpenseLine4);

        
        $manager->flush();

//        $this->setReference('userCRA', $ExpenseLine);
    }

    public function getOrder()
    {
        return 4;
    }
}