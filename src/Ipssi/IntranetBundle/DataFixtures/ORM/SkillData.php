<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\Skill;

class SkillData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $skill = new Skill();
        $skill->setTitle('Php');
        $skill->setUser($this->getId('1'));

        $skill2 = new Skill();
        $skill2->setTitle('SQL');
        $skill2->setUser($this->getId('1'));

        $skill3 = new Skill();
        $skill3->setTitle('Symfony3');
        $skill3->setUser($this->getId('1'));

        $manager->persist($skill);
        $manager->persist($skill2);
        $manager->persist($skill3);

        $manager->flush();
    }
}