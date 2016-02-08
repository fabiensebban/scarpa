<?php
namespace Application\Service;

class ArticleService
{
    public function __construct($em, $articleRepository){
        $this->em = $em;
        $this->$articleRepository = $articleRepository;
    }
    
}