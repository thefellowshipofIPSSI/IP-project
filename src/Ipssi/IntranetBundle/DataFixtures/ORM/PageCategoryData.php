<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\PageCategory;

class LoadPageCategoryData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pageCategory = new PageCategory();
        $pageCategory->setName('Le groupe');

        $pageCategory2 = new PageCategory();
        $pageCategory2->setName('L\'activité');

        $pageCategory3 = new PageCategory();
        $pageCategory3->setName('Nous rejoindre');

        $pageCategory4 = new PageCategory();
        $pageCategory4->setName('Espace collaborateur');

        $pageCategory5 = new PageCategory();
        $pageCategory5->setName('Contact');

        $pageCategory6 = new PageCategory();
        $pageCategory6->setName('Autre');


        $manager->persist($pageCategory);
        $manager->persist($pageCategory2);
        $manager->persist($pageCategory3);
        $manager->persist($pageCategory4);
        $manager->persist($pageCategory5);
        $manager->persist($pageCategory6);
        $manager->flush();
    }
}