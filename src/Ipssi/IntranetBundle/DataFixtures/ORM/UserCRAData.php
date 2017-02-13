<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use Ipssi\IntranetBundle\Entity\UserCRA;

class UserCRAData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $userCRA = new UserCRA();
        $userCRA->setProjectName('Informatique');
        $userCRA->setActivityReport('Informatique');
        $userCRA->setBeginDate(new \DateTime('now - 30 days'));
        $userCRA->setEndDate(new \DateTime('now'));
        $userCRA->setNbLostTimeAccident(1);
        $userCRA->setNbNoneLostTimeAccident(2);
        $userCRA->setNbTravelAccident(0);
        $userCRA->setNbSickDay(3);
        $userCRA->setNbVacancyDay(5);
        $userCRA->setClientSatisfaction('Très satisfait');
        $userCRA->setConsultantSatisfaction('Très satisfait');
        $userCRA->setAmeliorationPoint('Rien');
        $userCRA->setLeftActivity('Tout est fini');
        $userCRA->setComments('');
        $userCRA->setClient('Monsieur test test@test.com');
        $userCRA->setClientValidation(1);
        $userCRA->setClientValidationDate(new \DateTime('now'));
        $userCRA->setUser($this->getReference('collaborateur-user'));
        $userCRA->setStatut($this->getReference('attente'));

        $manager->persist($userCRA);

        $userCRA2 = new UserCRA();
        $userCRA2->setProjectName('Test');
        $userCRA2->setActivityReport('test');
        $userCRA2->setBeginDate(new \DateTime('now - 30 days'));
        $userCRA2->setEndDate(new \DateTime('now'));
        $userCRA2->setNbLostTimeAccident(1);
        $userCRA2->setNbNoneLostTimeAccident(2);
        $userCRA2->setNbTravelAccident(0);
        $userCRA2->setNbSickDay(3);
        $userCRA2->setNbVacancyDay(5);
        $userCRA2->setClientSatisfaction('Très satisfait');
        $userCRA2->setConsultantSatisfaction('Très satisfait');
        $userCRA2->setAmeliorationPoint('Rien');
        $userCRA2->setLeftActivity('Tout est fini');
        $userCRA2->setComments('');
        $userCRA2->setClient('Client');
        $userCRA2->setClientValidation(1);
        $userCRA2->setClientValidationDate(new \DateTime('now'));
        $userCRA2->setUser($this->getReference('collaborateur-user'));
        $userCRA2->setStatut($this->getReference('attente'));

        $manager->persist($userCRA2);

        $userCRA3 = new UserCRA();
        $userCRA3->setProjectName('Informatique');
        $userCRA3->setActivityReport('Informatique');
        $userCRA3->setBeginDate(new \DateTime('now - 30 days'));
        $userCRA3->setEndDate(new \DateTime('now'));
        $userCRA3->setNbLostTimeAccident(1);
        $userCRA3->setNbNoneLostTimeAccident(2);
        $userCRA3->setNbTravelAccident(0);
        $userCRA3->setNbSickDay(3);
        $userCRA3->setNbVacancyDay(5);
        $userCRA3->setClientSatisfaction('Très satisfait');
        $userCRA3->setConsultantSatisfaction('Très satisfait');
        $userCRA3->setAmeliorationPoint('Rien');
        $userCRA3->setLeftActivity('Tout est fini');
        $userCRA3->setComments('');
        $userCRA3->setClient('Martin Durand');
        $userCRA3->setClientValidation(1);
        $userCRA3->setClientValidationDate(new \DateTime('now'));
        $userCRA3->setUser($this->getReference('collaborateur-user'));
        $userCRA3->setUserValidation($this->getReference('admin-user'));
        $userCRA3->setStatut($this->getReference('refuse'));

        $manager->persist($userCRA3);

        $userCRA4 = new UserCRA();
        $userCRA4->setProjectName('Informatique');
        $userCRA4->setActivityReport('Informatique');
        $userCRA4->setBeginDate(new \DateTime('now - 30 days'));
        $userCRA4->setEndDate(new \DateTime('now'));
        $userCRA4->setNbLostTimeAccident(1);
        $userCRA4->setNbNoneLostTimeAccident(2);
        $userCRA4->setNbTravelAccident(0);
        $userCRA4->setNbSickDay(3);
        $userCRA4->setNbVacancyDay(5);
        $userCRA4->setClientSatisfaction('Très satisfait');
        $userCRA4->setConsultantSatisfaction('Très satisfait');
        $userCRA4->setAmeliorationPoint('Rien');
        $userCRA4->setLeftActivity('Tout est fini');
        $userCRA4->setComments('');
        $userCRA4->setClient('Monsieur test test@test.com');
        $userCRA4->setClientValidation(1);
        $userCRA4->setClientValidationDate(new \DateTime('now'));
        $userCRA4->setUser($this->getReference('collaborateur2-user'));
        $userCRA4->setUserValidation($this->getReference('admin-user'));
        $userCRA4->setStatut($this->getReference('valide'));

        $manager->persist($userCRA4);

        $manager->flush();

        $this->setReference('userCRA', $userCRA);
    }

    public function getOrder()
    {
        return 3;
    }
}