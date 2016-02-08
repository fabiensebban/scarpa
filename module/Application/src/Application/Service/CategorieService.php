<?php
namespace Application\Service;

class CategorieService
{
    public function __construct($em, $categorieRepository){
        $this->em = $em;
        $this->categorieRepository = $categorieRepository;
    }

}