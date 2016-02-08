<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * ErrorController
 *
 * @author
 *
 * @version
 *
 */
class ErrorController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated ErrorController::indexAction() default action
        return new ViewModel();
    }
}