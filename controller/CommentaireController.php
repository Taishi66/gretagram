<?php

class CommentaireController extends ManagerController
{
    private $commentaireModel;

    function __construct()
    {
        $this->commentaireModel = new CommentaireModel();
    }

    function afficheListeCom($id_article)
    {
        //var_dump($this->commentaireModel->showAllCom($id_article));
        return $this->commentaireModel->showAllCom($id_article);
    }

    function addCom($id_article, $id_compte)
    {
        $this->template = 'profil/article.php';
        $contenu_com = $_POST['commentaire'];
        if (!empty($_POST['commentaire'])) {
            $this->commentaireModel->postCom($id_article, $id_compte, $contenu_com);
        }
        return $this->renderController();
    }
}
