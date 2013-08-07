<?php

namespace Palicao\Bundle\RsvpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactParam
 *
 * @ORM\Table(name="contact_param")
 * @ORM\Entity(repositoryClass="Palicao\Bundle\RsvpBundle\Entity\ContactParamRepository")
 */
class ContactParam
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
     * @ORM\Column(name="value", type="text")
     */
    private $value;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Contact")
     */
    private $contact;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ContactGroup")
     */
    private $contact_group;


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
     * @return ContactParam
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
     * Set value
     *
     * @param string $value
     * @return ContactParam
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * Set contact
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\Contact $contact
     * @return ContactParam
     */
    public function setContact(\Palicao\Bundle\RsvpBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return \Palicao\Bundle\RsvpBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set contact_group
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\ContactGroup $contactGroup
     * @return ContactParam
     */
    public function setContactGroup(\Palicao\Bundle\RsvpBundle\Entity\ContactGroup $contactGroup = null)
    {
        $this->contact_group = $contactGroup;
    
        return $this;
    }

    /**
     * Get contact_group
     *
     * @return \Palicao\Bundle\RsvpBundle\Entity\ContactGroup 
     */
    public function getContactGroup()
    {
        return $this->contact_group;
    }
}