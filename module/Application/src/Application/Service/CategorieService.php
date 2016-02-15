<?php
namespace Application\Service;

use Application\Entity\Categorie as Categorie;

class CategorieService
{
    public function __construct($em, $categorieRepository){
        $this->em = $em;
        $this->categorieRepository = $categorieRepository;
    }

    /**
     * @var Categorie
     */
    private $categorie;
    
    /**
     * @param Categorie $categorie
     */
    public function setCategorie(Categorie $categorie)
    {
        $this->categorie = $categorie;
    }
    
    /**
     * @return Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    public function getAllCategories()
    {
        return $this->categorieRepository->findAll();
    }
    
    public function getById($id)
    {
        return $this->categorieRepository->find($id);
    }
    
    public function isCategoryNameUsed($name)
    {
        return $this->categorieRepository->findBy(array('nom' => $name)) == null ? false : true;
    }
    
    public function saveCategorie($name) 
    {
        $categorieToSave = new Categorie();
        
        try 
        {
            $categorieToSave->setNom($name);
            $categorieToSave->setUrl("/". $name);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
        
        $this->em->persist($categorieToSave);
        $this->em->flush();
    }
}