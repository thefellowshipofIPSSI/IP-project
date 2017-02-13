<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use Ipssi\IntranetBundle\Entity\UserVacation;

class UserVacationData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userVacation = new UserVacation();
        $userVacation->setBeginDate(new \DateTime('now - 30 days'));
        $userVacation->setEndDate(new \DateTime('now - 29 days'));
        $userVacation->setNbDays(5);
        $userVacation->setComment('Vacances Noel');
        $userVacation->setUser($this->getReference('collaborateur-user'));
        $userVacation->setStatut($this->getReference('attente'));

        $manager->persist($userVacation);

        $userVacation2 = new UserVacation();
        $userVacation2->setBeginDate(new \DateTime('now - 30 days'));
        $userVacation2->setEndDate(new \DateTime('now - 29 days'));
        $userVacation2->setNbDays(2);
        $userVacation2->setComment('Vacances');
        $userVacation2->setUser($this->getReference('collaborateur-user'));
        $userVacation2->setStatut($this->getReference('refuse'));

        $manager->persist($userVacation2);

        $userVacation3 = new UserVacation();
        $userVacation3->setBeginDate(new \DateTime('now - 30 days'));
        $userVacation3->setEndDate(new \DateTime('now - 29 days'));
        $userVacation3->setNbDays(30);
        $userVacation3->setComment('Eté');
        $userVacation3->setUser($this->getReference('collaborateur-user'));
        $userVacation3->setStatut($this->getReference('valide'));

        $manager->persist($userVacation3);

        $userVacation4 = new UserVacation();
        $userVacation4->setBeginDate(new \DateTime('now - 30 days'));
        $userVacation4->setEndDate(new \DateTime('now - 29 days'));
        $userVacation4->setNbDays(3);
        $userVacation4->setComment('Vacances Noel');
        $userVacation4->setUser($this->getReference('collaborateur2-user'));
        $userVacation4->setStatut($this->getReference('refuse'));

        $manager->persist($userVacation4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}