<?php
namespace Application\Service;

use Application\Entity\Commentaire;
use Application\Entity\Article;
use Application\Factory\ArticleFactory;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\SmtpOptions;

class CommentaireService
{
    public function __construct($em, $commentaireRepository){
        $this->em = $em;
        $this->commentaireRepository = $commentaireRepository;
    }

    private function sendMail($sendTo, $user, $article, $comment){
    
        $message = new Message();
        $message->addTo($sendTo)
        ->addFrom('scarpa.zend@gmail.com')
        ->setSubject('Scarpa - New comment in: ' . $article->getTitre());
    
        // Setup SMTP transport using LOGIN authentication
        $transport = new SmtpTransport();
        $options   = new SmtpOptions(array(
            'host'              => 'smtp.gmail.com',
            'connection_class'  => 'login',
            'connection_config' => array(
                'ssl'       => 'tls',
                'username' => 'scarpa.zend@gmail.com',
                'password' => 'scarpa1234'
            ),
            'port' => 587,
        ));
        $messageToSend = '<p>Hello.</p></br><p>The folowing comment have been posted by '. $user['nom'] .' on the article: </p>' . $article->getTitre() . '</br><p><i>'. $comment .'</i></p>';
        $html = new MimePart($messageToSend);
        $html->type = "text/html";
        $body = new MimeMessage();
        $body->addPart($html);
        $message->setBody($body);
        $transport->setOptions($options);
        $transport->send($message);
    }
    
    public function getAllActivesCommentaireFromArticleID($id)
    {
        $criteria = array('article' => $id,
                          'validation' => true
        );
        $orderBy = array('date' => 'desc');

        return $this->commentaireRepository->findBy($criteria, $orderBy, null, null);
    }
    
    public function getAllCommentaireFromArticleID($id)
    {
        $criteria = array('article' => $id);
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
        
        $this->sendMail($article->getAuteur()->getEmail(), $user, $article, $post['commentaire']);
    }
    
    public function getCommentaireByID($id)
    {
        return $this->commentaireRepository->findOneBy(array('id' => $id));
    }
    
    public function desactiverCommentaire($commentaireID)
    {
        $commentaire = new Commentaire();
        $commentaire = $this->getCommentaireByID($commentaireID);
        
        if($commentaire){
            if($commentaire->getValidation())
            {
                
                $commentaire->setValidation(false);
                $this->em->persist($commentaire);
                $this->em->flush();
            }
        }
    }
    
    public function activerCommentaire($commentaireID)
    { 
        $commentaire = new Commentaire();
        $commentaire = $this->getCommentaireByID($commentaireID);
        
        if($commentaire){
            if(!$commentaire->getValidation())
            {
                $commentaire->setValidation(true);
                $this->em->persist($commentaire);
                $this->em->flush();
            }
        }
    }
}