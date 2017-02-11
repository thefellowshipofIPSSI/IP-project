<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table(name="statut")
 * @ORM\Entity(repositoryClass="Ipssi\IntranetBundle\Repository\StatutRepository")
 */
class Statut
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserCRA", mappedBy="statut")
     */
    private $userCRA;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserVacation", mappedBy="statut")
     */
    private $userVacation;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserExpense", mappedBy="statut")
     */
    private $userExpense;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\JobBundle\Entity\CV", mappedBy="statut")
     */
    private $cv;


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
     * Set name
     *
     * @param string $name
     *
     * @return Statut
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
     * Constructor
     */
    public function __construct()
    {
        $this->userCRA = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add userCRA
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCRA $userCRA
     *
     * @return Statut
     */
    public function addUserCRA(\Ipssi\IntranetBundle\Entity\UserCRA $userCRA)
    {
        $this->userCRA[] = $userCRA;

        return $this;
    }

    /**
     * Remove userCRA
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCRA $userCRA
     */
    public function removeUserCRA(\Ipssi\IntranetBundle\Entity\UserCRA $userCRA)
    {
        $this->userCRA->removeElement($userCRA);
    }

    /**
     * Get userCRA
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserCRA()
    {
        return $this->userCRA;
    }

    /**
     * Add userVacation
     *
     * @param \Ipssi\IntranetBundle\Entity\UserVacation $userVacation
     *
     * @return Statut
     */
    public function addUserVacation(\Ipssi\IntranetBundle\Entity\UserVacation $userVacation)
    {
        $this->userVacation[] = $userVacation;

        return $this;
    }

    /**
     * Remove userVacation
     *
     * @param \Ipssi\IntranetBundle\Entity\UserVacation $userVacation
     */
    public function removeUserVacation(\Ipssi\IntranetBundle\Entity\UserVacation $userVacation)
    {
        $this->userVacation->removeElement($userVacation);
    }

    /**
     * Get userVacation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserVacation()
    {
        return $this->userVacation;
    }

    /**
     * Add userExpense
     *
     * @param \Ipssi\IntranetBundle\Entity\UserExpense $userExpense
     *
     * @return Statut
     */
    public function addUserExpense(\Ipssi\IntranetBundle\Entity\UserExpense $userExpense)
    {
        $this->userExpense[] = $userExpense;

        return $this;
    }

    /**
     * Remove userExpense
     *
     * @param \Ipssi\IntranetBundle\Entity\UserExpense $userExpense
     */
    public function removeUserExpense(\Ipssi\IntranetBundle\Entity\UserExpense $userExpense)
    {
        $this->userExpense->removeElement($userExpense);
    }

    /**
     * Get userExpense
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserExpense()
    {
        return $this->userExpense;
    }

    /**
     * Add cv
     *
     * @param \Ipssi\JobBundle\Entity\CV $cv
     *
     * @return Statut
     */
    public function addCv(\Ipssi\JobBundle\Entity\CV $cv)
    {
        $this->cv[] = $cv;

        return $this;
    }

    /**
     * Remove cv
     *
     * @param \Ipssi\JobBundle\Entity\CV $cv
     */
    public function removeCv(\Ipssi\JobBundle\Entity\CV $cv)
    {
        $this->cv->removeElement($cv);
    }

    /**
     * Get cv
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCv()
    {
        return $this->cv;
    }
}
