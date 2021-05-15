<?php

class ArticleController extends ManagerController
{
    private $articleModel;
    private $commentaireModel;
    private $commentaireController;
    private $compteModel;
    private $likeController;
    private $likeModel;

    public function __construct()
    {
        parent::__construct();

        $this->articleModel = new ArticleModel();
        $this->commentaireModel = new CommentaireModel();
        $this->commentaireController = new CommentaireController();
        $this->compteModel = new CompteModel();
        $this->likeModel = new LikeModel();
        $this->likeController = new LikeController();
    }


    /**
     * Method Affiche un article
     *        Modifier
     *        Effacer
     *        Commenter
     *        Liker
     * @return void
     */
    public function afficheArticleController()
    {
        $id_article = $this->validatorHelper->getValue('id_article', 0, 'integer');
        $this->template = 'view_profil/article.php';

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
            return $this->redirectTo('Profil');
        }
        //Si je souhaite laisser un commentaire à l'article
        elseif (!empty($this->validatorHelper->getValue('commentaire'))) {
            $this->commentaireController->ajouterCommentaire($id_article, CompteFacade::getCompteId());
            return $this->renderController();
        }
        //Aller dans commentaireController pour effacer un com

        //Si je souhaite liker l'article
        if (isset($_POST['like'])) {
            $this->likeController->toggleLike();
        }

        $this->setArticle($this->articleModel->getArticle($id_article));
        $this->setCom($this->commentaireController->afficheListeCommentaire($id_article));
        $this->setNbLikesForArticle($this->likeController->getNbLikes($id_article));
        $this->setArticleAlreadyLiked($this->likeController->checkIfUserHasLiked($id_article));
        $this->setCompteVisite($this->compteModel->getCompteFromArticle($id_article));
        return $this->renderController();
    }


    /**
     * Method affiche la totalité des articles du compte
     *
     * @param $id_compte
     */
    public function afficheListeArticles($id_compte)
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
     * Method Créer un nouvel article
     *
     * @param $media
     * @param $titre
     * @param $contenu
     * @param $date_art
     * @param $id_compte
     */
    public function nouvelArticle($media = null, $id_compte = null, $titre = null, $contenu = null)
    {
        $media = $this->uploadHelper->upload('media', CompteFacade::getComptePseudo());
        $id_compte = CompteFacade::getCompteId();
        $titre = $this->validatorHelper->getValue('titre');
        $contenu = $this->validatorHelper->getValue('contenu');
        if (!empty($media) && !empty($titre) && !empty($contenu)) {
            $this->articleModel->createArticle($media, $titre, $contenu, $id_compte);
            CompteFacade::plusPublication();
            $this->template = 'view_profil/monProfil.php';
            return $this->renderController();
        } else {
            $this->setMessage('Article non créé', 'warning');
            return $this->renderController();
        }

        return $this->renderController();
    }


    /**
     * Method modifier un article
     *
     * @param $id_article
     */
    public function modifierArticle()
    {
        $id_article = $this->validatorHelper->getValue('id_article', 0, 'integer');
        $media = $this->uploadHelper->upload('media', CompteFacade::getComptePseudo());
        $titre = $this->validatorHelper->getValue('titre');
        $contenu = $this->validatorHelper->getValue('contenu');

        return $this->articleModel->setArticle($media, $titre, $contenu, $id_article);
    }


    /**
     * Method effacer un article
     *
     * @param $id_article
     */
    public function effacerArticle($id_article)
    {
        $this->likeModel->supprimeLike($id_article);
        $this->commentaireModel->deleteComAllFromArticle($id_article);
        $this->articleModel->deleteArticle($id_article);
    }

    /**
     * Method effacer tout les articles d'un compte
     *
     * @param $id_compte $id_compte [explicite description]
     */
    public function effacerToutLesArticle($id_compte)
    {
        $this->articleModel->deleteAllArticles($id_compte);
    }

    /**
     * Method afficher les articles dans l'ordre du plus récent au plus vieux
     */
    public function afficherDerniersArticles()
    {
        $this->template = 'view_page/home.php';
        $articles = $this->articleModel->lastArticles();

        $articles_ = array(); //je crée un array vide
        if (!empty($articles)) {
            foreach ($articles as $article) { //Et je push dedans de nouvelles clefs/valeurs pour pouvoir les afficher
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
