<?php

class CommentaireController extends ManagerController
{
    private $commentaireModel;

    function __construct()
    {
        $this->commentaireModel = new commentaireModel();
        parent::__construct();
    }

    /**
     * Method qui récupère tout les commentaires de la BDD
     */
    function afficherToutLesCommentaires()
    {
        return $this->commentaireModel->toutLesCommentairesBDD();
    }

    /**
     * Method affiche la totalité des commentaires d'un article
     *
     * @param $id_article 
     */
    function afficheListeCommentaire($id_article)
    {
        return $this->commentaireModel->showAllComFromArticle($id_article);
    }

    /**
     * Method afficher un commentaire
     *
     * @param $id_com
     */
    function afficheCommentaire($id_com)
    {
        $id_com = $this->validatorHelper->getValue('id_com');
        return $this->commentaireModel->getCommentaire($id_com);
    }

    /**
     * Method ajouter un commentaire
     *
     * @param $id_article 
     * @param $id_compte 
     */
    function ajouterCommentaire($id_article, $id_compte)
    {
        $contenu_com = $this->validatorHelper->getValue('commentaire');
        if (!empty($contenu_com)) {
            $this->commentaireModel->postCom($id_article, $id_compte, $contenu_com);
            //je crée un array output sous format json qui sera parsé en JS pour poster le
            //commentaire de manière dynamique
            $output = [
                'pseudo' => CompteFacade::getComptePseudo(),
                'message' => 'commentaire posté!',
                'nb_comments' => $this->commentaireModel->getNbcomFromArticle($id_article),
                'commentaire' => $this->commentaireModel->getLastComFromArticle($id_article)
            ];
            echo json_encode($output); //retourne la représentation JSON d'une valeur
            exit;
        }
    }

    /**
     * Method supprimer un commentaire
     */
    function supprimerCommentaire()
    {
        $this->template = "view_profil/supCom.php";
        $id_com = $this->validatorHelper->getValue('id_com', 'integer');
        $this->setCom($this->afficheCommentaire($id_com));
        if (isset($_POST['submit'])) {
            $this->commentaireModel->deleteCom($id_com);
            //$this->setMessage('Commentaire supprimé', 'infos');
            return $this->redirectTo('Profil');
        }
        return $this->renderController();
    }


    /**
     * Method supprimer tout les commentaires posté par un compte
     *
     * @param $id_compte 
     */
    function supprimerToutLesCommentaires($id_compte)
    {
        return $this->commentaireModel->deleteAllComFromCompte($id_compte);
    }
}
