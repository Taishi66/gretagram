<?php


class CompteController extends ManagerController
{
    private $commentaireModel;
    private $compteModel;
    private $commentaireController;

    function __construct()
    {
        $this->compteModel = new CompteModel();
        $this->commentaireModel = new CommentaireModel();
        $this->commentaireController = new CommentaireController();
        parent::__construct();
    }

    /**
     * newAccount
     *
     * @param  int $id
     * @return void
     */
    public function nouveauCompte()
    {
        $id = SessionFacade::getUserId();
        $pseudo = $this->validatorHelper->getValue("pseudo");
        $description_compte = $this->validatorHelper->getValue("description_compte");
        $photo = $this->validatorHelper->upload("photo");
        // exit;
        $this->template = 'creAccount.php';

        if (!empty($pseudo) && !empty($photo) && !empty($description_compte)) {
            //var_dump($pseudo);
            if ($this->compteModel->creAccount($id, $photo, $pseudo, $description_compte)) {
                $this->redirectTo('profil');
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
        //$id_compte = $this->validatorHelper->getValue('id_compte');
        if ($id_compte == CompteFacade::getCompteId()) {
            $this->redirectTo('profil');
            exit;
        }

        $this->template = ('profil/compte.php');
        //$id_compte = $this->validatorHelper->getValue('id_compte');
        $this->setCompte($this->compteModel->showProfil($id_compte));
        $this->setCom($this->commentaireModel->showAllcom($id_compte));
        return $this->renderController();
    }

    /**
     * Method modifierCompte
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function modifierCompte($id_compte)
    {
        $id_compte = CompteFacade::getCompteId();
        $pseudo = $this->validatorHelper->getValue("pseudo");
        $photo = $_POST["photo"];
        $description_compte = $this->validatorHelper->getValue("description_compte");
        $this->template = 'monProfil.php';

        if (!empty($pseudo) && !empty($_POST['photo']) && !empty($description_compte)) {
            $this->compteModel->setCompteModel($pseudo, $photo, $description_compte, $id_compte);
            return $this->renderController();
        } else {
            $this->setMessage('Modification échouée', 'warning');
            return $this->renderController();
        }
        return $this->renderController();
    }

    function afficherToutLesComptes()
    {
        $this->template = 'explore.php';
        $this->setCompteVisite($this->compteModel->seeAllAccounts());
        return $this->renderController();
    }
}
