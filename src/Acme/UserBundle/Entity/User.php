<?php

namespace Acme\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use FOS\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity
 */
class User extends BaseUser
{
    use \Msi\CmfBundle\Doctrine\Extension\Model\SoftDeletable;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $locale;

    /**
     * @ORM\ManyToMany(targetEntity="Msi\UserBundle\Entity\Group")
     */
    protected $groups;

    /**
     * @ORM\ManyToMany(targetEntity="Msi\UserBundle\Entity\Group")
     */
    protected $operators;

    public function __construct()
    {
        parent::__construct();
        $this->groups = new ArrayCollection();
        $this->operators = new ArrayCollection();
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->username = $email;

        return $this;
    }

    public function getOperators()
    {
        return $this->operators;
    }

    public function setOperators($operators)
    {
        $this->operators = $operators;

        return $this;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    public function getLocked()
    {
        return $this->locked;
    }

    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
}
