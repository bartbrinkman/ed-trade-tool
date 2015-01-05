<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Category
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
     * @ORM\OneToMany(targetEntity="Commodity", mappedBy="category")
     */
    protected $commodities;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commodities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Category
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
     * Add commodities
     *
     * @param \AppBundle\Entity\Commodity $commodities
     * @return Category
     */
    public function addCommodity(\AppBundle\Entity\Commodity $commodities)
    {
        $this->commodities[] = $commodities;

        return $this;
    }

    /**
     * Remove commodities
     *
     * @param \AppBundle\Entity\Commodity $commodities
     */
    public function removeCommodity(\AppBundle\Entity\Commodity $commodities)
    {
        $this->commodities->removeElement($commodities);
    }

    /**
     * Get commodities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommodities()
    {
        return $this->commodities;
    }
}
