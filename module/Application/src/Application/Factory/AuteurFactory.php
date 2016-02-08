<?php
namespace Application\Factory;


use Application\Service\Auteur;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuteurFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $em = $serviceManager->get('Doctrine\ORM\EntityManager');
        $auteurRepository = $em->getRepository('Application\Entity\Auteur');
         
        return new AuteurService($em, $auteurRepository);
    }
    
}