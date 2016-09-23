<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\Job;

class JobData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $job = new Job();
        $job->setTitle('Data scientist');
        $job->setUser($this->getId('1'));

        $job2 = new Job();
        $job2->setTitle('Web developer');
        $job2->setUser($this->getId('1'));

        $job3 = new Job();
        $job3->setTitle('CTO');
        $job3->setUser($this->getId('1'));

        $job4 = new Job();
        $job4->setTitle('Pen tester');
        $job4->setUser($this->getId('1'));

        $job5 = new Job();
        $job5->setTitle('Security expert');
        $job5->setUser($this->getId('1'));

        $job6 = new Job();
        $job6->setTitle('Community manager');
        $job6->setUser($this->getId('1'));


        $manager->persist($job);
        $manager->persist($job2);
        $manager->persist($job3);
        $manager->persist($job4);
        $manager->persist($job5);
        $manager->persist($job6);
        $manager->flush();
    }
}