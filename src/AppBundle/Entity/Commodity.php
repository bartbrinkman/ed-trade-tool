<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Commodity
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
	protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Station", inversedBy="commodities")
     */
    protected $station;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $buy;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $sell;

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
     * @return Commodity
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
     * Set buy
     *
     * @param string $buy
     * @return Commodity
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
     * Set sell
     *
     * @param string $sell
     * @return Commodity
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
     * Set station
     *
     * @param \AppBundle\Entity\Station $station
     * @return Commodity
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
