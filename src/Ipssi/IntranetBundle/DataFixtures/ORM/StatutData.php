<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\Statut;

class StatutData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $statut = new Statut();
        $statut->setName('En attente');

        $statut2 = new Statut();
        $statut2->setName('Validé');

        $statut3 = new Statut();
        $statut3->setName('Refusé');

        $manager->persist($statut);
        $manager->persist($statut2);
        $manager->persist($statut3);

        $manager->flush();

        $this->addReference('attente', $statut);
        $this->addReference('valide', $statut2);
        $this->addReference('refuse', $statut3);
    }

    public function getOrder()
    {
        return 1;
    }
}