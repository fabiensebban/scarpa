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
}