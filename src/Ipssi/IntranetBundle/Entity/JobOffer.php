<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobOffer
 *
 * @ORM\Table(name="job_offer")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ipssi\IntranetBundle\Repository\JobOfferRepository")
 */
class JobOffer
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
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modificationDate", type="datetime", nullable=true)
     */
    private $modificationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="salary", type="string", length=255)
     */
    private $salary;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="job_offer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="candidacy")
     */
    private $users;

    /**
     * @ORM\OneToOne(targetEntity="Ipssi\IntranetBundle\Entity\Job", inversedBy="job_offer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $job;

    /**
     * @ORM\OneToOne(targetEntity="Ipssi\IntranetBundle\Entity\Society", inversedBy="job_offer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $society;

    /**
     * @ORM\ManyToMany(targetEntity="Ipssi\IntranetBundle\Entity\Skill", inversedBy="job_offer")
     * @ORM\JoinTable(name="job_offer_skill")
     */
    private $skill;

    /**
     * Before persist or update, call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function onPrePersist()
    {
        $this->setModificationDate(new \DateTime('now'));

        if($this->getCreationDate() == null)
        {
            $this->setCreationDate(new \DateTime('now'));
            $this->setStatus(0);
        }
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skill = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return JobOffer
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set modificationDate
     *
     * @param \DateTime $modificationDate
     *
     * @return JobOffer
     */
    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }

    /**
     * Get modificationDate
     *
     * @return \DateTime
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return JobOffer
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return JobOffer
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set salary
     *
     * @param string $salary
     *
     * @return JobOffer
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return JobOffer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return JobOffer
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return JobOffer
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

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return JobOffer
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

    /**
     * Set job
     *
     * @param \Ipssi\IntranetBundle\Entity\Job $job
     *
     * @return JobOffer
     */
    public function setJob(\Ipssi\IntranetBundle\Entity\Job $job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return \Ipssi\IntranetBundle\Entity\Job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set society
     *
     * @param \Ipssi\IntranetBundle\Entity\Society $society
     *
     * @return JobOffer
     */
    public function setSociety(\Ipssi\IntranetBundle\Entity\Society $society)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return \Ipssi\IntranetBundle\Entity\Society
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * Add skill
     *
     * @param \Ipssi\IntranetBundle\Entity\Skill $skill
     *
     * @return JobOffer
     */
    public function addSkill(\Ipssi\IntranetBundle\Entity\Skill $skill)
    {
        $this->skill[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \Ipssi\IntranetBundle\Entity\Skill $skill
     */
    public function removeSkill(\Ipssi\IntranetBundle\Entity\Skill $skill)
    {
        $this->skill->removeElement($skill);
    }

    /**
     * Get skill
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
