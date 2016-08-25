<?php

namespace Ipssi\IpssiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpenseLine
 *
 * @ORM\Table(name="expense_line")
 * @ORM\Entity(repositoryClass="Ipssi\IpssiBundle\Repository\ExpenseLineRepository")
 */
class ExpenseLine
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
     * @ORM\Column(name="expenseLineDate", type="datetime")
     */
    private $expenseLineDate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;


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
     * Set expenseLineDate
     *
     * @param \DateTime $expenseLineDate
     *
     * @return ExpenseLine
     */
    public function setExpenseLineDate($expenseLineDate)
    {
        $this->expenseLineDate = $expenseLineDate;

        return $this;
    }

    /**
     * Get expenseLineDate
     *
     * @return \DateTime
     */
    public function getExpenseLineDate()
    {
        return $this->expenseLineDate;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ExpenseLine
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return ExpenseLine
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }
}

