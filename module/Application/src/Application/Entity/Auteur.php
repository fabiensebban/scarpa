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
}