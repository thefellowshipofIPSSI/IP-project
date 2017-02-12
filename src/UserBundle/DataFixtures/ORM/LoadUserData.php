<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.password_encoder');

        $user = new User();
        $user->setUsername('admin');
        $user->setUsernameCanonical('admin');
        $user->setEmail('admin@ipssi.com');
        $user->addGroup($this->getReference('admin-group'));
        $user->setEnabled(1);

        $password = $encoder->encodePassword($user, 'secret');
        $user->setPassword($password);

        $manager->persist($user);

        $user2 = new User();
        $user2->setUsername('Redacteur');
        $user2->setUsernameCanonical('redacteur');
        $user2->setEmail('redacteur@ipssi.com');
        $user2->addGroup($this->getReference('redacteur-group'));
        $user2->setEnabled(1);

        $password2 = $encoder->encodePassword($user2, 'secret');
        $user2->setPassword($password2);


        $manager->persist($user2);


        $user3 = new User();
        $user3->setUsername('Collaborateur');
        $user3->setUsernameCanonical('collaborateur');
        $user3->setEmail('collaborateur@ipssi.com');
        $user3->addGroup($this->getReference('collaborateur-group'));
        $user3->setEnabled(1);

        $password3 = $encoder->encodePassword($user3, 'secret');
        $user3->setPassword($password3);

        $manager->persist($user3);

        $user7 = new User();
        $user7->setUsername('Collaborateur2');
        $user7->setUsernameCanonical('collaborateur2');
        $user7->setEmail('collaborateur2@ipssi.com');
        $user7->addGroup($this->getReference('collaborateur-group'));
        $user7->setEnabled(1);

        $password7 = $encoder->encodePassword($user7, 'secret');
        $user7->setPassword($password7);

        $manager->persist($user7);

        $user4 = new User();
        $user4->setUsername('RH');
        $user4->setUsernameCanonical('rh');
        $user4->setEmail('rh@ipssi.com');
        $user4->addGroup($this->getReference('rh-group'));
        $user4->setEnabled(1);

        $password4 = $encoder->encodePassword($user4, 'secret');
        $user4->setPassword($password4);

        $manager->persist($user4);

        $user5 = new User();
        $user5->setUsername('Manager');
        $user5->setUsernameCanonical('manager');
        $user5->setEmail('manager@ipssi.com');
        $user5->addGroup($this->getReference('manager-group'));
        $user5->setEnabled(1);

        $password5 = $encoder->encodePassword($user5, 'secret');
        $user5->setPassword($password5);

        $manager->persist($user5);

        $user6 = new User();
        $user6->setUsername('Superviseur');
        $user6->setUsernameCanonical('superviseur');
        $user6->setEmail('superviseur@ipssi.com');
        $user6->addGroup($this->getReference('superviseur-group'));
        $user6->setEnabled(1);

        $password6 = $encoder->encodePassword($user6, 'secret');
        $user6->setPassword($password6);

        $manager->persist($user6);

        $user8 = new User();
        $user8->setUsername('Jean-Michel');
        $user8->setUsernameCanonical('Durand');
        $user8->setEmail('user@ipssi.com');
        $user8->setEnabled(1);

        $password8 = $encoder->encodePassword($user8, 'secret');
        $user8->setPassword($password8);

        $manager->persist($user8);
        
        
        
        $manager->flush();

        $this->addReference('admin-user', $user);
        $this->addReference('redacteur-user', $user2);
        $this->addReference('collaborateur-user', $user3);
        $this->addReference('collaborateur2-user', $user7);
        $this->addReference('rh-user', $user4);
        $this->addReference('manager-user', $user5);
        $this->addReference('superviseur-user', $user6);
        $this->addReference('base-user', $user8);
    }

    public function getOrder()
    {
        return 2;
    }
}