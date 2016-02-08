<?php
namespace Application\Factory;


use Application\Service\ArticleService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ArticleFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $em = $serviceManager->get('Doctrine\ORM\EntityManager');
        $articleRepository = $em->getRepository('Application\Entity\Article');
         
        return new ArticleService($em, $articleRepository);
    }
    
}