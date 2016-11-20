<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\Job;

class JobData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $job = new Job();
        $job->setTitle('Data scientist');
        $job->setUser($this->getReference('admin-user'));

        $job2 = new Job();
        $job2->setTitle('Web developer');
        $job2->setUser($this->getReference('admin-user'));

        $job3 = new Job();
        $job3->setTitle('CTO');
        $job3->setUser($this->getReference('admin-user'));

        $job4 = new Job();
        $job4->setTitle('Pen tester');
        $job4->setUser($this->getReference('admin-user'));

        $job5 = new Job();
        $job5->setTitle('Security expert');
        $job5->setUser($this->getReference('admin-user'));

        $job6 = new Job();
        $job6->setTitle('Community manager');
        $job6->setUser($this->getReference('admin-user'));


        $manager->persist($job);
        $manager->persist($job2);
        $manager->persist($job3);
        $manager->persist($job4);
        $manager->persist($job5);
        $manager->persist($job6);
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}