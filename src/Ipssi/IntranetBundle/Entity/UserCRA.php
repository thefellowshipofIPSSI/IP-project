<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use UserBundle\Entity\User;


/**
 * UserCRA
 *
 * @ORM\Table(name="user_cra")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="projectName", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="activityReport", type="text")
     * @Assert\NotBlank()
     */
    private $activityReport;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginDate", type="datetime")
     * @Assert\Type("\DateTime")
     */
    private $beginDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     * @Assert\Type("\DateTime")
     */
    private $endDate;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", options={"default":0})
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="nbLostTimeAccident", type="integer", options={"default":0})
     */
    private $nbLostTimeAccident;

    /**
     * @var int
     *
     * @ORM\Column(name="nbNoneLostTimeAccident", type="integer", options={"default":0})
     */
    private $nbNoneLostTimeAccident;

    /**
     * @var int
     *
     * @ORM\Column(name="nbTravelAccident", type="integer", options={"default":0})
     */
    private $nbTravelAccident;

    /**
     * @var int
     *
     * @ORM\Column(name="nbSickDay", type="integer", options={"default":0})
     */
    private $nbSickDay;

    /**
     * @var int
     *
     * @ORM\Column(name="nbVacancyDay", type="integer", options={"default":0})
     */
    private $nbVacancyDay;

    /**
     * @var string
     *
     * @ORM\Column(name="clientSatisfaction", type="text")
     * @Assert\NotBlank()
     */
    private $clientSatisfaction;

    /**
     * @var string
     *
     * @ORM\Column(name="consultantSatisfaction", type="text")
     * @Assert\NotBlank()
     */
    private $consultantSatisfaction;

    /**
     * @var string
     *
     * @ORM\Column(name="ameliorationPoint", type="text")
     * @Assert\NotBlank()
     */
    private $ameliorationPoint;

    /**
     * @var string
     *
     * @ORM\Column(name="leftActivity", type="text", nullable=true)
     */
    private $leftActivity;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $client;

    /**
     * @var int
     *
     * @ORM\Column(name="client_validation", type="integer", nullable=true)
     */
    private $client_validation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="client_validation_date", type="datetime", nullable=true)
     */
    private $client_validation_date;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_cra")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_validation_cra")
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
            $this->setClientSatisfaction(0);
        }
    }


    /**
     * Is the given User the author of this CRA?
     *
     * @return bool
     */
    public function isCreator(User $user = null)
    {
        if ($user->getId() === $this->getUser()->getId()) {
            return true;
        } else {
            return false;
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
     * Set projectName
     *
     * @param string $projectName
     *
     * @return UserCRA
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set activityReport
     *
     * @param string $activityReport
     *
     * @return UserCRA
     */
    public function setActivityReport($activityReport)
    {
        $this->activityReport = $activityReport;

        return $this;
    }

    /**
     * Get activityReport
     *
     * @return string
     */
    public function getActivityReport()
    {
        return $this->activityReport;
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
     * @return integer
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
     * @return integer
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
     * @return integer
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
     * @return integer
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
     * @return integer
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
     * @return integer
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
     * Set client
     *
     * @param string $client
     *
     * @return UserCRA
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set clientValidation
     *
     * @param integer $clientValidation
     *
     * @return UserCRA
     */
    public function setClientValidation($clientValidation)
    {
        $this->client_validation = $clientValidation;

        return $this;
    }

    /**
     * Get clientValidation
     *
     * @return integer
     */
    public function getClientValidation()
    {
        return $this->client_validation;
    }

    /**
     * Set clientValidationDate
     *
     * @param \DateTime $clientValidationDate
     *
     * @return UserCRA
     */
    public function setClientValidationDate($clientValidationDate)
    {
        $this->client_validation_date = $clientValidationDate;

        return $this;
    }

    /**
     * Get clientValidationDate
     *
     * @return \DateTime
     */
    public function getClientValidationDate()
    {
        return $this->client_validation_date;
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

    /**
     * Set userValidation
     *
     * @param \UserBundle\Entity\User $userValidation
     *
     * @return UserCRA
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
