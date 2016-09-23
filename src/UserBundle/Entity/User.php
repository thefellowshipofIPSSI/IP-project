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
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserExpense", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_expense;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserCRA", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_cra;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\Job", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $job;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\JobOffer", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $job_offer;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\Skill", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $skill;

    /**
     * @ORM\ManyToMany(targetEntity="Ipssi\IntranetBundle\Entity\JobOffer", inversedBy="users")
     * @ORM\JoinTable(name="users_candidaty")
     */
    private $candidacy;


    public function __construct()
    {
        parent::__construct();
        $this->page = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->user_expense = new ArrayCollection();
        $this->job = new ArrayCollection();
        $this->job_offer = new ArrayCollection();
        $this->skill = new ArrayCollection();
        $this->candidacy = new ArrayCollection();
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
     * Add userExpense
     *
     * @param \Ipssi\IntranetBundle\Entity\UserExpense $userExpense
     *
     * @return User
     */
    public function addUserExpense(\Ipssi\IntranetBundle\Entity\UserExpense $userExpense)
    {
        $this->user_expense[] = $userExpense;

        return $this;
    }

    /**
     * Remove userExpense
     *
     * @param \Ipssi\IntranetBundle\Entity\UserExpense $userExpense
     */
    public function removeUserExpense(\Ipssi\IntranetBundle\Entity\UserExpense $userExpense)
    {
        $this->user_expense->removeElement($userExpense);
    }

    /**
     * Get userExpense
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserExpense()
    {
        return $this->user_expense;
    }

    /**
     * Add userCra
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCRA $userCra
     *
     * @return User
     */
    public function addUserCra(\Ipssi\IntranetBundle\Entity\UserCRA $userCra)
    {
        $this->user_cra[] = $userCra;

        return $this;
    }

    /**
     * Remove userCra
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCRA $userCra
     */
    public function removeUserCra(\Ipssi\IntranetBundle\Entity\UserCRA $userCra)
    {
        $this->user_cra->removeElement($userCra);
    }

    /**
     * Get userCra
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserCra()
    {
        return $this->user_cra;
    }

    /**
     * Add job
     *
     * @param \Ipssi\IntranetBundle\Entity\Job $job
     *
     * @return User
     */
    public function addJob(\Ipssi\IntranetBundle\Entity\Job $job)
    {
        $this->job[] = $job;

        return $this;
    }

    /**
     * Remove job
     *
     * @param \Ipssi\IntranetBundle\Entity\Job $job
     */
    public function removeJob(\Ipssi\IntranetBundle\Entity\Job $job)
    {
        $this->job->removeElement($job);
    }

    /**
     * Get job
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Add jobOffer
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $jobOffer
     *
     * @return User
     */
    public function addJobOffer(\Ipssi\IntranetBundle\Entity\JobOffer $jobOffer)
    {
        $this->job_offer[] = $jobOffer;

        return $this;
    }

    /**
     * Remove jobOffer
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $jobOffer
     */
    public function removeJobOffer(\Ipssi\IntranetBundle\Entity\JobOffer $jobOffer)
    {
        $this->job_offer->removeElement($jobOffer);
    }

    /**
     * Get jobOffer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobOffer()
    {
        return $this->job_offer;
    }

    /**
     * Add skill
     *
     * @param \Ipssi\IntranetBundle\Entity\Skill $skill
     *
     * @return User
     */
    public function addSkill(\Ipssi\IntranetBundle\Entity\Skill $skill)
    {
        $this->skill[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \Ipssi\IntranetBundle\Entity\Skill $skill
     */
    public function removeSkill(\Ipssi\IntranetBundle\Entity\Skill $skill)
    {
        $this->skill->removeElement($skill);
    }

    /**
     * Get skill
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * Add candidacy
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $candidacy
     *
     * @return User
     */
    public function addCandidacy(\Ipssi\IntranetBundle\Entity\JobOffer $candidacy)
    {
        $this->candidacy[] = $candidacy;

        return $this;
    }

    /**
     * Remove candidacy
     *
     * @param \Ipssi\IntranetBundle\Entity\JobOffer $candidacy
     */
    public function removeCandidacy(\Ipssi\IntranetBundle\Entity\JobOffer $candidacy)
    {
        $this->candidacy->removeElement($candidacy);
    }

    /**
     * Get candidacy
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidacy()
    {
        return $this->candidacy;
    }
}
