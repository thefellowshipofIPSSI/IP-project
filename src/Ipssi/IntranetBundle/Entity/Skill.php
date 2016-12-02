<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="Ipssi\IntranetBundle\Repository\SkillRepository")
 */
class Skill
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * Offer which request the Skill
     * @ORM\ManyToMany(targetEntity="Ipssi\IntranetBundle\Entity\JobOffer", mappedBy="skills")
     */
    private $job_offers;

    /**
     * Users who have the Skill
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="skills")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->job_offers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Skill
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add jobOffer
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $jobOffer
     *
     * @return Skill
     */
    public function addJobOffer(\Ipssi\IntranetBundle\Entity\JobOffer $jobOffer)
    {
        $this->job_offers[] = $jobOffer;

        return $this;
    }

    /**
     * Remove jobOffer
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $jobOffer
     */
    public function removeJobOffer(\Ipssi\IntranetBundle\Entity\JobOffer $jobOffer)
    {
        $this->job_offers->removeElement($jobOffer);
    }

    /**
     * Get jobOffers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobOffers()
    {
        return $this->job_offers;
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Skill
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
