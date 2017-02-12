<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ipssi\JobBundle\Entity\Society;

class SocietyData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $society = new Society();
        $society->setName('Google');
        $society->setAddress('75 Ninth Avenue 2nd');
        $society->setZipcode('NY 10011');
        $society->setCity('New York');

        $society2 = new Society();
        $society2->setName('Facebook');
        $society2->setAddress('Menlo Park');
        $society2->setZipcode('MP 20065');
        $society2->setCity('Menlo Park');

        $society3 = new Society();
        $society3->setName('Microsoft');
        $society3->setAddress('Redmond');
        $society3->setZipcode('RM 70036');
        $society3->setCity('Redmond');

        $manager->persist($society);
        $manager->persist($society2);
        $manager->persist($society3);

        $manager->flush();

        $this->setReference('google-society', $society);
        $this->setReference('facebook-society', $society2);
        $this->setReference('microsoft-society', $society3);

    }

    public function getOrder()
    {
        return 8;
    }

}