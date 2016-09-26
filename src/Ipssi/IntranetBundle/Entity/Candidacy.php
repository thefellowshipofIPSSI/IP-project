<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Candidacy
 *
 * @ORM\Table(name="candidacy")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ipssi\IntranetBundle\Repository\CandidacyRepository")
 */
class Candidacy
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
     * @ORM\Column(name="freeText", type="text", nullable=true)
     */
    private $freeText;

    /**
     * @ORM\OneToOne(targetEntity="Ipssi\IntranetBundle\Entity\JobOffer")
     * @ORM\JoinColumn(nullable=true)
     */
    private $job_offer;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="candidacy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


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
        }
    }


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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Candidacy
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
     * @return Candidacy
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
     * Set freeText
     *
     * @param string $freeText
     *
     * @return Candidacy
     */
    public function setFreeText($freeText)
    {
        $this->freeText = $freeText;

        return $this;
    }

    /**
     * Get freeText
     *
     * @return string
     */
    public function getFreeText()
    {
        return $this->freeText;
    }

    /**
     * Set jobOffer
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $jobOffer
     *
     * @return Candidacy
     */
    public function setJobOffer(\Ipssi\IntranetBundle\Entity\JobOffer $jobOffer = null)
    {
        $this->job_offer = $jobOffer;

        return $this;
    }

    /**
     * Get jobOffer
     *
     * @return \Ipssi\IntranetBundle\Entity\JobOffer
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
     * @return Candidacy
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
