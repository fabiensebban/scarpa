<?php
namespace Application\Service;

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
}