<?php

namespace Ipssi\JobBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Ipssi\JobBundle\Interfaces\FrontRepositoryInterace;


class OfferRepository extends EntityRepository implements FrontRepositoryInterace
{

    public function findAllOnline()
    {
        return $this->findBy(['status' => 1]);
    }

    public function findBySlug($slug)
    {
        return $this->findOneBy(['slug' => $slug, 'status' => 1]);
    }

}