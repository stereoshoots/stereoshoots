<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="bigint")
     */
    protected $phone;
    
    /**
     * @ORM\Column(name="birth_date", type="date")
     */
    protected $birthDate;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $gender;
    
    /**
     * @ORM\Column(name="location_country", type="text")
     */
    protected $locationCountry;
    
    /**
     * @ORM\Column(name="location_city", type="text")
     */
    protected $locationCity;

    /**
    * @ORM\Column( type="text")
    */
    protected $avatar;
    
    /**
     * @ORM\OneToMany(targetEntity="Follower", mappedBy="user")
     */
    protected $followers;
    
    /**
     * @ORM\OneToMany(targetEntity="Follower", mappedBy="follower")
     */
    protected $followings;
    
    public function getPhone()
    {
	return $this->phone;
    }
    
    public function getBirthDate()
    {
	return $this->birthDate;
    }
    
    public function getGender()
    {
	return $this->gender;
    }
    
    public function getLocationCountry()
    {
	return $this->locationCountry;
    }

    public function getLocationCity()
    {
	return $this->locationCity;
    }
    
    public function getAvatar()
    {
	return $this->avatar;
    }
    
    public function getAvatarPath()
    {
        return '/web/uploads/avatars/'.$this->id.'/';
    }
    
    public function getFollowers()
    {
        return $this->followers;
    }
    
    public function getFollowings()
    {
        return $this->followings;
    }
    
    public function setPhone($value)
    {
	$this->phone = $value;
    }
    
    public function setBirthDate($value)
    {
	$this->birthDate = $value;
    }
    
    public function setGender($value)
    {
	$this->gender = $value;
    }
    
    public function setLocationCountry($value)
    {
	$this->locationCountry = $value;
    }
    
    public function setLocationCity($value)
    {
	$this->locationCity = $value;
    }
    
    public function setAvatar($path)
    {
	$this->avatar = $path;
    }
}