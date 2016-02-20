<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZfcRbac\Identity\IdentityInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="auteur") 
 **/
class Auteur implements IdentityInterface
{
    /**
    * @ORM\Id 
    * @ORM\Column(name="id", type="integer") 
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;
    
    /** @ORM\Column(length=140) */
    private $displayName;
    
    /** @ORM\Column(length=140) */
    private $username;
    
    /** @ORM\Column(length=140) */
    private $password;
    
    /** @ORM\Column(length=255) */
    private $email;
    
    /** @ORM\Column(length=255) */
    private $role;
    
    function getId(){
        return $this->id;
    }
    
    function getDisplayName(){
        return $this->displayName;
    }
    
    function getUsername(){
        return $this->username;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function getEmail(){
        return $this->email;
    }
    
    function getRole(){
        return $this->role;
    }
   
    function setId($id){
        $this->id = $id;
    }
    
    function setDisplayName($displayName){
        $this->displayName = $displayName;
    }
    
    function setUsername($username){
        $this->username = $username;
    }
    
    function setPassword($password){
        $this->password = $password;
    }
    
    function setEmail($email){
        $this->email = $email;
    }
    
    function setRole($role){
        $this->role = $role;
    }
    
    /*
     *@ORM\PrePersist
     */
    function setDefaultRole(){
        $this->role = 'member';
        
        return $this;
    }
    /**
     * {@inheritDoc}
     * @see \ZfcRbac\Identity\IdentityInterface::getRoles()
     */
    public function getRoles()
    {
        // TODO Auto-generated method stub
        
    }

}