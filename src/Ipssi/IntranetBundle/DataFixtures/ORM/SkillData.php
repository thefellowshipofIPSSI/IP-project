<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\Skill;

class SkillData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $skill = new Skill();
        $skill->setTitle('Php');
        $skill->setUser($this->getReference('admin-user'));

        $skill2 = new Skill();
        $skill2->setTitle('SQL');
        $skill2->setUser($this->getReference('admin-user'));

        $skill3 = new Skill();
        $skill3->setTitle('Symfony3');
        $skill3->setUser($this->getReference('admin-user'));

        $manager->persist($skill);
        $manager->persist($skill2);
        $manager->persist($skill3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}