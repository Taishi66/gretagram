<?php
include('model/articlesModel.php');

class ArticleController extends ManagerController
{

    private $articlesModel;


    function __construct()
    {
        $this->articlesModel = new ArticlesModel();
    }

    /**
     * afficheArticle
     *
     * @param  int $id_article
     * @return void
     */
    function afficheListeArticles($id_compte)
    {
        $id_compte = CompteFacade::getCompteId();
        $articles = $this->articlesModel->voirAllArticles($id_compte);
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
            if ($this->articlesModel->createArticle($media, $titre, $contenu, $date_art, $id_compte)) {
                $this->redirectTo('monProfil');
                exit;
            } else {
                $this->message = 'Article non créé';
            }
            $this->message = 'Données manquantes';
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
    function updateArticle($id_article, $media, $titre, $contenu, $date_art, $id_compte)
    {
        $id_compte = '';
        $media = @$_POST['media'];
        $titre = @$_POST['titre'];
        $contenu = @$_POST['contenu'];
        $date_art = @$_POST['date_art'];

        $this->articlesModel->modifierArticle($id_article, $media, $titre, $contenu, $date_art, $id_compte);
    }

    /**
     * deleteArticle
     *
     * @param  int $id_article
     * @return void
     */
    function deleteArticle($id_article)
    {
        $this->articlesModel->deleteArticle($id_article);
        $this->redirectTo('monProfil');
    }
}
