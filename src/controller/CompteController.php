<?php

class CompteController extends ManagerController
{
    private $commentaireModel;
    private $compteModel;
    private $likeController;

    public function __construct()
    {
        $this->compteModel = new CompteModel();
        $this->commentaireModel = new CommentaireModel();
        $this->likeController = new LikeController();
        parent::__construct();
    }

    /**
     * Methode pour créer un nouveau compte
     *
     */
    public function nouveauCompte()
    {
        $id = SessionFacade::getUserId();
        $pseudo = $this->validatorHelper->getValue("pseudo");
        $description_compte = $this->validatorHelper->getValue("description_compte");
        $this->template = 'view_inscription/creAccount.php';
        $this->setMessage('Créez votre compte pour pouvoir partager vos photos!', 'success');
        $photo = $this->uploadHelper->upload("photo", SessionFacade::getUserName());


        if (!empty($pseudo) && !empty($photo) && !empty($description_compte)) {
            var_dump("ici");
            $this->compteModel->creAccount($id, $photo, $pseudo, $description_compte);
            $this->redirectTo('Profil');
            exit;
        } else if (empty($pseudo) || empty($photo) || empty($description_compte)) {
            $this->setMessage('Compte non enregistrée - champs invalide', 'warning');
        }

        return $this->renderController();
    }



    /**
     * Method afficher un compte à partir d'un article
     *
     * @return void
     */
    public function voirCompteArticle()
    {
        $id_article = $this->validatorHelper->getValue('id_article');
        return $this->compteModel->getCompteFromArticle($id_article);
    }

    /**
     * Method Suggestion des comptes dans HOME
     *
     * @return void
     */
    public function suggestionCompte()
    {
        return $this->compteModel->accountSuggestion();
    }
    /**
     * Method afficheProfil
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    public function afficheProfil($id_compte = null)
    {
        if ($id_compte == CompteFacade::getCompteId()) {
            $this->redirectTo('Profil');
            exit;
        }

        $this->template = ('view_profil/compte.php');
        //$this->setCompte($this->compteModel->showProfil($id_compte));
        $this->setCom($this->commentaireModel->showAllcomFromArticle($id_compte));
        $compteVisite = $this->compteModel->showProfil($id_compte);
        $compteVisite_ = array(); //je crée un array vide
        if (isset($compteVisite)) { //et je push dedans de nouvelles clefs/valeurs pour les afficher ensuite
            foreach ($compteVisite as $compte) {
                $compte_ = $compte;
                $compte_['nbLikesForArticle'] = $this->likeController->getNbLikes($compte['id_article']);
                $compte_['nbCommentaireForArticle'] = $this->commentaireModel->getNbcomFromArticle($compte['id_article']);
                array_push($compteVisite_, $compte_);
            }
            $this->setCompteVisite($compteVisite_);
        }
        return $this->renderController();
    }

    /**
     * Method modifier son compte
     *
     * @param $id_compte
     */
    public function modifierCompte($id_compte)
    {
        $id_compte = CompteFacade::getCompteId();
        $pseudo = $this->validatorHelper->getValue("pseudo");
        $photo = $this->uploadHelper->upload("photo", CompteFacade::getComptePseudo());
        $description_compte = $this->validatorHelper->getValue("description_compte");
        $this->template = 'view_profil/monProfil.php';
        //Pas besoin de remplir tout les champs
        if (!empty($pseudo) || !empty($photo) || !empty($description_compte)) {
            $this->compteModel->setCompte($pseudo, $photo, $description_compte, $id_compte);
            return $this->setMessage('Compte modifié', 'primary');
        } else {
            $this->setMessage('Modification échouée', 'warning');
            return $this->renderController();
        }
        return $this->renderController();
    }

    /**
     * Method afficher Tout Les Comptes
     *
     * @return void
     */
    public function afficherToutLesComptes()
    {
        $this->template = 'view_page/explore.php';
        $this->setCompteVisite($this->compteModel->seeAllAccounts());
        return $this->renderController();
    }
}
