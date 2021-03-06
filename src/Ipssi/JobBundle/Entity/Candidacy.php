<?php

namespace Ipssi\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * News
 *
 * @ORM\Table(name="job_candidacy")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ipssi\JobBundle\Repository\CandidacyRepository")
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
     * @var
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Ipssi\IntranetBundle\Entity\Statut", inversedBy="candidacies")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false)
     */
    private $status;

    /**
     * @var
     * @ORM\Column(name="decision", type="text", nullable=true)
     */
    private $decision;


    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="updated_by", referencedColumnName="id")
     */
    private $updatedBy;


    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="closed_by", referencedColumnName="id")
     */
    private $closedBy;

    /**
     * @var
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


    /**
     * @ORM\ManyToOne(targetEntity="Offer", inversedBy="candidacies")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     */
    private $offer;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="candidacies")
     * @ORM\JoinColumn(name="candidate_id", referencedColumnName="id")
     */
    private $candidate;


    /**
     * @ORM\OneToOne(targetEntity="Ipssi\JobBundle\Entity\CV")
     * @ORM\JoinColumn(name="cv_id", referencedColumnName="id")
     */
    private $cv;


    /**
     * Before persist or update, call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function onPrePersist()
    {
        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime('now'));
        } else {
            if($this->getUpdatedAt() == null) {
                $this->setUpdatedAt(new \DateTime('now'));
            }
        }
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
     * Set content
     *
     * @param string $content
     *
     * @return Candidacy
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }



    /**
     * Set decision
     *
     * @param string $decision
     *
     * @return Candidacy
     */
    public function setDecision($decision)
    {
        $this->decision = $decision;

        return $this;
    }

    /**
     * Get decision
     *
     * @return string
     */
    public function getDecision()
    {
        return $this->decision;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Candidacy
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
     * @return Candidacy
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
     * Set closedBy
     *
     * @param \UserBundle\Entity\User $closedBy
     *
     * @return Candidacy
     */
    public function setClosedBy(\UserBundle\Entity\User $closedBy = null)
    {
        $this->closedBy = $closedBy;

        return $this;
    }

    /**
     * Get closedBy
     *
     * @return \UserBundle\Entity\User
     */
    public function getClosedBy()
    {
        return $this->closedBy;
    }

    /**
     * Set updatedBy
     *
     * @param \UserBundle\Entity\User $updatedBy
     *
     * @return Candidacy
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
     * Set offer
     *
     * @param \Ipssi\JobBundle\Entity\Offer $offer
     *
     * @return Candidacy
     */
    public function setOffer(\Ipssi\JobBundle\Entity\Offer $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \Ipssi\JobBundle\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }



    /**
     * Set candidate
     *
     * @param \UserBundle\Entity\User $candidate
     *
     * @return Candidacy
     */
    public function setCandidate(\UserBundle\Entity\User $candidate = null)
    {
        $this->candidate = $candidate;

        return $this;
    }

    /**
     * Get candidate
     *
     * @return \UserBundle\Entity\User
     */
    public function getCandidate()
    {
        return $this->candidate;
    }


    /**
     * Set cv
     *
     * @param \Ipssi\JobBundle\Entity\CV $cv
     *
     * @return Candidacy
     */
    public function setCv(\Ipssi\JobBundle\Entity\CV $cv = null)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return \Ipssi\JobBundle\Entity\CV
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set status
     *
     * @param \Ipssi\IntranetBundle\Entity\Statut $status
     *
     * @return Candidacy
     */
    public function setStatus(\Ipssi\IntranetBundle\Entity\Statut $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Ipssi\IntranetBundle\Entity\Statut
     */
    public function getStatus()
    {
        return $this->status;
    }
}
