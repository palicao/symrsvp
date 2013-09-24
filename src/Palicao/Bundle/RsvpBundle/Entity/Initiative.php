<?php

namespace Palicao\Bundle\RsvpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Palicao\Bundle\RsvpBundle\Entity\ContactGroup;


/**
 * Initiative
 *
 * @ORM\Table(name="initiative")
 * @ORM\Entity(repositoryClass="Palicao\Bundle\RsvpBundle\Entity\InitiativeRepository")
 */
class Initiative
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_start", type="datetime")
     */
    private $eventStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_end", type="datetime")
     */
    private $eventEnd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="open", type="boolean")
     */
    private $open;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registration_start", type="datetime")
     */
    private $registrationStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registration_end", type="datetime")
     */
    private $registrationEnd;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="initiatives")
     */
    private $owner;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="ContactGroup", mappedBy="contactgroups_initiatives")
     */
    private $contact_groups;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contact_groups = new ArrayCollection();
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
     * @return Initiative
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
     * Set location
     *
     * @param string $location
     * @return Initiative
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Initiative
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Initiative
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set eventStart
     *
     * @param \DateTime $eventStart
     * @return Initiative
     */
    public function setEventStart($eventStart)
    {
        $this->eventStart = $eventStart;
    
        return $this;
    }

    /**
     * Get eventStart
     *
     * @return \DateTime 
     */
    public function getEventStart()
    {
        return $this->eventStart;
    }

    /**
     * Set eventEnd
     *
     * @param \DateTime $eventEnd
     * @return Initiative
     */
    public function setEventEnd($eventEnd)
    {
        $this->eventEnd = $eventEnd;
    
        return $this;
    }

    /**
     * Get eventEnd
     *
     * @return \DateTime 
     */
    public function getEventEnd()
    {
        return $this->eventEnd;
    }

    /**
     * Set open
     *
     * @param boolean $open
     * @return Initiative
     */
    public function setOpen($open)
    {
        $this->open = $open;
    
        return $this;
    }

    /**
     * Get open
     *
     * @return boolean 
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set registrationStart
     *
     * @param \DateTime $registrationStart
     * @return Initiative
     */
    public function setRegistrationStart($registrationStart)
    {
        $this->registrationStart = $registrationStart;
    
        return $this;
    }

    /**
     * Get registrationStart
     *
     * @return \DateTime 
     */
    public function getRegistrationStart()
    {
        return $this->registrationStart;
    }

    /**
     * Set registrationEnd
     *
     * @param \DateTime $registrationEnd
     * @return Initiative
     */
    public function setRegistrationEnd($registrationEnd)
    {
        $this->registrationEnd = $registrationEnd;
    
        return $this;
    }

    /**
     * Get registrationEnd
     *
     * @return \DateTime 
     */
    public function getRegistrationEnd()
    {
        return $this->registrationEnd;
    }
    
    /**
     * 
     * Get Initiative owner
     * 
     * @return \Palicao\Bundle\RsvpBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Set owner
     * 
     * @var $owner \Palicao\Bundle\RsvpBundle\Entity\User
     * @return ContactGroup
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        
        return $this;
    }
    
    /**
     * Add contact group
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\ContactGroup $contact_group
     * @return Initiative
     */
    public function addContact(ContactGroup $contact_group)
    {
        $this->contact_groups[] = $contact_group;
    
        return $this;
    }

    /**
     * Remove contact group
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\ContactGroup $contact_group
     */
    public function removeContact(ContactGroup $contact_group)
    {
        $this->contact_groups->removeElement($contact_group);
    }

    /**
     * Get contact groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactGroups()
    {
        return $this->contact_groups;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}
