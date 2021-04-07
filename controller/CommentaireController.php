<?php

class CommentaireController extends ManagerController
{
    private $commentaireModel;

    function __construct()
    {
        $this->commentaireModel = new CommentaireModel();
        parent::__construct();
    }

    function afficheListeCommentaire($id_article)
    {
        return $this->commentaireModel->showAllCom($id_article);
    }

    function afficheCommentaire($id_com)
    {
        $id_com = $this->validatorHelper->getValue('id_com');
        return $this->commentaireModel->getCommentaireModel($id_com);
    }

    function ajouterCommentaire($id_article, $id_compte)
    {
        $this->template = 'profil/article.php';
        $contenu_com = $this->validatorHelper->getValue('commentaire');
        if (!empty($contenu_com)) {
            $this->commentaireModel->postCom($id_article, $id_compte, $contenu_com);
        }
        return $this->renderController();
    }

    function supprimerCommentaire()
    {
        $this->template = "supCom.php";
        $id_com = $this->validatorHelper->getValue('id_com', 'integer');
        $this->setCom($this->afficheCommentaire($id_com));
        if (isset($_POST['submit'])) {
            $this->commentaireModel->deleteCom($id_com);
            //$this->setMessage('Commentaire supprimé', 'infos');
            return $this->redirectTo('profil');
        }
        return $this->renderController();
    }
}
