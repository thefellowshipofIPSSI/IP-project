<?php



namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=15, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var Date
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     */
    private $birthDate;


    public function __construct()
    {
        parent::__construct();
        $this->page = new \Doctrine\Common\Collections\ArrayCollection();
        $this->news = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\Page", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $page;


    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\News", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $news;

    

    /**
     * Add page
     *
     * @param \Ipssi\IntranetBundle\Entity\Page $page
     *
     * @return User
     */
    public function addPage(\Ipssi\IntranetBundle\Entity\Page $page)
    {
        $this->page[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \Ipssi\IntranetBundle\Entity\Page $page
     */
    public function removePage(\Ipssi\IntranetBundle\Entity\Page $page)
    {
        $this->page->removeElement($page);
    }

    /**
     * Get page
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Add news
     *
     * @param \Ipssi\IntranetBundle\Entity\News $news
     *
     * @return User
     */
    public function addNews(\Ipssi\IntranetBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \Ipssi\IntranetBundle\Entity\News $news
     */
    public function removeNews(\Ipssi\IntranetBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
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
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
}
