<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\JobBundle\Entity\JobType as Job;

class JobData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $job = new Job();
        $job->setName('Data scientist');
        $job->setStatus(1);
        //$job->setUser($this->getReference('admin-user'));

        $job2 = new Job();
        $job2->setName('Web developer');
        $job2->setStatus(1);
        //$job2->setUser($this->getReference('admin-user'));

        $job3 = new Job();
        $job3->setName('CTO');
        $job3->setStatus(1);
        //$job3->setUser($this->getReference('admin-user'));

        $job4 = new Job();
        $job4->setName('Pen tester');
        $job4->setStatus(1);
        //$job4->setUser($this->getReference('admin-user'));

        $job5 = new Job();
        $job5->setName('Security expert');
        $job5->setStatus(1);
        //$job5->setUser($this->getReference('admin-user'));

        $job6 = new Job();
        $job6->setName('Community manager');
        $job6->setStatus(1);
        //$job6->setUser($this->getReference('admin-user'));


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