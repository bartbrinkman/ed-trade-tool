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
     * @ORM\OneToMany(targetEntity="Posting", mappedBy="commodity")
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
     * Add postings
     *
     * @param \AppBundle\Entity\Posting $postings
     * @return Commodity
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
