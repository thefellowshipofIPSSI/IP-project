<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\JobBundle\Entity\Skill;
use Ipssi\JobBundle\Entity\SkillType;

class SkillData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $skillType = new SkillType();
        $skillType->setName('Informatique');


        $skillType2 = new SkillType();
        $skillType2->setName('Organisation');

        $skillType3 = new SkillType();
        $skillType3->setName('Big Data');

        $skill = new Skill();
        $skill->setName('Php');
        $skill->setType($skillType);

        $skill2 = new Skill();
        $skill2->setName('SQL');
        $skill2->setType($skillType);

        $skill3 = new Skill();
        $skill3->setName('Symfony3');
        $skill3->setType($skillType);

        $skill4 = new Skill();
        $skill4->setName('Data Mining');
        $skill4->setType($skillType3);


        $skill5 = new Skill();
        $skill5->setName('POO');
        $skill5->setType($skillType);

        $skill6 = new Skill();
        $skill6->setName('Linux');
        $skill6->setType($skillType);
        
        $manager->persist($skillType);
        $manager->persist($skillType2);

        $manager->persist($skill);
        $manager->persist($skill2);
        $manager->persist($skill3);

        $manager->flush();


        $this->setReference('php-skill', $skill);
        $this->setReference('sql-skill', $skill2);
        $this->setReference('symfony-skill', $skill3);
        $this->setReference('data-mining-skill', $skill4);
        $this->setReference('poo-skill', $skill5);
        $this->setReference('linux-skill', $skill6);

    }

    public function getOrder()
    {
        return 1;
    }
}