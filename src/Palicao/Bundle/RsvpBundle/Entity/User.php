<?php

namespace Palicao\Bundle\RsvpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Palicao\Bundle\RsvpBundle\Entity\ContactGroup;

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



    public function __construct() {
        $this->contact_groups = new ArrayCollection();
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
     * Remove contacts
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

}