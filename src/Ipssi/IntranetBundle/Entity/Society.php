<?php

namespace Ipssi\IntranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Society
 *
 * @ORM\Table(name="society")
 * @ORM\Entity(repositoryClass="Ipssi\IntranetBundle\Repository\SocietyRepository")
 */
class Society
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
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=255)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * Job Offers for the Society
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\JobOffer", mappedBy="society")
     */
    private $jobOffers;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->job_offers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Society
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
     * Set address
     *
     * @param string $address
     *
     * @return Society
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return Society
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Society
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Add jobOffer
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $jobOffer
     *
     * @return Society
     */
    public function addJobOffer(\Ipssi\IntranetBundle\Entity\JobOffer $jobOffer)
    {
        $this->job_offers[] = $jobOffer;

        return $this;
    }

    /**
     * Remove jobOffer
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $jobOffer
     */
    public function removeJobOffer(\Ipssi\IntranetBundle\Entity\JobOffer $jobOffer)
    {
        $this->job_offers->removeElement($jobOffer);
    }

    /**
     * Get jobOffers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobOffers()
    {
        return $this->job_offers;
    }
}
