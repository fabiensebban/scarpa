<?php
namespace Application\Service;


use Application\Entity\Article as Article;
use Application\Entity\Auteur;
use Application\Entity\Categorie;
use DateTime;


class ArticleService
{
    public function __construct($em, $articleRepository){
        $this->em = $em;
        $this->articleRepository = $articleRepository;
    }
    
    /**
     * @var Article
     */
    private $artciles;
    
    /**
     * @param Article $articles
     */
    public function setArticles(Article $articles)
    {
        $this->articles = $articles;
    }
    
    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->articles;
    }
    
    
    public function getArticleByID($id)
    {
        return $this->articleRepository->findOneBy(array('id' => $id));
    }
    
    public function getAllActivesArticles()
    {
        $criteria = array('en_ligne' => true);
        $orderBy = array('date' => 'desc');

        return $this->articleRepository->findBy($criteria, $orderBy, null, null);
    }
    
    public function saveArticle($post, Categorie $categorie, Auteur $auteur)
    {
        $articleToSave = new Article();
        $date = new \DateTime('now',  new \DateTimeZone( 'UTC' ));
        
        
        try
        {
            $articleToSave->setAuteur($auteur);
            $articleToSave->setCategorie($categorie);
            $articleToSave->setTitre($post["titre"]);
            $articleToSave->setContenu($post["contenu"]);
            $articleToSave->setDate($date);
            $articleToSave->setChapeau("c");
            $articleToSave->setEn_ligne(isset($post["en_ligne"])? true : false);
            
            $this->em->persist($articleToSave);
            $this->em->flush();
        }
        catch (\Exception $e){
            $this->getServiceLocator()->get('Zend\LogError')->err('Erreur au moment de sauvegarder un article');
            throw $e;
        }
    }
    
    public function isValidPost($post)
    {

        $error =array();
        $hasError = false;
        
        if($post["categorie"] != null && $post["titre"] != null)
        {
            $validation = array('valide' => true);
            return $validation;
        }
        if ($post["categorie"] == null )
        {
            array_push($error, 'Please choose a category');
            $hasError = true;
        }
        if($post["titre"] == null)
        {
            array_push($error, 'Please choose a title');
            $hasError = true;
        }
        if($hasError)
        {
            $validation = array('valide' => false,
                                'error'  => $error
            );
        }
        
        return $validation;
    }
}