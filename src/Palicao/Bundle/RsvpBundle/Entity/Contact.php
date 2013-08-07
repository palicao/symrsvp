<?php

namespace Palicao\Bundle\RsvpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="Palicao\Bundle\RsvpBundle\Entity\ContactRepository")
 * @UniqueEntity("email")
 */
class Contact
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="ContactGroup", inversedBy="contacts")
     */
    private $groups;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set email
     *
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add groups
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\ContactGroup $groups
     * @return Contact
     */
    public function addGroup(\Palicao\Bundle\RsvpBundle\Entity\ContactGroup $groups)
    {
        $this->groups[] = $groups;
    
        return $this;
    }
    
    public function setGroups(\Palicao\Bundle\RsvpBundle\Entity\ContactGroup $groups)
    {
        $this->groups = $groups;
        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\ContactGroup $groups
     */
    public function removeGroup(\Palicao\Bundle\RsvpBundle\Entity\ContactGroup $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
    
    public function __toString()
    {
        return $this->email;
    }
}