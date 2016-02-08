<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * AuteursController
 *
 * @author
 *
 * @version
 *
 */
class AuteursController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        return new ViewModel();
    }
    
}