<?php


namespace Ipssi\JobBundle\Interfaces;


interface FrontRepositoryInterace
{

    /**
     * Find all entities online
     * @return Entity
     */
    public function findAllOnline();


    /**
     * Find entity by slug
     * @return Entity
     */
    public function findBySlug($slug);
}