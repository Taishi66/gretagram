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
    function afficheProfil($id_compte)
    {
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
}
