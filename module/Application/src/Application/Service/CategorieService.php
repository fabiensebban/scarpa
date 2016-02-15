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
}