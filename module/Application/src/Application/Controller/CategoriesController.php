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

use Application\Service\CategorieService as Categorie;
use Zend\Http\Header\Via;
use Zend\Mvc\View\Console\ViewManager;
use Application\Factory\CategorieFactory;


class CategoriesController extends AbstractActionController
{
    public function createAction()
    {
        if($this->request->isPost())
        {
            $categoriesFactory = new CategorieFactory();
            $categorieService = $categoriesFactory->createService($this->getServiceLocator());
            $categorieName = $this->getRequest()->getPost()["categoryName"];
            
            if(!$categorieService->isCategoryNameUsed($categorieName))
            {
                $categorieService->saveCategorie($categorieName);
            }
            
            $this->redirect()->toRoute('articles - create');
        }
        else
        {
            $this->redirect()->toRoute('home');
        }
    }
}
