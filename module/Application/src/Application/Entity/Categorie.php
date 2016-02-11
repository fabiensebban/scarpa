<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categorie")
 **/
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(length=250) */
    private $nom;
    
    /** @ORM\Column(length=250) */
    private $url;
    
    function getId(){
        return $this->id;
    }
    
    function getNom(){
        return $this->nom;
    }
    
    function getUrl(){
        return $this->url;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setNom($nom){
        $this->nom = $nom;
    }
    
    function setUrl($url){
        $this->url = $url;
    }
}