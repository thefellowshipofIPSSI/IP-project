<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserCV
 *
 * @ORM\Table(name="user_cv")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ipssi\IntranetBundle\Repository\UserCVRepository")
 */
class UserCV
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_cv")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_validation_cv")
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
     * Set path
     *
     * @param string $path
     *
     * @return UserCV
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return UserCV
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
     * @return UserCV
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
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return UserCV
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
     * @return UserCV
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
