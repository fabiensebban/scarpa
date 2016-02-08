<?php
namespace Application\Service;

class AuteurService
{
    public function __construct($em, $auteurRepository){
        $this->em = $em;
        $this->auteurRepository = $auteurRepository;
    }
    
}