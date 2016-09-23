<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\Society;

class SocietyData implements FixtureInterface
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
        $society->setAddress('Menlo Park');
        $society->setZipcode('MP 20065');
        $society->setCity('Menlo Park');

        $society3 = new Society();
        $society3->setName('Microsoft');
        $society->setAddress('Redmond');
        $society->setZipcode('RM 70036');
        $society->setCity('Redmond');

        $society4 = new Society();
        $society4->setName('Pornhub');
        $society->setAddress('XXX');
        $society->setZipcode('66666');
        $society->setCity('New York');


        $manager->persist($society);
        $manager->persist($society2);
        $manager->persist($society3);
        $manager->persist($society4);

        $manager->flush();
    }
}