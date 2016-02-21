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
use Application\Factory\CommentaireFactory as CommentaireFactory;
use Application\Service\CommentaireService as CommentaireService;
use Application\Service\AuteurService;
use Application\Service\CategorieService;
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
        
        return new ViewModel(array(
            'articles' => $articles
            )
        );
    }
    
    public function createAction()
    {
        if ($this->zfcUserAuthentication()->getIdentity()->getRole() == 'member') {
            $this->getServiceLocator()->get('Zend\LogWarning')->warr('Quelqu\'un de non authorizé essais d\'acceder à la page de création d\'article');
            $this->redirect()->toRoute('home');
            
        }
        
        $categorieFactory = new CategorieFactory();
        $categorieService = $categorieFactory->createService($this->getServiceLocator());
        
        $categories = $categorieService->getAllCategories();
        
        if($this->request->isPost())
        {
            $this->getServiceLocator()->get('Zend\LogWarning')->warr('Une tentative de création d\'article a été déctecté');
            $post = $this->getRequest()->getPost();
            
            $categoriesFactory = new CategorieFactory();
            $categorieService = $categoriesFactory->createService($this->getServiceLocator());
            
            $categorie = new Categorie();
            
            $categorie = $categorieService->getById($post["categorie"]);
            if($categorie == null)
                return $this->notFoundAction();
            
            $post["categorie"] = $categorie;
            
            $articlesFactory = new ArticleFactory();
            $articlesService = $articlesFactory->createService($this->getServiceLocator());
            
            $article = $articlesService->isValidPost($post);
            
            if(!$article["valide"])
            {
                $this->getServiceLocator()->get('Zend\LogError')->err('Erreur : '.$article['error']);
                return new ViewModel(array( 'errors' => $article['error'], 'categories' => $categories));
            }
            else 
            {
                //Saving article 
                $articlesService->saveArticle($post, $categorie, $this->zfcUserAuthentication()->getIdentity());
                $this->getServiceLocator()->get('Zend\Log')->info('Un article a été sauvgardé');
                $this->redirect('home');
            }
        }
        
        return new ViewModel(array(
            'categories' => $categories
        ));
    }
    
    public function createCommentaireAction()
    {
        if($this->request->isPost())
        {
            $this->getServiceLocator()->get('Zend\Log')->info('Post sur la création d\'un commentaire');
            
            $articlesFactory = new ArticleFactory();
            $articlesService = $articlesFactory->createService($this->getServiceLocator());
            
            $commentaireFactory = new CommentaireFactory();
            $commentaireService = $commentaireFactory->createService($this->getServiceLocator());
            
            $post = $this->getRequest()->getPost();
            $articleId = $post['article_id'];
            
            $article = new Article();
            $article = $articlesService->getArticleByID($articleId);
            if($article === null)
            {
                return $this->notFoundAction();
            }
            
            $user['email'] = $this->zfcUserAuthentication()->getIdentity()->getEmail();
            $user['nom'] = $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
            
            $commentaireService->saveCommentaire($post, $user, $article);
            
            $this->redirect()->toRoute('articles - view', array(
                'controller' => 'articles',
                'action' =>  'view',
                'id' => $articleId
            ));
            
            $this->redirect()->toRoute('articles/view/'. $articleId);
        }
        return new ViewModel();
    }
    
    public function categorieAction()
    {
        return new ViewModel();
    }
    
    public function viewAction()
    {
        
        $articleId = $this->params('id');
        
        $atricleFactory = new ArticleFactory();
        $articleService = $atricleFactory->createService($this->getServiceLocator());
        
        $commentaireFactory = new CommentaireFactory();
        $commentaireService = $commentaireFactory->createService($this->getServiceLocator());
        
        $article = $articleService->getArticleByID($articleId);
        
        if($article === null)
        {
            return $this->notFoundAction();
        }
        $commentaires = $commentaireService->getCommentaireFromArticleID($articleId);
        
        $this->getServiceLocator()->get('Zend\Log')->info('Accès à la page view articles : nom article => '.$article);
        return new ViewModel(array( 'article'       => $article,
                                    'commentaires'   => $commentaires
                                ));
    }
    
    public function contactAction()
    {
        return new ViewModel();    
    }
    
    
    
}
