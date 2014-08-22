<?php

namespace Mesd\ManyToManyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 */
class Person
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $thing;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->thing = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Person
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
     * Add thing
     *
     * @param \Mesd\ManyToManyBundle\Entity\Thing $thing
     * @return Person
     */
    public function addThing(\Mesd\ManyToManyBundle\Entity\Thing $thing)
    {
        $this->thing[] = $thing;

        return $this;
    }

    /**
     * Remove thing
     *
     * @param \Mesd\ManyToManyBundle\Entity\Thing $thing
     */
    public function removeThing(\Mesd\ManyToManyBundle\Entity\Thing $thing)
    {
        $this->thing->removeElement($thing);
    }

    /**
     * Get thing
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getThing()
    {
        return $this->thing;
    }
}
