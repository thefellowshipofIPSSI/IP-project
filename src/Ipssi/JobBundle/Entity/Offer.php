<?php
/**
 * Created by PhpStorm.
 * User: devow
 * Date: 17/12/16
 * Time: 18:25
 */

namespace Ipssi\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="job_offer")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ipssi\JobBundle\Repository\OfferRepository")
 */
class Offer
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
     * @var
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var
     * @ORM\Column(name="contract", type="string", length=100)
     */
    private $contract;

    /**
     * @var
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var
     * @ORM\Column(name="duration", type="string", length=100, nullable=true)
     */
    private $duration;

    /**
     * @var
     * @ORM\Column(name="location", type="string", length=100)
     */
    private $location;

    /**
     * @var
     * @ORM\Column(name="salary", type="decimal", nullable=true)
     */
    private $salary;


    /**
     * @var
     * @ORM\Column(name="currency", type="string", length=15, nullable=true)
     */
    private $currency;


    /**
     * @var
     * @ORM\Column(name="begin_date", type="string", length=30)
     */
    private $beginDate;

    /**
     * @var
     * @ORM\Column(name="link", type="string", length=100, nullable=true)
     */
    private $link;

    /**
     * @var
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var
     * @ORM\Column(name="slug", type="string", length=30)
     */
    private $slug;

    /**
     * @var
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;


    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="updated_by", referencedColumnName="id")
     */
    private $updatedBy;


    /**
    * @ORM\ManyToOne(targetEntity="Society", inversedBy="offers")
    * @ORM\JoinColumn(name="society_id", referencedColumnName="id")
    */
    private $society;


    /**
     * @ORM\ManyToOne(targetEntity="JobType", inversedBy="offers")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;


    /**
     * @ORM\OneToMany(targetEntity="Candidacy", mappedBy="offer")
     */
    private $candidacies;


    /**
     * @ORM\ManyToMany(targetEntity="Skill", inversedBy="offers", cascade={"persist"})
     * @ORM\JoinTable(name="job_offers_skills")
     */
    private $skills;


    /**
     * Before persist or update, call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function onPrePersist()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->candidacies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Offer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set contract
     *
     * @param string $contract
     *
     * @return Offer
     */
    public function setContract($contract)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract
     *
     * @return string
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Offer
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
     * Set duration
     *
     * @param string $duration
     *
     * @return Offer
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
     * @return Offer
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
     * @return Offer
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
     * Set currency
     *
     * @param string $currency
     *
     * @return Offer
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set beginDate
     *
     * @param string $beginDate
     *
     * @return Offer
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Get beginDate
     *
     * @return string
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Offer
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Offer
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Offer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Offer
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdBy
     *
     * @param \UserBundle\Entity\User $createdBy
     *
     * @return Offer
     */
    public function setCreatedBy(\UserBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \UserBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \UserBundle\Entity\User $updatedBy
     *
     * @return Offer
     */
    public function setUpdatedBy(\UserBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \UserBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set society
     *
     * @param \Ipssi\JobBundle\Entity\Society $society
     *
     * @return Offer
     */
    public function setSociety(\Ipssi\JobBundle\Entity\Society $society = null)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return \Ipssi\JobBundle\Entity\Society
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * Set type
     *
     * @param \Ipssi\JobBundle\Entity\JobType $type
     *
     * @return Offer
     */
    public function setType(\Ipssi\JobBundle\Entity\JobType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Ipssi\JobBundle\Entity\JobType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add candidacy
     *
     * @param \Ipssi\JobBundle\Entity\Candidacy $candidacy
     *
     * @return Offer
     */
    public function addCandidacy(\Ipssi\JobBundle\Entity\Candidacy $candidacy)
    {
        $this->candidacies[] = $candidacy;

        return $this;
    }

    /**
     * Remove candidacy
     *
     * @param \Ipssi\JobBundle\Entity\Candidacy $candidacy
     */
    public function removeCandidacy(\Ipssi\JobBundle\Entity\Candidacy $candidacy)
    {
        $this->candidacies->removeElement($candidacy);
    }

    /**
     * Get candidacies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidacies()
    {
        return $this->candidacies;
    }

    /**
     * Add skill
     *
     * @param \Ipssi\JobBundle\Entity\Skill $skill
     *
     * @return Offer
     */
    public function addSkill(\Ipssi\JobBundle\Entity\Skill $skill)
    {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \Ipssi\JobBundle\Entity\Skill $skill
     */
    public function removeSkill(\Ipssi\JobBundle\Entity\Skill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Offer
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
