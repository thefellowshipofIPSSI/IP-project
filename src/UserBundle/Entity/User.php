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
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\Candidacy", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $candidacy;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserCV", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_cv;

    /**
     * @ORM\OneToMany(targetEntity="Ipssi\IntranetBundle\Entity\UserCV", mappedBy="user_validation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user_validation_cv;

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
        $this->job = new ArrayCollection();
        $this->job_offer = new ArrayCollection();
        $this->skill = new ArrayCollection();
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

    /**
     * Set profile
     *
     * @param \UserBundle\Entity\Profile $profile
     *
     * @return User
     */
    public function setProfile(\UserBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \UserBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set newsletter
     *
     * @param \UserBundle\Entity\Newsletter $newsletter
     *
     * @return User
     */
    public function setNewsletter(\UserBundle\Entity\Newsletter $newsletter = null)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return \UserBundle\Entity\Newsletter
     */
    public function getNewsletter()
    {
        return $this->newsletter;
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
     * Add userValidationExpense
     *
     * @param \Ipssi\IntranetBundle\Entity\UserExpense $userValidationExpense
     *
     * @return User
     */
    public function addUserValidationExpense(\Ipssi\IntranetBundle\Entity\UserExpense $userValidationExpense)
    {
        $this->user_validation_expense[] = $userValidationExpense;

        return $this;
    }

    /**
     * Remove userValidationExpense
     *
     * @param \Ipssi\IntranetBundle\Entity\UserExpense $userValidationExpense
     */
    public function removeUserValidationExpense(\Ipssi\IntranetBundle\Entity\UserExpense $userValidationExpense)
    {
        $this->user_validation_expense->removeElement($userValidationExpense);
    }

    /**
     * Get userValidationExpense
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserValidationExpense()
    {
        return $this->user_validation_expense;
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
     * Add userValidationCra
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCRA $userValidationCra
     *
     * @return User
     */
    public function addUserValidationCra(\Ipssi\IntranetBundle\Entity\UserCRA $userValidationCra)
    {
        $this->user_validation_cra[] = $userValidationCra;

        return $this;
    }

    /**
     * Remove userValidationCra
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCRA $userValidationCra
     */
    public function removeUserValidationCra(\Ipssi\IntranetBundle\Entity\UserCRA $userValidationCra)
    {
        $this->user_validation_cra->removeElement($userValidationCra);
    }

    /**
     * Get userValidationCra
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserValidationCra()
    {
        return $this->user_validation_cra;
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
     * @param \Ipssi\IntranetBundle\Entity\Candidacy $candidacy
     *
     * @return User
     */
    public function addCandidacy(\Ipssi\IntranetBundle\Entity\Candidacy $candidacy)
    {
        $this->candidacy[] = $candidacy;

        return $this;
    }

    /**
     * Remove candidacy
     *
     * @param \Ipssi\IntranetBundle\Entity\Candidacy $candidacy
     */
    public function removeCandidacy(\Ipssi\IntranetBundle\Entity\Candidacy $candidacy)
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

    /**
     * Add userCv
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCV $userCv
     *
     * @return User
     */
    public function addUserCv(\Ipssi\IntranetBundle\Entity\UserCV $userCv)
    {
        $this->user_cv[] = $userCv;

        return $this;
    }

    /**
     * Remove userCv
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCV $userCv
     */
    public function removeUserCv(\Ipssi\IntranetBundle\Entity\UserCV $userCv)
    {
        $this->user_cv->removeElement($userCv);
    }

    /**
     * Get userCv
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserCv()
    {
        return $this->user_cv;
    }

    /**
     * Add userValidationCv
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCV $userValidationCv
     *
     * @return User
     */
    public function addUserValidationCv(\Ipssi\IntranetBundle\Entity\UserCV $userValidationCv)
    {
        $this->user_validation_cv[] = $userValidationCv;

        return $this;
    }

    /**
     * Remove userValidationCv
     *
     * @param \Ipssi\IntranetBundle\Entity\UserCV $userValidationCv
     */
    public function removeUserValidationCv(\Ipssi\IntranetBundle\Entity\UserCV $userValidationCv)
    {
        $this->user_validation_cv->removeElement($userValidationCv);
    }

    /**
     * Get userValidationCv
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserValidationCv()
    {
        return $this->user_validation_cv;
    }

    /**
     * Add userVacation
     *
     * @param \Ipssi\IntranetBundle\Entity\UserVacation $userVacation
     *
     * @return User
     */
    public function addUserVacation(\Ipssi\IntranetBundle\Entity\UserVacation $userVacation)
    {
        $this->user_vacation[] = $userVacation;

        return $this;
    }

    /**
     * Remove userVacation
     *
     * @param \Ipssi\IntranetBundle\Entity\UserVacation $userVacation
     */
    public function removeUserVacation(\Ipssi\IntranetBundle\Entity\UserVacation $userVacation)
    {
        $this->user_vacation->removeElement($userVacation);
    }

    /**
     * Get userVacation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserVacation()
    {
        return $this->user_vacation;
    }

    /**
     * Add userValidationVacation
     *
     * @param \Ipssi\IntranetBundle\Entity\UserVacation $userValidationVacation
     *
     * @return User
     */
    public function addUserValidationVacation(\Ipssi\IntranetBundle\Entity\UserVacation $userValidationVacation)
    {
        $this->user_validation_vacation[] = $userValidationVacation;

        return $this;
    }

    /**
     * Remove userValidationVacation
     *
     * @param \Ipssi\IntranetBundle\Entity\UserVacation $userValidationVacation
     */
    public function removeUserValidationVacation(\Ipssi\IntranetBundle\Entity\UserVacation $userValidationVacation)
    {
        $this->user_validation_vacation->removeElement($userValidationVacation);
    }

    /**
     * Get userValidationVacation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserValidationVacation()
    {
        return $this->user_validation_vacation;
    }
}
