<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
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

        $user = new User();
        $user->setUsername('admin');
        $user->setUsernameCanonical('adminCanonical');
        $user->setEmail('admin@ipssi.com');
        $user->setEnabled(1);

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'secret');
        $user->setPassword($password);


        $manager->persist($user);
        $manager->flush();
    }
}