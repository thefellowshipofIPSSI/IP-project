<?php

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getByPseudo($pseudo)
    {

        $profile = $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM UserBundle:Profile p WHERE p.pseudo = :pseudo'
            )
            ->setParameter('pseudo', $pseudo)
            ->getOneOrNullResult();

        return $profile->getUser();
    }
}