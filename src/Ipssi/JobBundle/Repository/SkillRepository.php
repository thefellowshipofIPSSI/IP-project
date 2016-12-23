<?php

namespace Ipssi\JobBundle\Repository;


use Doctrine\ORM\EntityRepository;


class SkillRepository extends EntityRepository
{
    public function allNamesToArray()
    {
        $skills = $this->createQueryBuilder('s')
            ->select('s.name')
            ->orderBy('s.name')
            ->getQuery()
            ->getArrayResult();

        $array = array();

        foreach($skills as $key => $val) {
            $array[] = $val['name'];
        }



        return json_encode($array);
    }


}