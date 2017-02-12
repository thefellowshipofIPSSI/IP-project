<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\JobBundle\Entity\Candidacy;

class CandidacyData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $candidacy = new Candidacy();
        $candidacy->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet euismod massa. Vestibulum ullamcorper dictum nibh, at sodales urna vestibulum quis. Aenean hendrerit ligula est. Donec ut congue ligula. In mollis sagittis nisi eu volutpat. Vivamus at ullamcorper tellus. Aenean suscipit ac nulla aliquet gravida. Aliquam eu nibh facilisis, varius eros in, dictum massa. Integer ante dolor, sagittis dapibus auctor vitae, sodales at lectus. In rutrum a velit vel mollis. Quisque dignissim lacus sit amet metus lacinia dapibus. Duis vel risus in velit feugiat tincidunt et tempus purus. Morbi suscipit egestas sem eget feugiat. Donec blandit at mi eu tempus. Mauris volutpat elementum ultricies. Morbi non ante vestibulum, consequat felis eu, dapibus lectus. ");
        $candidacy->setStatus($this->getReference('attente'));
        $candidacy->setOffer($this->getReference('dev-symfony-offer'));
        $candidacy->setCandidate($this->getReference('base-user'));
        $candidacy->setCv($this->getReference('example-cv'));


        $manager->persist($candidacy);
        $manager->flush();
    }

    public function getOrder()
    {
        return 12;
    }
}