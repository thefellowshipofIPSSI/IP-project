<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
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
        $user->setUsernameCanonical('adminCanonical');
        $user->setEmail('admin@ipssi.com');
        $user->setEnabled(1);

        $password = $encoder->encodePassword($user, 'secret');
        $user->setPassword($password);

        $manager->persist($user);

        $user2 = new User();
        $user2->setUsername('User1');
        $user2->setUsernameCanonical('user1Canonical');
        $user2->setEmail('user1@ipssi.com');
        $user2->setEnabled(1);

        $password2 = $encoder->encodePassword($user2, 'secret');
        $user2->setPassword($password2);


        $manager->persist($user2);


        $user3 = new User();
        $user3->setUsername('User2');
        $user3->setUsernameCanonical('user2Canonical');
        $user3->setEmail('user2@ipssi.com');
        $user3->setEnabled(1);

        $password3 = $encoder->encodePassword($user3, 'secret');
        $user3->setPassword($password3);

        $manager->persist($user3);


        $manager->flush();

        $this->addReference('admin-user', $user);
    }

    public function getOrder()
    {
        return 1;
    }
}