<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Factory\ArticleFactory as ArticleFactory;
use Application\Service\ArticleService as ArticleService;
use Application\Service\AuteurService;
use Application\Service\CategorieService;
use Application\Service\CommentaireService;

class ArticlesController extends AbstractActionController
{
    /**
     * @var ArticleService
     */
    //private $articles;
    
    /**
     * @param ArticleService $articles
     
    public function setArticles(ArticleService $articles)
    {
        $this->articles = $articles;
    }
    */
    /**
     * @return ArticleSer
     
    public function getArticles()
    {
        var_dump($this->articles);die;
        return $this->articles;
    }
    */
    public function indexAction()
    {
        $articlesFactory = new ArticleFactory(); 
        $articlesService = $articlesFactory->createService($this->getServiceLocator());
        
        $articles = $articlesService->getAllActivesArticles();
        
        return new ViewModel(array(
            'articles' => $articles
            )
        );
    }
    
    public function auteurAction()
    {
        return new ViewModel();
    }
    
    public function categorieAction()
    {
        return new ViewModel();
    }
    
    public function detailAction()
    {
        return new ViewModel();
    }
    
    public function contactAction()
    {
        return new ViewModel();    
    }
}
