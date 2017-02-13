<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use Ipssi\IntranetBundle\Entity\UserExpense;

class UserExpenseData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userExpense = new UserExpense();
        $userExpense->setTitle('Intervention chez Martin');
        $userExpense->setDescription('Inter chez Mr Martin');
        $userExpense->setBeginDate(new \DateTime('now - 30 days'));
        $userExpense->setEndDate(new \DateTime('now - 29 days'));
        $userExpense->setUser($this->getReference('collaborateur-user'));
        $userExpense->setStatut($this->getReference('attente'));

        $manager->persist($userExpense);

        $userExpense2 = new UserExpense();
        $userExpense2->setTitle('Déplacement');
        $userExpense2->setDescription('Déplacement');
        $userExpense2->setBeginDate(new \DateTime('now - 3 days'));
        $userExpense2->setEndDate(new \DateTime('now'));
        $userExpense2->setUser($this->getReference('collaborateur-user'));
        $userExpense2->setUserValidation($this->getReference('admin-user'));
        $userExpense2->setStatut($this->getReference('refuse'));

        $manager->persist($userExpense2);

        $userExpense3 = new UserExpense();
        $userExpense3->setTitle('Intervention chez Martin');
        $userExpense3->setDescription('Inter chez Mr Martin');
        $userExpense3->setBeginDate(new \DateTime('now - 30 days'));
        $userExpense3->setEndDate(new \DateTime('now - 29 days'));
        $userExpense3->setUser($this->getReference('collaborateur-user'));
        $userExpense3->setUserValidation($this->getReference('admin-user'));
        $userExpense3->setStatut($this->getReference('valide'));

        $manager->persist($userExpense3);

        $userExpense4 = new UserExpense();
        $userExpense4->setTitle('Intervention chez Martin');
        $userExpense4->setDescription('Inter chez Mr Martin');
        $userExpense4->setBeginDate(new \DateTime('now - 30 days'));
        $userExpense4->setEndDate(new \DateTime('now - 29 days'));
        $userExpense4->setUser($this->getReference('collaborateur2-user'));
        $userExpense4->setUserValidation($this->getReference('admin-user'));
        $userExpense4->setStatut($this->getReference('refuse'));

        $manager->persist($userExpense4);

        $manager->flush();

        $this->setReference('userExpense', $userExpense);
        $this->setReference('userExpense2', $userExpense2);
        $this->setReference('userExpense3', $userExpense3);
        $this->setReference('userExpense4', $userExpense4);
    }

    public function getOrder()
    {
        return 3;
    }
}