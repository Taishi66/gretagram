<?php

class ArticleController extends ManagerController
{

    private $articleModel;
    private $commentaireController;
    private $compteController;


    function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->commentaireController = new CommentaireController();
        $this->compteController = new CompteController();
        parent::__construct();
    }


    function afficheArticle()
    {
        $id_article = $this->validatorHelper->getValue('id_article', 0, 'integer');
        $this->template = 'profil/article.php';

        //Si je souhaite modifier l'article
        if (!empty($_POST['titre'])) {
            $this->updateArticle($id_article);
            $this->setMessage('article modifié!');
        }
        //Si je souhaite effacer l'article
        if (isset($_POST['submit'])) {
            $this->deleteArticle($id_article);
            $this->compteController->minusPublications(CompteFacade::getCompteId());
            return $this->redirectTo('profil');
        }
        //Si je souhaite laisser un commentaire à l'article
        else if (!empty($_POST['commentaire'])) {
            $this->commentaireController->addCom($id_article, CompteFacade::getCompteId());
            $this->setMessage('commentaire posté!');

            /*} else {
            $this->setMessage('commentaire non publié');*/
        }

        $this->setArticle($this->articleModel->getArticle($id_article));
        $this->setCom($this->commentaireController->afficheListeCom($id_article));
        return $this->renderController();
    }

    /**
     * affichelisteArticle
     *
     * @param  int $id_article
     * @return void
     */
    function afficheListeArticles($id_compte)
    {
        $id_compte = CompteFacade::getCompteId();
        $articles = $this->articleModel->getAllArticles($id_compte);
        return $articles;
    }

    /**
     * newArticle
     *
     * @param  string $media
     * @param  string $titre
     * @param  string $contenu
     * @param  date $date_art
     * @param  int $id_compte
     * @return void
     */
    function newArticle($media, $titre, $contenu, $date_art, $id_compte)
    {
        $id_compte = CompteFacade::getCompteId();
        $media = @$_POST['media'];

        $titre = @$_POST['titre'];
        $contenu = @$_POST['contenu'];
        $date_art = @$_POST['date_art'];

        if (!empty($media) && !empty($titre)) {
            if ($this->articleModel->createArticle($media, $titre, $contenu, $date_art, $id_compte)) {
                $this->template = 'monProfil.php';
                return $this->renderController();
            } else {
                $this->setMessage('Article non créé');
            }
            $this->setMessage('Données manquantes');
        }
        return $this->renderController();
    }

    /**
     * updateArticle
     *
     * @param  string $media
     * @param  string $titre
     * @param  string $contenu
     * @param  date $date_art
     * @param  int $id_coid_article
     * @param  int $id_compte
     * @return void
     */
    function updateArticle($id_article)
    {
        $media = @$_POST['media'];
        $titre = @$_POST['titre'];
        $contenu = @$_POST['contenu'];
        $date_art = @$_POST['date_art'];

        return $this->articleModel->setArticle($media, $titre, $contenu, $date_art, $id_article);
    }

    /**
     * deleteArticle
     *
     * @param  int $id_article
     * @return void
     */
    function deleteArticle($id_article)
    {
        $this->articleModel->deleteArticle($id_article);
    }

    function showLastArticles()
    {
        $this->template = 'home.php';
        $this->setArticle($this->articleModel->lastArticles());

        return $this->renderController();
    }
}
