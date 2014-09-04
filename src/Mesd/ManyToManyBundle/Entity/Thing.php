<?php

namespace Mesd\ManyToManyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Thing
 */
class Thing
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
    private $person;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * @return Thing
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
     * Add person
     *
     * @param \Mesd\ManyToManyBundle\Entity\Person $person
     * @return Thing
     */
    public function addPerson(\Mesd\ManyToManyBundle\Entity\Person $person)
    {
        $person->addThing($this);
        $this->person[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \Mesd\ManyToManyBundle\Entity\Person $person
     */
    public function removePerson(\Mesd\ManyToManyBundle\Entity\Person $person)
    {
        $person->removeThing($this);
        $this->person->removeElement($person);
    }

    /**
     * Get person
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerson()
    {
        return $this->person;
    }
}
