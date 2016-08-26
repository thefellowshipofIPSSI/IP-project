<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\PageCategory;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pageCategory = new PageCategory();
        $pageCategory->setTitle('Actualités');

        $pageCategory = new PageCategory();
        $pageCategory->setTitle('Mentions légales');

        $pageCategory = new PageCategory();
        $pageCategory->setTitle('Contact');

        $pageCategory = new PageCategory();
        $pageCategory->setTitle('Contact');

        $manager->persist($pageCategory);
        $manager->flush();
    }
}