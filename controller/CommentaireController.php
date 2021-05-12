<?php

class CommentaireController extends ManagerController
{
    private $commentaireModel;

    function __construct()
    {
        $this->commentaireModel = new CommentaireModel();
        parent::__construct();
    }

    /**
     * Method afficherToutLesCommentaires
     *
     * @return void
     */
    function afficherToutLesCommentaires()
    {
        return $this->commentaireModel->showCommentFromDb();
    }

    /**
     * Method afficheListeCommentaire
     *
     * @param $id_article $id_article [explicite description]
     *
     * @return void
     */
    function afficheListeCommentaire($id_article)
    {
        return $this->commentaireModel->showAllComFromArticle($id_article);
    }

    /**
     * Method afficheCommentaire
     *
     * @param $id_com $id_com [explicite description]
     *
     * @return void
     */
    function afficheCommentaire($id_com)
    {
        $id_com = $this->validatorHelper->getValue('id_com');
        return $this->commentaireModel->getCommentaireModel($id_com);
    }

    /**
     * Method ajouterCommentaire
     *
     * @param $id_article $id_article [explicite description]
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function ajouterCommentaire($id_article, $id_compte)
    {
        $contenu_com = $this->validatorHelper->getValue('commentaire');
        if (!empty($contenu_com)) {
            $this->commentaireModel->postCom($id_article, $id_compte, $contenu_com);
            $output = [
                'pseudo' => CompteFacade::getComptePseudo(),
                'message' => 'commentaire posté!',
                'nb_comments' => $this->commentaireModel->getNbcomFromArticle($id_article),
                'commentaire' => $this->commentaireModel->getLastComFromArticle($id_article)
            ];
            echo json_encode($output);
            exit;
        }
    }

    /**
     * Method supprimerCommentaire
     *
     * @return void
     */
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


    /**
     * Method supprimerToutLesCommentaires
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function supprimerToutLesCommentaires($id_compte)
    {
        return $this->commentaireModel->deleteAllComFromCompte($id_compte);
    }
}
