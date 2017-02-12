<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\PageTemplate;

class LoadPageTemplateData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pageTemplate = new PageTemplate();
        $pageTemplate->setName('accueil');

        $pageTemplate2 = new PageTemplate();
        $pageTemplate2->setName('pageSimple');

        $pageTemplate3 = new PageTemplate();
        $pageTemplate3->setName('actualites');

        $pageTemplate4 = new PageTemplate();
        $pageTemplate4->setName('contact');


        $manager->persist($pageTemplate);
        $manager->persist($pageTemplate2);
        $manager->persist($pageTemplate3);
        $manager->flush();

        $this->addReference('accueilT', $pageTemplate);
        $this->addReference('pageSimpleT', $pageTemplate2);
        $this->addReference('actualitesT', $pageTemplate3);
        $this->addReference('contactT', $pageTemplate4);

    }

    public function getOrder()
    {
        return 1;
    }
}