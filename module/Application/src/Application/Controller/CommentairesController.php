<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Factory\CommentaireFactory as CommentaireFactory;
use Application\Service\CommentaireService as CommentaireService;
use Application\Entity\Commentaire;

/**
 * AuteursController
 *
 * @author
 *
 * @version
 *
 */
class CommentairesController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function desactiverAction()
    {
        if(!$this->zfcUserAuthentication()->getIdentity()){
            $this->redirect()->toRoute('home');
        }
        if($this->zfcUserAuthentication()->getIdentity()->getRole() != 'auteur'){
            $this->redirect()->toRoute('home');
        }
        
        $articleId = $this->params('articleID');
        $commentaireId = $this->params('commentaireID');
        
        
        $commentaireFactory = new CommentaireFactory();
        $commentaireService = $commentaireFactory->createService($this->getServiceLocator());
        
        $commentaireService->desactiverCommentaire($commentaireId);
    
         $this->redirect()->toRoute('articles - view', array(
                'controller' => 'articles',
                'action' =>  'view',
                'id' => $articleId
            ));
    
    }
    
    public function activerAction()
    {
        if(!$this->zfcUserAuthentication()->getIdentity()){
            $this->redirect()->toRoute('home');
        }
        if($this->zfcUserAuthentication()->getIdentity()->getRole() != 'auteur'){
            $this->redirect()->toRoute('home');
        }
        
        $articleId = $this->params('articleID');
        $commentaireId = $this->params('commentaireID');
    
        
        $commentaireFactory = new CommentaireFactory();
        $commentaireService = $commentaireFactory->createService($this->getServiceLocator());
        
        $commentaireService->activerCommentaire($commentaireId);
    
         $this->redirect()->toRoute('articles - view', array(
                'controller' => 'articles',
                'action' =>  'view',
                'id' => $articleId
            ));
    
    }
    
}