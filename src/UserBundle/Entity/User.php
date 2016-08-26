<?php



namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
}
