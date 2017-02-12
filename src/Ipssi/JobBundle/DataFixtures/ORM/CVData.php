<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\JobBundle\Entity\CV;

class CVData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $cv = new CV();

        $cv->setCvName('example-cv-developpeur.pdf');
        $cv->setUser($this->getReference('base-user'));
        $cv->setStatut($this->getReference('attente'));


        $manager->persist($cv);

        $manager->flush();

        $this->setReference('example-cv', $cv);
    }

    public function getOrder()
    {
        return 11;
    }
}