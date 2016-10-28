<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ipssi\IntranetBundle\Entity\Society;

class SocietyData implements OrderedFixtureInterface
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

        $society4 = new Society();
        $society4->setName('Pornhub');
        $society4->setAddress('XXX');
        $society4->setZipcode('66666');
        $society4->setCity('New York');


        $manager->persist($society);
        $manager->persist($society2);
        $manager->persist($society3);
        $manager->persist($society4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }

}