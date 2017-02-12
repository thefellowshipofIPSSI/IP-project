<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\PageCategory;

class LoadPageCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pageCategory = new PageCategory();
        $pageCategory->setName('Le groupe');
        $pageCategory->setParent(null);


        $pageCategory2 = new PageCategory();
        $pageCategory2->setName('L\'activité');

        $pageCategory3 = new PageCategory();
        $pageCategory3->setName('Nous rejoindre');


        $pageCategory5 = new PageCategory();
        $pageCategory5->setName('Contact');

        $pageCategory6 = new PageCategory();
        $pageCategory6->setName('Autre');

        $pageCategory7 = new PageCategory();
        $pageCategory7->setName('Accueil');


        $manager->persist($pageCategory);
        $manager->persist($pageCategory2);
        $manager->persist($pageCategory3);
        $manager->persist($pageCategory5);
        $manager->persist($pageCategory6);
        $manager->persist($pageCategory7);

        $this->addReference('groupe', $pageCategory);
        $this->addReference('activite', $pageCategory2);
        $this->addReference('rejoindre', $pageCategory3);
        $this->addReference('contact', $pageCategory5);
        $this->addReference('autre', $pageCategory6);
        $this->addReference('accueil', $pageCategory7);


        $pageCategory8 = new PageCategory();
        $pageCategory8->setName('Présentation');
        $pageCategory8->setParent($this->getReference('groupe'));

        $pageCategory9 = new PageCategory();
        $pageCategory9->setName('Chiffres clés');
        $pageCategory9->setParent($this->getReference('groupe'));

        $pageCategory10 = new PageCategory();
        $pageCategory10->setName('Notre expertise');
        $pageCategory10->setParent($this->getReference('groupe'));

        $pageCategory11 = new PageCategory();
        $pageCategory11->setName('Les valeurs du groupe');
        $pageCategory11->setParent($this->getReference('groupe'));



        $pageCategory12 = new PageCategory();
        $pageCategory12->setName('Nos métiers');
        $pageCategory12->setParent($this->getReference('activite'));

        $pageCategory13 = new PageCategory();
        $pageCategory13->setName('Nos secteurs d\'activité');
        $pageCategory13->setParent($this->getReference('activite'));

        $pageCategory14 = new PageCategory();
        $pageCategory14->setName('Ils nous font confiance');
        $pageCategory14->setParent($this->getReference('activite'));



        $pageCategory15 = new PageCategory();
        $pageCategory15->setName('Les postes à pourvoir');
        $pageCategory15->setParent($this->getReference('rejoindre'));

        $pageCategory16 = new PageCategory();
        $pageCategory16->setName('Postuler');
        $pageCategory16->setParent($this->getReference('rejoindre'));


        $manager->persist($pageCategory8);
        $manager->persist($pageCategory9);
        $manager->persist($pageCategory10);
        $manager->persist($pageCategory11);

        $manager->persist($pageCategory12);
        $manager->persist($pageCategory13);
        $manager->persist($pageCategory14);

        $manager->persist($pageCategory15);
        $manager->persist($pageCategory16);

        $manager->flush();


        $this->addReference('presentation', $pageCategory8);
        $this->addReference('chiffres', $pageCategory9);
        $this->addReference('expertise', $pageCategory10);
        $this->addReference('valeurs', $pageCategory11);

        $this->addReference('metiers', $pageCategory12);
        $this->addReference('secteurs', $pageCategory13);
        $this->addReference('confiance', $pageCategory14);

        $this->addReference('postes', $pageCategory15);
        $this->addReference('pourvoir', $pageCategory16);


    }

    public function getOrder()
    {
        return 1;
    }
}