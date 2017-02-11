<?php

namespace Ipssi\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * CV
 *
 * @ORM\Table(name="cv")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ipssi\JobBundle\Repository\CVRepository")
 * @Vich\Uploadable
 */
class CV
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
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"application/pdf"},
     *     mimeTypesMessage = "Le fichier doit être au format pdf")
     *
     * @Vich\UploadableField(mapping="cv", fileNameProperty="cvName")
     *
     * @var File
     */
    private $cvFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $cvName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="cv")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="user_validation_cv")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_validation;

    /**
     * @ORM\ManyToOne(targetEntity="Ipssi\IntranetBundle\Entity\Statut", inversedBy="cv")
     * @ORM\JoinColumn(name="statut_id", referencedColumnName="id", nullable=false)
     */
    private $statut;



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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return CV
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
     * @return CV
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
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return CV
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
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $cv
     *
     * @return Cv
     */
    public function setCvFile(File $cv = null)
    {
        $this->cvFile = $cv;

        if ($cv) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getCvFile()
    {
        return $this->cvFile;
    }

    /**
     * @param string $cvName
     *
     * @return Cv
     */
    public function setCvName($cvName)
    {
        $this->cvName = $cvName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCvName()
    {
        return $this->cvName;
    }

    /**
     * Set statut
     *
     * @param \Ipssi\IntranetBundle\Entity\Statut $statut
     *
     * @return CV
     */
    public function setStatut(\Ipssi\IntranetBundle\Entity\Statut $statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \Ipssi\IntranetBundle\Entity\Statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set userValidation
     *
     * @param \UserBundle\Entity\User $userValidation
     *
     * @return CV
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
