<?php

class LikeController extends ManagerController
{
    private $likeModel;


    function __construct()
    {
        $this->likeModel = new LikeModel();
        parent::__construct();
    }

    function toggleLike()
    {
        $this->template = 'article.php';
        $id_article = $this->validatorHelper->getValue("id_article");
        $id_compte = CompteFacade::getCompteId();
        if ($this->likeModel->getLikeForArticleForCompte($id_article, $id_compte)) {
            $this->likeModel->enleverLike($id_article, $id_compte);
        } else {
            $this->likeModel->ajouterLike($id_article, $id_compte);
        }


        return $this->renderController();
    }

    function getNbLikes($id_article)
    {
        return $this->likeModel->getNbLikeForArticle($id_article);
    }

    function checkIfUserHasLiked($id_article)
    {
        $id_compte = CompteFacade::getCompteId();
        return $this->likeModel->getLikeForArticleForCompte($id_article, $id_compte);
    }
}
