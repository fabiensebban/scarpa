<?php
namespace Application\Factory;


use Application\Service\CommentaireService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommentaireFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $em = $serviceManager->get('Doctrine\ORM\EntityManager');
        $commentaireRepository = $em->getRepository('Application\Entity\Commentaire');
         
        return new CommentaireService($em, $commentaireRepository);
    }
}