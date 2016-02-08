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
    
}