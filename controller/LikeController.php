<?php

class LikeController extends ManagerController
{
    private $likeModel;


    function __construct()
    {
        $this->likeModel = new likeModel();
        parent::__construct();
    }

    function toggleLike()
    {
        $this->template = 'article.php';
        $id_article = $this->validatorHelper->getValue("id_article");
        $id_compte = CompteFacade::getCompteId();
        $is_liked = false;
        if ($this->likeModel->getLikeForArticleForCompte($id_article, $id_compte)) {
            $this->likeModel->enleverLike($id_article, $id_compte);
        } else {
            $this->likeModel->ajouterLike($id_article, $id_compte);
            $is_liked = true;
        }
        $output = [
            'nb_likes' => $this->likeModel->getNbLikeForArticle($id_article),
            'is_liked' => $is_liked,
        ];

        echo json_encode($output);
        exit;
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
