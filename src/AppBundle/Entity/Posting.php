<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Posting
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Commodity", inversedBy="postings")
     */
    protected $commodity;

    /**
     * @ORM\ManyToOne(targetEntity="Station", inversedBy="postings")
     */
    protected $station;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $sell;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $buy;

    /**
     * @ORM\Column(type="integer")
     */
    protected $demand;

    /**
     * @ORM\Column(type="integer")
     */
    protected $supply;

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
     * Set sell
     *
     * @param string $sell
     * @return Posting
     */
    public function setSell($sell)
    {
        $this->sell = $sell;

        return $this;
    }

    /**
     * Get sell
     *
     * @return string 
     */
    public function getSell()
    {
        return $this->sell;
    }

    /**
     * Set buy
     *
     * @param string $buy
     * @return Posting
     */
    public function setBuy($buy)
    {
        $this->buy = $buy;

        return $this;
    }

    /**
     * Get buy
     *
     * @return string 
     */
    public function getBuy()
    {
        return $this->buy;
    }

    /**
     * Set demand
     *
     * @param integer $demand
     * @return Posting
     */
    public function setDemand($demand)
    {
        $this->demand = $demand;

        return $this;
    }

    /**
     * Get demand
     *
     * @return integer 
     */
    public function getDemand()
    {
        return $this->demand;
    }

    /**
     * Set supply
     *
     * @param integer $supply
     * @return Posting
     */
    public function setSupply($supply)
    {
        $this->supply = $supply;

        return $this;
    }

    /**
     * Get supply
     *
     * @return integer 
     */
    public function getSupply()
    {
        return $this->supply;
    }

    /**
     * Set commodity
     *
     * @param \AppBundle\Entity\Commodity $commodity
     * @return Posting
     */
    public function setCommodity(\AppBundle\Entity\Commodity $commodity = null)
    {
        $this->commodity = $commodity;

        return $this;
    }

    /**
     * Get commodity
     *
     * @return \AppBundle\Entity\Commodity 
     */
    public function getCommodity()
    {
        return $this->commodity;
    }

    /**
     * Set station
     *
     * @param \AppBundle\Entity\Station $station
     * @return Posting
     */
    public function setStation(\AppBundle\Entity\Station $station = null)
    {
        $this->station = $station;

        return $this;
    }

    /**
     * Get station
     *
     * @return \AppBundle\Entity\Station 
     */
    public function getStation()
    {
        return $this->station;
    }
}
