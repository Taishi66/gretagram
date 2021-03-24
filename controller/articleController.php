<?php
include('./model/articlesModel.php');


class ArticleController extends ProfilsController
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
    function afficheArticle($id_article)
    {
        $article = $this->articlesModel->voirArticle($id_article);
        return $article;
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
        $id_compte = '';
        $media = @$_POST['media'];
        $titre = @$_POST['titre'];
        $contenu = @$_POST['contenu'];
        $date_art = @$_POST['date_art'];

        if (!empty($img_art) && !empty($titre)) {
            if ($this->articlesModel->créerArticle($media, $titre, $contenu, $date_art, $id_compte)) {
                $this->redirectTo('monProfil');
                exit;
            } else {
                $this->message = 'Article non crée';
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
    function updateArticle($id_article, $img_art, $titre, $contenu, $date_art, $id_compte)
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
