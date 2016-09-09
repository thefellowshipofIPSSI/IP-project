<?php

namespace Ipssi\IntranetBundle\Repository;

/**
 * NewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends \Doctrine\ORM\EntityRepository
{

    public function findBySlug($slug)
    {
        return $this->findOneBy(['slug' => $slug]);
    }
}
