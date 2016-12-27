<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\JobBundle\Entity\Skill;

class SkillData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $skill = new Skill();
        $skill->setName('Php');

        $skill2 = new Skill();
        $skill2->setName('SQL');

        $skill3 = new Skill();
        $skill3->setName('Symfony3');

        $manager->persist($skill);
        $manager->persist($skill2);
        $manager->persist($skill3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}