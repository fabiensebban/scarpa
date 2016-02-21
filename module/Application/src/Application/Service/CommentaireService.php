<?php
namespace Application\Service;

use Application\Entity\Commentaire;
use Application\Entity\Article;

class CommentaireService
{
    public function __construct($em, $commentaireRepository){
        $this->em = $em;
        $this->commentaireRepository = $commentaireRepository;
    }

    public function getCommentaireFromArticleID($id)
    {
        $criteria = array('article' => $id,
                          'validation' => true
        );
        $orderBy = array('date' => 'desc');

        return $this->commentaireRepository->findBy($criteria, $orderBy, null, null);
    }
    
    public function saveCommentaire($post, $user, Article $article) 
    {
        $commentaireToSave = new Commentaire();
        $date = new \DateTime('now',  new \DateTimeZone( 'UTC' ));
        
        try
        {
            $commentaireToSave->setNom($user['nom']);
            $commentaireToSave->setEmail($user['email']);
            $commentaireToSave->setText($post['commentaire']);
            $commentaireToSave->setDate($date);
            $commentaireToSave->setArticle($article);
            $commentaireToSave->setValidation(true);
            
            $this->em->persist($commentaireToSave);
            $this->em->flush();
        }
        catch (\Exception $e){
            $this->getServiceLocator()->get('Zend\LogError')->err('Erreur lors de la sauvegarder du commentaire');
            throw $e;
        }
    }
}