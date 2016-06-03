<?php

namespace Ipssi\IpssiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VacationResponse
 *
 * @ORM\Table(name="vacation_response")
 * @ORM\Entity(repositoryClass="Ipssi\IpssiBundle\Repository\VacationResponseRepository")
 */
class VacationResponse
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
     * @ORM\Column(name="signatureManagerDate", type="datetime", nullable=true)
     */
    private $signatureManagerDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="signatureCEODate", type="datetime", nullable=true)
     */
    private $signatureCEODate;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text")
     */
    private $comments;


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
     * Set signatureManagerDate
     *
     * @param \DateTime $signatureManagerDate
     *
     * @return VacationResponse
     */
    public function setSignatureManagerDate($signatureManagerDate)
    {
        $this->signatureManagerDate = $signatureManagerDate;

        return $this;
    }

    /**
     * Get signatureManagerDate
     *
     * @return \DateTime
     */
    public function getSignatureManagerDate()
    {
        return $this->signatureManagerDate;
    }

    /**
     * Set signatureCEODate
     *
     * @param \DateTime $signatureCEODate
     *
     * @return VacationResponse
     */
    public function setSignatureCEODate($signatureCEODate)
    {
        $this->signatureCEODate = $signatureCEODate;

        return $this;
    }

    /**
     * Get signatureCEODate
     *
     * @return \DateTime
     */
    public function getSignatureCEODate()
    {
        return $this->signatureCEODate;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return VacationResponse
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return VacationResponse
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }
}

