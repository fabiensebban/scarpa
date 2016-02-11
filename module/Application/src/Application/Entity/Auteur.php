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
    private $nom;
    
    /** @ORM\Column(length=140) */
    private $prenom;
    
    /** @ORM\Column(length=140) */
    private $url;
    
    /** @ORM\Column(length=255) */
    private $email;
    
    function getId(){
        return $this->id;
    }
    
    function getNom(){
        return $this->nom;
    }
    
    function getPrenom(){
        return $this->prenom;
    }
    
    function getUrl(){
        return $this->url;
    }
    
    function getEmail(){
        return $this->email;
    }
   
    function setId($id){
        $this->id = $id;
    }
    
    function setNom($nom){
        $this->nom = $nom;
    }
    
    function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    
    function setUrl($url){
        $this->url = $url;
    }
    
    function setEmail($email){
        $this->email = $email;
    }
}