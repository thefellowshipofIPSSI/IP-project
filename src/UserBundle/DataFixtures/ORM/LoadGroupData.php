<?php

//namespace UserBundle\DataFixtures\ORM;
//
//use Doctrine\Common\DataFixtures\AbstractFixture;
//use Doctrine\Common\DataFixtures\FixtureInterface;
//use Doctrine\Common\Persistence\ObjectManager;
//use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
//use UserBundle\Entity\Group;
//
//class LoadGroupData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
//{
//    public function load(ObjectManager $manager)
//    {
//
//        $group = new Group('Administrateur');
//        $group->addRole('ROLE_SUPER_ADMIN');
//
//        $manager->persist($group);
//
//        $group2 = new Group('Superviseur');
//        $group2->setName('Superviseur');
//
//        $manager->persist($group2);
//
//
//        $group3 = new Group('Manager';
//        $group3->setName('Manager');
//
//        $manager->persist($group3);
//
//        $group4 = new Group('RH');
//        $group4->setName('RH');
//
//        $manager->persist($group4);
//
//        $group5 = new Group('Collaborateur');
//        $group5->setName('Collaborateur');
//
//        $manager->persist($group5);
//
//        $group6 = new Group('Rédacteur');
//        $group6->setName('Rédacteur');
//
//        $manager->persist($group6);
//
//        $manager->flush();
//
//        $this->addReference('admin-group', $group);
//        $this->addReference('superviseur-group', $group2);
//        $this->addReference('manager-group', $group3);
//        $this->addReference('rh-group', $group4);
//        $this->addReference('collaborateur-group', $group5);
//        $this->addReference('redacteur-group', $group6);
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function getOrder()
//    {
//        return 1;
//    }
//}