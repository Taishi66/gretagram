<?php


class CompteController extends ManagerController
{
    private $commentaireModel;
    private $compteModel;
    private $likeController;

    function __construct()
    {
        $this->compteModel = new compteModel();
        $this->commentaireModel = new commentaireModel();
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
        $photo = $this->uploadHelper->upload("photo", SessionFacade::getUserName());
        $this->template = 'view_inscription/creAccount.php';

        if (!empty($pseudo) && !empty($photo) && !empty($description_compte)) {
            //var_dump($pseudo);
            if ($this->compteModel->creAccount($id, $photo, $pseudo, $description_compte)) {
                $this->redirectTo('Profil');
                exit;
            } else {
                $this->setMessage('Création de compte non enregistrée', 'warning');
            }
            $this->setMessage('Données manquantes', 'warning');
        }
        return $this->renderController();
    }

    function voirCompteArticle()
    {
        $id_article = $this->validatorHelper->getValue('id_article');
        return $this->compteModel->getCompteFromArticle($id_article);
    }

    function suggestionCompte()
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
    function afficheProfil($id_compte = null)
    {
        if ($id_compte == CompteFacade::getCompteId()) {
            $this->redirectTo('Profil');
            exit;
        }

        $this->template = ('view_profil/compte.php');
        //$this->setCompte($this->compteModel->showProfil($id_compte));
        $this->setCom($this->commentaireModel->showAllcomFromArticle($id_compte));
        $compteVisite = $this->compteModel->showProfil($id_compte);
        $compteVisite_ = array();
        if (isset($compteVisite)) {
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
    function modifierCompte($id_compte)
    {
        $id_compte = CompteFacade::getCompteId();
        $pseudo = $this->validatorHelper->getValue("pseudo");
        $photo = $this->uploadHelper->upload("photo", CompteFacade::getComptePseudo());
        $description_compte = $this->validatorHelper->getValue("description_compte");
        $this->template = 'view_profil/monProfil.php';

        if (!empty($pseudo) || !empty($photo) || !empty($description_compte)) {
            $this->compteModel->setCompte($pseudo, $photo, $description_compte, $id_compte);
            return $this->renderController();
        } else {
            $this->setMessage('Modification échouée', 'warning');
            return $this->renderController();
        }
        return $this->renderController();
    }

    function afficherToutLesComptes()
    {
        $this->template = 'view_page/explore.php';
        $this->setCompteVisite($this->compteModel->seeAllAccounts());
        return $this->renderController();
    }
}
