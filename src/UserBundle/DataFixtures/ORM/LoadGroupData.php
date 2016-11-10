<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use UserBundle\Entity\Group;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $group = new Group('Administrateur');
        $group->addRole('ROLE_SUPER_ADMIN');

        $manager->persist($group);

        $group2 = new Group('Superviseur');
        $group2->addRole('ROLE_SUPERVISEUR');

        $manager->persist($group2);


        $group3 = new Group('Manager');
        $group3->addRole('ROLE_MANAGER');

        $manager->persist($group3);

        $group4 = new Group('RH');
        $group4->addRole('ROLE_RH');

        $manager->persist($group4);

        $group5 = new Group('Collaborateur');
        $group5->addRole('ROLE_REDACTEUR');

        $manager->persist($group5);

        $group6 = new Group('Rédacteur');
        $group6->addRole('ROLE_USER');

        $manager->persist($group6);

        $manager->flush();

        $this->addReference('admin-group', $group);
        $this->addReference('superviseur-group', $group2);
        $this->addReference('manager-group', $group3);
        $this->addReference('rh-group', $group4);
        $this->addReference('collaborateur-group', $group5);
        $this->addReference('redacteur-group', $group6);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}