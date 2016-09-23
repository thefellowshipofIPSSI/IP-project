<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserCRA
 *
 * @ORM\Table(name="user_cra")
 * @ORM\Entity(repositoryClass="Ipssi\IntranetBundle\Repository\UserCRARepository")
 */
class UserCRA
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
     * @var int
     *
     * @ORM\Column(name="nbLostTimeAccident", type="integer")
     */
    private $nbLostTimeAccident;

    /**
     * @var int
     *
     * @ORM\Column(name="nbNoneLostTimeAccident", type="integer")
     */
    private $nbNoneLostTimeAccident;

    /**
     * @var int
     *
     * @ORM\Column(name="nbTravelAccident", type="integer")
     */
    private $nbTravelAccident;

    /**
     * @var int
     *
     * @ORM\Column(name="nbSickDay", type="integer")
     */
    private $nbSickDay;

    /**
     * @var int
     *
     * @ORM\Column(name="nbVacancyDay", type="integer")
     */
    private $nbVacancyDay;

    /**
     * @var string
     *
     * @ORM\Column(name="clientSatisfaction", type="text")
     */
    private $clientSatisfaction;

    /**
     * @var string
     *
     * @ORM\Column(name="consultantSatisfaction", type="text")
     */
    private $consultantSatisfaction;

    /**
     * @var string
     *
     * @ORM\Column(name="ameliorationPoint", type="text")
     */
    private $ameliorationPoint;

    /**
     * @var string
     *
     * @ORM\Column(name="leftActivity", type="text")
     */
    private $leftActivity;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_cra")
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return UserCRA
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
     * @return UserCRA
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
     * @return UserCRA
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
     * @return UserCRA
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
     * @return UserCRA
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
     * @return UserCRA
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
     * @return UserCRA
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set nbLostTimeAccident
     *
     * @param integer $nbLostTimeAccident
     *
     * @return UserCRA
     */
    public function setNbLostTimeAccident($nbLostTimeAccident)
    {
        $this->nbLostTimeAccident = $nbLostTimeAccident;

        return $this;
    }

    /**
     * Get nbLostTimeAccident
     *
     * @return int
     */
    public function getNbLostTimeAccident()
    {
        return $this->nbLostTimeAccident;
    }

    /**
     * Set nbNoneLostTimeAccident
     *
     * @param integer $nbNoneLostTimeAccident
     *
     * @return UserCRA
     */
    public function setNbNoneLostTimeAccident($nbNoneLostTimeAccident)
    {
        $this->nbNoneLostTimeAccident = $nbNoneLostTimeAccident;

        return $this;
    }

    /**
     * Get nbNoneLostTimeAccident
     *
     * @return int
     */
    public function getNbNoneLostTimeAccident()
    {
        return $this->nbNoneLostTimeAccident;
    }

    /**
     * Set nbTravelAccident
     *
     * @param integer $nbTravelAccident
     *
     * @return UserCRA
     */
    public function setNbTravelAccident($nbTravelAccident)
    {
        $this->nbTravelAccident = $nbTravelAccident;

        return $this;
    }

    /**
     * Get nbTravelAccident
     *
     * @return int
     */
    public function getNbTravelAccident()
    {
        return $this->nbTravelAccident;
    }

    /**
     * Set nbSickDay
     *
     * @param integer $nbSickDay
     *
     * @return UserCRA
     */
    public function setNbSickDay($nbSickDay)
    {
        $this->nbSickDay = $nbSickDay;

        return $this;
    }

    /**
     * Get nbSickDay
     *
     * @return int
     */
    public function getNbSickDay()
    {
        return $this->nbSickDay;
    }

    /**
     * Set nbVacancyDay
     *
     * @param integer $nbVacancyDay
     *
     * @return UserCRA
     */
    public function setNbVacancyDay($nbVacancyDay)
    {
        $this->nbVacancyDay = $nbVacancyDay;

        return $this;
    }

    /**
     * Get nbVacancyDay
     *
     * @return int
     */
    public function getNbVacancyDay()
    {
        return $this->nbVacancyDay;
    }

    /**
     * Set clientSatisfaction
     *
     * @param string $clientSatisfaction
     *
     * @return UserCRA
     */
    public function setClientSatisfaction($clientSatisfaction)
    {
        $this->clientSatisfaction = $clientSatisfaction;

        return $this;
    }

    /**
     * Get clientSatisfaction
     *
     * @return string
     */
    public function getClientSatisfaction()
    {
        return $this->clientSatisfaction;
    }

    /**
     * Set consultantSatisfaction
     *
     * @param string $consultantSatisfaction
     *
     * @return UserCRA
     */
    public function setConsultantSatisfaction($consultantSatisfaction)
    {
        $this->consultantSatisfaction = $consultantSatisfaction;

        return $this;
    }

    /**
     * Get consultantSatisfaction
     *
     * @return string
     */
    public function getConsultantSatisfaction()
    {
        return $this->consultantSatisfaction;
    }

    /**
     * Set ameliorationPoint
     *
     * @param string $ameliorationPoint
     *
     * @return UserCRA
     */
    public function setAmeliorationPoint($ameliorationPoint)
    {
        $this->ameliorationPoint = $ameliorationPoint;

        return $this;
    }

    /**
     * Get ameliorationPoint
     *
     * @return string
     */
    public function getAmeliorationPoint()
    {
        return $this->ameliorationPoint;
    }

    /**
     * Set leftActivity
     *
     * @param string $leftActivity
     *
     * @return UserCRA
     */
    public function setLeftActivity($leftActivity)
    {
        $this->leftActivity = $leftActivity;

        return $this;
    }

    /**
     * Get leftActivity
     *
     * @return string
     */
    public function getLeftActivity()
    {
        return $this->leftActivity;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return UserCRA
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return UserCRA
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
