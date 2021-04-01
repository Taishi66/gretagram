<?php

class CommentaireController extends ManagerController
{
    private $commentaireModel;

    function __construct()
    {
        $this->commentaireModel = new CommentaireModel();
    }

    function addCom($id_article, $id_compte)
    {
        $this->template = 'article.php';
        $contenu_com = $_POST['commentaire'];
        //$id_article = $this->validatorHelper->getValue('id_article', 0, 'integer');
        //$id_compte = CompteFacade::getCompteId();
        if (!empty($_POST['commentaire'])) {
            $this->commentaireModel->postCom($id_article, $id_compte, $contenu_com);
            return $this->redirectTo('article');
        }
        return $this->renderController();
    }
}
