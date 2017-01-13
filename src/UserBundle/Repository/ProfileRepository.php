<?php

namespace UserBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ProfileRepository extends EntityRepository
{
    /**
     * Update only differents attributes between 2 profiles versions
     * @param Profile $before
     * @param Profile $after
     * @return Profile
     */
    public function updateCandidateProfile($before, $after, $em)
    {
        $cols = $em->getClassMetadata(get_class($before))->getColumnNames();
        $values = array();
        foreach($cols as $col){

            if(strstr($col, '_')) {
                $array = explode('_', $col);
                ucfirst($array[1]);
                $col = implode($array);
            }

            $getter = 'get'.ucfirst($col);
            $setter = 'set'.ucfirst($col);

            if($after->$getter() !== NULL && $before->$getter() !== $after->$getter()) {
                $before->$setter($after->$getter());
            }
        }

        return $before;
    }
}