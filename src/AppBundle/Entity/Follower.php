<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="follows")
 */
class Follower
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="followers")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="followers")
     */
    protected $follower;
    
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive = true;
    
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
     * Get user
     *
     * @return object
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Get follower
     *
     * @return object
     */
    public function getFollower()
    {
        return $this->follower;
    }
    
    /**
     * Get is active
     *
     * @return integer
     */
    public function isActive()
    {
        return $this->isActive;
    }
    
    /**
     * Set user
     */
    public function setUser($user)
    {
	$this->user = $user;
    }
    
    /**
     * Set user
     */
    public function setFollower($follower)
    {
	$this->user = $user;
    }
       
    /**
     * Set active
     */
    public function setActive($active)
    {
        $this->isActive = $active;
    }
}
