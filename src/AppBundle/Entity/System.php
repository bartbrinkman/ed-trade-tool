<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class System
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
	protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Station", mappedBy="system")
     * @Assert\NotBlank()
     */
    protected $stations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return System
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
     * Add stations
     *
     * @param \AppBundle\Entity\Station $stations
     * @return System
     */
    public function addStation(\AppBundle\Entity\Station $stations)
    {
        $this->stations[] = $stations;

        return $this;
    }

    /**
     * Remove stations
     *
     * @param \AppBundle\Entity\Station $stations
     */
    public function removeStation(\AppBundle\Entity\Station $stations)
    {
        $this->stations->removeElement($stations);
    }

    /**
     * Get stations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStations()
    {
        return $this->stations;
    }
}
