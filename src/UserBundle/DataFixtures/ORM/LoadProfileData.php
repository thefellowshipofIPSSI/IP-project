<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\Profile;

class LoadProfileData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $profileAdmin = new Profile();
        $profileAdmin->setUser($this->getReference('admin-user'));
        $profileAdmin->setPseudo('AdminPseudo');
        $profileAdmin->setFirstname('AdminFristName');
        $profileAdmin->setLastname('AdminLastName');
        $profileAdmin->setPhone('04 00 00 00 00');
        $profileAdmin->setAddress('00 rue de l\'admin');
        $profileAdmin->setBirthDate(new \DateTime('2016-12-25'));
        $profileAdmin->setOther('Others');

        $manager->persist($profileAdmin);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}