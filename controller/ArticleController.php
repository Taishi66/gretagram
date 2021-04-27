<?php

use ArticleModel;
use CommentaireModel;
use ManagerController;

class ArticleController extends ManagerController
{

    private $articleModel;
    private $commentaireModel;
    private $LikeModel;
    private $commentaireController;
    private $compteModel;
    private $likeController;

    function __construct()
    {
        parent::__construct();

        $this->articleModel = new ArticleModel();
        $this->commentaireModel = new CommentaireModel();
        $this->LikeModel = new LikeModel();
        $this->commentaireController = new CommentaireController();
        $this->compteModel = new CompteModel();
        $this->likeController = new LikeController();
    }


    function afficheArticleController()
    {
        $id_article = $this->validatorHelper->getValue('id_article', 0, 'integer');
        $this->template = 'profil/article.php';

        //Si je souhaite modifier l'article
        if (!empty($this->validatorHelper->getValue('titre'))) {
            $this->modifierArticle();
            $this->setMessage('article modifié!');
            //return $this->redirectTo('article');
        }
        //Si je souhaite effacer l'article
        if (isset($_POST['submit'])) {
            $this->effacerArticle($id_article);
            CompteFacade::soustraitPublications();
            return $this->redirectTo('profil');
        }
        //Si je souhaite laisser un commentaire à l'article
        else if (!empty($this->validatorHelper->getValue('commentaire'))) {
            $this->commentaireController->ajouterCommentaire($id_article, CompteFacade::getCompteId());
            echo json_encode([
                'pseudo' => CompteFacade::getComptePseudo(),
                'message' => 'commentaire posté!',
                'nb_comments' => $this->commentaireModel->getNbcomFromArticle($id_article)
            ]);
            exit;
            /*} else {
            $this->setMessage('commentaire non publié');*/
        }
        //Aller dans commentaireController pour effacer un com

        //Si je souhaite liker l'article
        if (isset($_POST['like'])) {
            $this->likeController->toggleLike();
        }

        $this->setArticle($this->articleModel->getArticleModel($id_article));
        $this->setCom($this->commentaireController->afficheListeCommentaire($id_article));
        $this->setNbLikesForArticle($this->likeController->getNbLikes($id_article));
        $this->setArticleAlreadyLiked($this->likeController->checkIfUserHasLiked($id_article));
        $this->setCompteVisite($this->compteModel->getCompteFromArticle($id_article));
        return $this->renderController();
    }


    /**
     * Method afficheListeArticles
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function afficheListeArticles($id_compte)
    {
        $id_compte = CompteFacade::getCompteId();
        $articles = $this->articleModel->getAllArticles($id_compte);
        $articles_ = array();
        if (isset($articles)) {
            foreach ($articles as $article) {
                $article_ = $article;
                $article_['nbLikesForArticle'] = $this->likeController->getNbLikes($article['id_article']);
                $article_['nbCommentaireForArticle'] = $this->commentaireModel->getNbcomFromArticle($article['id_article']);
                array_push($articles_, $article_);
            }
        }
        /*echo '<pre>';
        var_dump($articles_);
        echo '</pre>';
        exit;*/
        return $articles_;
    }


    /**
     * Method nouvelArticle
     *
     * @param $media $media [explicite description]
     * @param $titre $titre [explicite description]
     * @param $contenu $contenu [explicite description]
     * @param $date_art $date_art [explicite description]
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function nouvelArticle($media = null, $id_compte = null, $titre = null, $contenu = null)
    {
        $media = $this->validatorHelper->upload('media');
        $id_compte = CompteFacade::getCompteId();
        $titre = $this->validatorHelper->getValue('titre');
        $contenu = $this->validatorHelper->getValue('contenu');
        if (!empty($media) && !empty($titre) && !empty($contenu)) {
            if ($this->articleModel->createArticle($media, $titre, $contenu, $id_compte)) {
                CompteFacade::plusPublication();
                $this->template = 'monProfil.php';
                return $this->renderController();
            } else {
                $this->setMessage('Article non créé', 'warning');
                return $this->renderController();
            }
        }
        return $this->renderController();
    }


    /**
     * Method modifierArticle
     *
     * @param $id_article $id_article [explicite description]
     *
     * @return void
     */
    function modifierArticle()
    {
        $id_article = $this->validatorHelper->getValue('id_article', 0, 'integer');
        $media = $this->validatorHelper->getValue('media');
        $titre = $this->validatorHelper->getValue('titre');
        $contenu = $this->validatorHelper->getValue('contenu');

        return $this->articleModel->setArticleModel($media, $titre, $contenu, $id_article);
    }


    /**
     * Method effacerArticle
     *
     * @param $id_article $id_article [explicite description]
     *
     * @return void
     */
    function effacerArticle($id_article)
    {
        $this->LikeModel->supprimeLike($id_article);
        $this->commentaireModel->deleteComAllFromArticle($id_article);
        $this->articleModel->deleteArticle($id_article);
    }

    /**
     * Method effacerToutLesArticle
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function effacerToutLesArticle($id_compte)
    {
        $this->articleModel->deleteAllArticles($id_compte);
    }

    /**
     * Method showLastArticles
     *
     * @return void
     */
    function showLastArticles()
    {
        $this->template = 'home.php';
        $articles = $this->articleModel->lastArticles();

        $articles_ = array();
        if (!empty($articles)) {
            foreach ($articles as $article) {
                $article_ = $article;
                $article_['commentaires'] = $this->commentaireModel->showAllComFromArticle($article['id_article']);
                $article_['nbLikesForArticle'] = $this->likeController->getNbLikes($article['id_article']);
                $article_['articleAlreadyLiked'] = $this->likeController->checkIfUserHasLiked($article['id_article']);

                array_push($articles_, $article_);
            }
        }

        $this->setArticle($articles_);
        $this->setSuggestion($this->compteModel->accountSuggestion());
        return $this->renderController();
    }
}
