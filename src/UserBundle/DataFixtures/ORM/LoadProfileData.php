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

        $profileRedacteur = new Profile();
        $profileRedacteur->setUser($this->getReference('redacteur-user'));
        $profileRedacteur->setPseudo('RedacteurPseudo');
        $profileRedacteur->setFirstname('RedacteurFristName');
        $profileRedacteur->setLastname('RedacteurLastName');
        $profileRedacteur->setPhone('04 00 00 00 00');
        $profileRedacteur->setAddress('00 rue du Redacteur');
        $profileRedacteur->setBirthDate(new \DateTime('2016-12-25'));
        $profileRedacteur->setOther('Others');

        $manager->persist($profileRedacteur);

        $profileCollaborateur = new Profile();
        $profileCollaborateur->setUser($this->getReference('collaborateur-user'));
        $profileCollaborateur->setPseudo('CollaborateurPseudo');
        $profileCollaborateur->setFirstname('CollaborateurFristName');
        $profileCollaborateur->setLastname('CollaborateurLastName');
        $profileCollaborateur->setPhone('04 00 00 00 00');
        $profileCollaborateur->setAddress('00 rue du Collaborateur');
        $profileCollaborateur->setBirthDate(new \DateTime('2016-12-25'));
        $profileCollaborateur->setOther('Others');

        $manager->persist($profileCollaborateur);

        $profileCollaborateur2 = new Profile();
        $profileCollaborateur2->setUser($this->getReference('collaborateur2-user'));
        $profileCollaborateur2->setPseudo('Collaborateur2Pseudo');
        $profileCollaborateur2->setFirstname('Collaborateur2FristName');
        $profileCollaborateur2->setLastname('Collaborateur2LastName');
        $profileCollaborateur2->setPhone('04 00 00 00 00');
        $profileCollaborateur2->setAddress('00 rue du Collaborateur2');
        $profileCollaborateur2->setBirthDate(new \DateTime('2016-12-25'));
        $profileCollaborateur2->setOther('Others');

        $manager->persist($profileCollaborateur2);

        $profileRH = new Profile();
        $profileRH->setUser($this->getReference('rh-user'));
        $profileRH->setPseudo('RHPseudo');
        $profileRH->setFirstname('RHFristName');
        $profileRH->setLastname('RHLastName');
        $profileRH->setPhone('04 00 00 00 00');
        $profileRH->setAddress('00 rue du RH');
        $profileRH->setBirthDate(new \DateTime('2016-12-25'));
        $profileRH->setOther('Others');

        $manager->persist($profileRH);

        $profileManager = new Profile();
        $profileManager->setUser($this->getReference('manager-user'));
        $profileManager->setPseudo('ManagerPseudo');
        $profileManager->setFirstname('ManagerFristName');
        $profileManager->setLastname('ManagerLastName');
        $profileManager->setPhone('04 00 00 00 00');
        $profileManager->setAddress('00 rue du Manager');
        $profileManager->setBirthDate(new \DateTime('2016-12-25'));
        $profileManager->setOther('Others');

        $manager->persist($profileManager);

        $profileSuperviseur = new Profile();
        $profileSuperviseur->setUser($this->getReference('superviseur-user'));
        $profileSuperviseur->setPseudo('SuperviseurPseudo');
        $profileSuperviseur->setFirstname('SuperviseurFristName');
        $profileSuperviseur->setLastname('SuperviseurLastName');
        $profileSuperviseur->setPhone('04 00 00 00 00');
        $profileSuperviseur->setAddress('00 rue du superviseur');
        $profileSuperviseur->setBirthDate(new \DateTime('2016-12-25'));
        $profileSuperviseur->setOther('Others');

        $manager->persist($profileSuperviseur);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}