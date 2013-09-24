<?php

namespace Palicao\Bundle\RsvpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Palicao\Bundle\RsvpBundle\Entity\Contact;

/**
 * ContactGroup
 *
 * @ORM\Table(name="contact_group")
 * @ORM\Entity(repositoryClass="Palicao\Bundle\RsvpBundle\Entity\ContactGroupRepository")
 */
class ContactGroup
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
     *
     * @ORM\ManyToMany(targetEntity="Contact", mappedBy="groups")
     */
    private $contacts;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="contact_groups")
     */
    private $owner;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="Initiative", inversedBy="contact_groups")
     */
    private $initiatives;
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
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
     * @return ContactGroup
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
     * Add contact
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\Contact $contact
     * @return ContactGroup
     */
    public function addContact(Contact $contact)
    {
        $this->contacts[] = $contact;
    
        return $this;
    }

    /**
     * Remove contact
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\Contact $contact
     */
    public function removeContact(Contact $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    
    /**
     * Add initiative
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\Initiative $initiative
     * @return ContactGroup
     */
    public function addInitiative(Initiative $initiative)
    {
        $this->initiatives[] = $initiatives;
    
        return $this;
    }

    /**
     * Remove initiative
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\Iniitative $initiative
     */
    public function removeInitiative(Initiative $initiative)
    {
        $this->initiatives->removeElement($initiative);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInitiatives()
    {
        return $this->initiatives;
    }
    
    /**
     * 
     * Get ContactGroup owner
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
    
    public function __toString()
    {
        return $this->name;
    }
}