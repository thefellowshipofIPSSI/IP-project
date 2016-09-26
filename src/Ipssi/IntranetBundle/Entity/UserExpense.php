<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserExpense
 *
 * @ORM\Table(name="user_expense")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ipssi\IntranetBundle\Repository\UserExpenseRepository")
 */
class UserExpense
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validationDate", type="datetime", nullable=true)
     */
    private $validationDate;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_expense")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_validation_expense")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_validation;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\ExpenseLine", mappedBy="user_expense")
     * @ORM\JoinColumn(nullable=true)
     */
    private $expense_line;


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
        $this->expense_line = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return UserExpense
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
     * @return UserExpense
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
     * Set title
     *
     * @param string $title
     *
     * @return UserExpense
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
     * Set description
     *
     * @param string $description
     *
     * @return UserExpense
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
     * Set beginDate
     *
     * @param \DateTime $beginDate
     *
     * @return UserExpense
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
     * @return UserExpense
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
     * Set status
     *
     * @param integer $status
     *
     * @return UserExpense
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
     * Set validationDate
     *
     * @param \DateTime $validationDate
     *
     * @return UserExpense
     */
    public function setValidationDate($validationDate)
    {
        $this->validationDate = $validationDate;

        return $this;
    }

    /**
     * Get validationDate
     *
     * @return \DateTime
     */
    public function getValidationDate()
    {
        return $this->validationDate;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return UserExpense
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
     * @return UserExpense
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

    /**
     * Add expenseLine
     *
     * @param \Ipssi\IntranetBundle\Entity\ExpenseLine $expenseLine
     *
     * @return UserExpense
     */
    public function addExpenseLine(\Ipssi\IntranetBundle\Entity\ExpenseLine $expenseLine)
    {
        $this->expense_line[] = $expenseLine;

        return $this;
    }

    /**
     * Remove expenseLine
     *
     * @param \Ipssi\IntranetBundle\Entity\ExpenseLine $expenseLine
     */
    public function removeExpenseLine(\Ipssi\IntranetBundle\Entity\ExpenseLine $expenseLine)
    {
        $this->expense_line->removeElement($expenseLine);
    }

    /**
     * Get expenseLine
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpenseLine()
    {
        return $this->expense_line;
    }
}
