<?php



namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="google_id", type="string", length=255, nullable=true)
     */
    protected $google_id;

    /**
     * @ORM\Column(name="google_access_token", type="string", length=255, nullable=true)
     */
    protected $google_access_token;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;


    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Profile", mappedBy="user", cascade="persist")
     */
    private $profile;


    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Newsletter", mappedBy="user")
     */
    private $newsletter;


    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\Page", mappedBy="user")
     */
    private $pages;


    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\News", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $news;


    /**
     * @ORM\ManyToOne(targetEntity="Ipssi\JobBundle\Entity\Society", inversedBy="members")
     * @@ORMJoinColumn(name="society_id", referencedColumnName="id", nullable=true)
     */
    private $society;


    /**
     * User skills
     * @ORM\ManyToMany(targetEntity="Ipssi\JobBundle\Entity\Skill", inversedBy="users")
     * @ORM\JoinTable(name="user_skills")
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\JobBundle\Entity\Candidacy", mappedBy="candidate")
     * @ORM\JoinColumn(nullable=true)
     */
    private $candidacies;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\JobBundle\Entity\CV", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $cv;



    /*****  A revoir ****/

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserExpense", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_expense;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserExpense", mappedBy="user_validation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_validation_expense;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserCRA", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_cra;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserCRA", mappedBy="user_validation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_validation_cra;



    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserVacation", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_vacation;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserVacation", mappedBy="user_validation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_validation_vacation;



    public function __construct() {
        parent::__construct();
        $this->news = new ArrayCollection();
        $this->user_expense = new ArrayCollection();
        $this->user_validation_expense = new ArrayCollection();
        $this->user_cra = new ArrayCollection();
        $this->user_validation_cra = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->job_offers = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->candidacy = new ArrayCollection();
        $this->user_cv = new ArrayCollection();
        $this->user_validation_cv = new ArrayCollection();
        $this->user_vacation = new ArrayCollection();
        $this->user_validation_vacation = new ArrayCollection();
    }



    /**
     * Set googleId
     *
     * @param string $googleId
     *
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->google_id = $googleId;

        return $this;
    }

    /**
     * Get googleId
     *
     * @return string
     */
    public function getGoogleId()
    {
        return $this->google_id;
    }

    /**
     * Set googleAccessToken
     *
     * @param string $googleAccessToken
     *
     * @return User
     */
    public function setGoogleAccessToken($googleAccessToken)
    {
        $this->google_access_token = $googleAccessToken;

        return $this;
    }

    /**
     * Get googleAccessToken
     *
     * @return string
     */
    public function getGoogleAccessToken()
    {
        return $this->google_access_token;
    }


}
