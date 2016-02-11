<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="article") 
 **/
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\Auteur")
     */
    private $auteur;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\Categorie")
     */
    private $categorie;
    
    /** @ORM\Column(length=250) */
    private $titre;
    
    /** @ORM\Column(type="datetime", name="date") */
    private $date;
    
    /** @ORM\Column(length=2000) */
    private $contenu;
    
    /** @ORM\Column(length=2000) */
    private $chapeau;
    
    /** @ORM\Column(type="boolean") */
    private $en_ligne;
    
    function getId(){
        return $this->id;
    }
    
    function getAuteur(){
        return $this->auteur;
    }
    
    function getCategorie(){
        return $this->categorie;
    }
    
    function getTitre(){
        return $this->titre;
    }
    
    function getDate(){
        return $this->date;
    }
    
    function getContenu(){
        return $this->contenu;
    }
    
    function getChapeau(){
        return $this->chapeau;
    }
    
    function getEn_ligne(){
        return $this->en_ligne;
    }
    
    function setId($id){
         $this->id = $id;
    }
    
    function setAuteur($auteur){
        $this->auteur = $auteur;
    }
    
    function setCategorie($categorie){
        $this->categorie = $categorie;
    }
   
    function setTitre($titre){
        $this->titre = $titre;
    }
    
    function setDate($date){
        $this->date = $date;
    }
    
    function setContenu($contenu){
        $this->contenu = $contenu;
    }
    
    function setChapeau($chapeau){
        $this->chapeau = $chapeau;
    }
    
    function setEn_ligne($en_ligne){
        $this->en_ligne = $en_ligne;
    }
    /*
    function getActivesByCriteria($criteria) {
        $repository = $this
        ->getRepository('OCPlatformBundle:Advert');
        return $repository->findBy($criteria, null, null, null);
    }
    */
}

