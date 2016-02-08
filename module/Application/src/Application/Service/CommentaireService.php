<?php
namespace Application\Service;

class CommentaireService
{
    public function __construct($em, $commentaireRepository){
        $this->em = $em;
        $this->commentaireRepository = $commentaireRepository;
    }

}