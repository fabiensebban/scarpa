<?php
namespace Application\Factory;


use Application\Service\CategorieService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategorieFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $em = $serviceManager->get('Doctrine\ORM\EntityManager');
        $categorieRepository = $em->getRepository('Application\Entity\Categorie');
         
        return new CategorieService($em, $categorieRepository);
    }
}