<?php

namespace Palicao\Bundle\RsvpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Palicao\Bundle\RsvpBundle\Entity\ContactGroup;
use Palicao\Bundle\RsvpBundle\Entity\Initiative;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Palicao\Bundle\RsvpBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     *
     * @ORM\OneToMany(targetEntity="ContactGroup", mappedBy="owner")
     */
    private $contact_groups;

    /**
     *
     * @ORM\OneToMany(targetEntity="Initiative", mappedBy="owner")
     */
    private $initiatives;
    

    public function __construct() {
        $this->contact_groups = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
        parent::__construct();
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
     * Add contacts
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\ContactGroup $group
     * @return ContactGroup
     */
    public function addContactGroup(ContactGroup $group)
    {
        $this->contact_groups[] = $group;
    
        return $this;
    }

    /**
     * Remove contact
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\ContactGroup $group
     */
    public function removeContactGroup(ContactGroup $group)
    {
        $this->contact_groups->removeElement($group);
    }

    /**
     * Get contacts
     *
     * @return ArrayCollection
     */
    public function getContactGroups()
    {
        return $this->contact_groups;
    }

    
    /**
     * Add initiative
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\Initiative $initiative
     * @return User
     */
    public function addInitiative(Initiative $initiative)
    {
        $this->initiatives[] = $initiative;
    
        return $this;
    }

    /**
     * Remove initiative
     *
     * @param \Palicao\Bundle\RsvpBundle\Entity\Initiative $initiative
     */
    public function removeInitiative(Initiative $initiative)
    {
        $this->initiatives->removeElement($initiative);
    }

    /**
     * Get initiatives
     *
     * @return ArrayCollection
     */
    public function getInitiatives()
    {
        return $this->initiatives;
    }
}