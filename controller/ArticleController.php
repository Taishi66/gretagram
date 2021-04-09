<?php

use CompteModel;
use ArticleModel;
use CompteFacade;
use ManagerController;
use CommentaireController;

class ArticleController extends ManagerController
{

    private $articleModel;
    private $commentaireController;
    private $compteModel;

    function __construct()
    {
        parent::__construct();

        $this->articleModel = new ArticleModel();
        $this->commentaireController = new CommentaireController();
        $this->compteModel = new CompteModel();
    }


    function afficheArticleController()
    {
        $id_article = $this->validatorHelper->getValue('id_article', 0, 'integer');
        $this->template = 'profil/article.php';

        //Si je souhaite modifier l'article
        if (!empty($this->validatorHelper->getValue('titre'))) {
            $this->modifierArticle($id_article);
            $this->setMessage('article modifié!');
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
            $this->setMessage('commentaire posté!');
            /*} else {
            $this->setMessage('commentaire non publié');*/
        }
        //Aller dans commentaireController pour effacer un com

        $this->setArticle($this->articleModel->getArticleModel($id_article));
        $this->setCom($this->commentaireController->afficheListeCommentaire($id_article));

        $this->setCompteVisite(CompteFacade::getUserCompte($this->validatorHelper->getValue('id_compte')));
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
        return $articles;
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
    function nouvelArticle($media, $titre, $contenu, $date_art, $id_compte)
    {
        $id_compte = CompteFacade::getCompteId();
        //$this->validatorHelper->upload();
        $titre = $this->validatorHelper->getValue('titre');
        $contenu = $this->validatorHelper->getValue('contenu');
        $date_art = $this->validatorHelper->getValue('date_art');
        if (!empty($media) && !empty($titre) && !empty($contenu) && !empty($date_art)) {
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
     * Method modifierArticle
     *
     * @param $id_article $id_article [explicite description]
     *
     * @return void
     */
    function modifierArticle($id_article)
    {
        $media = $this->validatorHelper->getValue('media');
        $titre = $this->validatorHelper->getValue('titre');
        $contenu = $this->validatorHelper->getValue('contenu');
        $date_art = $this->validatorHelper->getValue('date_art');

        return $this->articleModel->setArticleModel($media, $titre, $contenu, $date_art, $id_article);
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
        $this->setArticle($this->articleModel->lastArticles());
        $this->setCom($this->commentaireController->afficherToutLesCommentaires());
        $this->setSuggestion($this->compteModel->accountSuggestion());
        return $this->renderController();
    }
}
