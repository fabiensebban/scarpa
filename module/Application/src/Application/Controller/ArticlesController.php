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
use Zend\Http\Header\Via;
use Zend\Mvc\View\Console\ViewManager;
use Application\Factory\CategorieFactory;
use Application\Entity\Article;
use Application\Entity\Categorie;

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
        return $this->articles;
    }
    */
    
    public function indexAction()
    {
        $articlesFactory = new ArticleFactory(); 
        $articlesService = $articlesFactory->createService($this->getServiceLocator());
        
        $articles = $articlesService->getAllActivesArticles();
        $this->getServiceLocator()->get('Zend\Log')->info('Accès à la page index (Home)...');
        
        return new ViewModel(array(
            'articles' => $articles
            )
        );
    }
    
    public function createAction()
    {
        if ($this->zfcUserAuthentication()->getIdentity()->getRole() == 'member') {
            $this->getServiceLocator()->get('Zend\Log')->info('Quelqu\'un de non authorizé essais d\'acceder à la page de création d\'article');
            $this->redirect()->toRoute('home');
            
        }
        
        $categorieFactory = new CategorieFactory();
        $categorieService = $categorieFactory->createService($this->getServiceLocator());
        
        $categories = $categorieService->getAllCategories();
        
        if($this->request->isPost())
        {
            $post = $this->getRequest()->getPost();
            
            $categoriesFactory = new CategorieFactory();
            $categorieService = $categoriesFactory->createService($this->getServiceLocator());
            
            $categorie = new Categorie();
            $categorie = $categorieService->getById($post["categorie"]);
            $post["categorie"] = $categorie;
            
            
            $articlesFactory = new ArticleFactory();
            $articlesService = $articlesFactory->createService($this->getServiceLocator());
            
            $article = $articlesService->isValidPost($post);
            
            if(!$article["valide"])
            {
                return new ViewModel(array( 'errors' => $article['error'], 'categories' => $categories));
            }
            else 
            {
                //Saving article 
                $articlesService->saveArticle($post, $categorie, $this->zfcUserAuthentication()->getIdentity());
                $this->redirect('home');
            }
        }
        
        return new ViewModel(array(
            'categories' => $categories
        ));
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
        $this->getServiceLocator()->get('Zend\Log')->info('Accès à la page détail... '); 
        return new ViewModel();
    }
    
    public function contactAction()
    {
        $this->getServiceLocator()->get('Zend\Log')->info('Accès à la page contact... '); 
        return new ViewModel();    
    }
    
    
}
