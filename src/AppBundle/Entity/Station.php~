<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Station
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
     * @ORM\ManyToOne(targetEntity="System", inversedBy="stations")
     */
    protected $system;

    /**
     * @ORM\OneToMany(targetEntity="Posting", mappedBy="station")
     */
    protected $postings;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postings = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Station
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
     * Set system
     *
     * @param \AppBundle\Entity\System $system
     * @return Station
     */
    public function setSystem(\AppBundle\Entity\System $system = null)
    {
        $this->system = $system;

        return $this;
    }

    /**
     * Get system
     *
     * @return \AppBundle\Entity\System 
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * Add postings
     *
     * @param \AppBundle\Entity\Posting $postings
     * @return Station
     */
    public function addPosting(\AppBundle\Entity\Posting $postings)
    {
        $this->postings[] = $postings;

        return $this;
    }

    /**
     * Remove postings
     *
     * @param \AppBundle\Entity\Posting $postings
     */
    public function removePosting(\AppBundle\Entity\Posting $postings)
    {
        $this->postings->removeElement($postings);
    }

    /**
     * Get postings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostings()
    {
        return $this->postings;
    }
}
