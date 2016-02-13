<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="auteur") 
 **/
class Auteur
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
}