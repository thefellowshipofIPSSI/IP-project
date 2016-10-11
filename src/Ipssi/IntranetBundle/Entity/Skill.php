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
     * @ORM\ManyToMany(targetEntity="Ipssi\IntranetBundle\Entity\JobOffer", mappedBy="skill")
     */
    private $job_offer;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="skill")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    /**
     * Get id
     *
     * @return int
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
     * Constructor
     */
    public function __construct()
    {
        $this->job_offer = new \Doctrine\Common\Collections\ArrayCollection();
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
        $this->job_offer[] = $jobOffer;

        return $this;
    }

    /**
     * Remove jobOffer
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $jobOffer
     */
    public function removeJobOffer(\Ipssi\IntranetBundle\Entity\JobOffer $jobOffer)
    {
        $this->job_offer->removeElement($jobOffer);
    }

    /**
     * Get jobOffer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobOffer()
    {
        return $this->job_offer;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Skill
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
