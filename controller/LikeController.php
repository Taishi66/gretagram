<?php

class LikeController extends ManagerController
{
    private $likeModel;


    public function __construct()
    {
        $this->likeModel = new likeModel();
        parent::__construct();
    }

    /**
     * Method permet de liker/disliker un article
     *
     */
    public function toggleLike()
    {
        $this->template = 'article.php';
        $id_article = $this->validatorHelper->getValue("id_article");
        $id_compte = CompteFacade::getCompteId();
        $is_liked = false;
        if ($this->likeModel->getLikeForArticleForCompte($id_article, $id_compte)) {
            //S'il récupère un like qui correspond aux id en paramètre alors on retire le like
            $this->likeModel->enleverLike($id_article, $id_compte);
        } else {
            //S'il ne trouve pas de correspondance alors on ajoute le like
            //is_like devient true
            $this->likeModel->ajouterLike($id_article, $id_compte);
            $is_liked = true;
        }
        $output = [ //ces données serviront à gérer les likes dynamiquement en JS (app.js)
            'nb_likes' => $this->likeModel->getNbLikeForArticle($id_article),
            'is_liked' => $is_liked,
        ];

        echo json_encode($output); //Retourne la représentation des valeurs en JSON (app.js)
        exit;
    }

    /**
     * Method récupère le nombre de like d'un article
     *
     * @param $id_article
     */
    public function getNbLikes($id_article)
    {
        return $this->likeModel->getNbLikeForArticle($id_article);
    }

    /**
     * Method vérifie si l'user connecté a déjà liké
     *
     * @param $id_article $id_article [explicite description]
     */
    public function checkIfUserHasLiked($id_article)
    {
        $id_compte = CompteFacade::getCompteId();
        return $this->likeModel->getLikeForArticleForCompte($id_article, $id_compte);
    }
}
