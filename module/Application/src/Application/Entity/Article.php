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
}

