<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="commentaire")
 **/
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
    * @ORM\ManyToOne(targetEntity="Application\Entity\Article")
    */
    private $article;
    
    /** @ORM\Column(length=140) */
    private $nom;
    
    /** @ORM\Column(length=140) */
    private $email;
    
    /** @ORM\Column(length=2000) */
    private $text;
    
    /** @ORM\Column(type="datetime", name="date") */
    private $date;
    
    /** @ORM\Column(type="boolean") */
    private $validation;
    
    function getId(){
        return $this->id;
    }
    
    function getArticle(){
        return $this->article;
    }
    
    function getNom(){
        return $this->nom;
    }
    
    function getEmail(){
        return $this->email;
    }
    
    function getText(){
        return $this->text;
    }
    
    function getDate(){
        return $this->date;
    }
    
    function getValidation(){
        return $this->validation;
    }
     
    function setId($id){
        $this->id = $id;
    }
    
    function setArticle($article){
        $this->article = $article;
    }
    
    function setNom($nom){
        $this->nom = $nom;
    }
    
    function setEmail($email){
        $this->email = $email;
    }
    
    function setText($text){
        $this->text = $text;
    }
    
    function setDate($date){
        $this->date = $date;
    }
    
    function setValidation($validation){
        $this->validation = $validation;
    }
}