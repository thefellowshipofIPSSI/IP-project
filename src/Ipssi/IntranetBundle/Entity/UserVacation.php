<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserVacation
 *
 * @ORM\Table(name="user_vacation")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ipssi\IntranetBundle\Repository\UserVacationRepository")
 */
class UserVacation
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
     * @var \DateTime
     *
     * @ORM\Column(name="beginDate", type="datetime")
     */
    private $beginDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var int
     *
     * @ORM\Column(name="nbDays", type="integer")
     */
    private $nbDays;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_vacation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_validation_vacation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_validation;


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
     * @return UserVacation
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
     * @return UserVacation
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
     * Set beginDate
     *
     * @param \DateTime $beginDate
     *
     * @return UserVacation
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Get beginDate
     *
     * @return \DateTime
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return UserVacation
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set nbDays
     *
     * @param integer $nbDays
     *
     * @return UserVacation
     */
    public function setNbDays($nbDays)
    {
        $this->nbDays = $nbDays;

        return $this;
    }

    /**
     * Get nbDays
     *
     * @return integer
     */
    public function getNbDays()
    {
        return $this->nbDays;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return UserVacation
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return UserVacation
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
     * @return UserVacation
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
     * Set userValidation
     *
     * @param \UserBundle\Entity\User $userValidation
     *
     * @return UserVacation
     */
    public function setUserValidation(\UserBundle\Entity\User $userValidation = null)
    {
        $this->user_validation = $userValidation;

        return $this;
    }

    /**
     * Get userValidation
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserValidation()
    {
        return $this->user_validation;
    }
}
