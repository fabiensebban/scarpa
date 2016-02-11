<?php
namespace Application\Service;

use Application\Entity\Article as Article;


class ArticleService
{
    public function __construct($em, $articleRepository){
        $this->em = $em;
        $this->articleRepository = $articleRepository;
    }
    
    /**
     * @var Article
     */
    private $artciles;
    
    /**
     * @param Article $articles
     */
    public function setArticles(Article $articles)
    {
        $this->articles = $articles;
    }
    
    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->articles;
    }
    
    public function getAllActivesArticles()
    {
        $criteria = array('en_ligne' => true);
        $orderBy = array('date' => 'desc');

        return $this->articleRepository->findBy($criteria, $orderBy, null, null);
    }
}