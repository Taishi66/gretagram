<?php


class CompteController extends ManagerController
{
    private $compteModel;

    function __construct()
    {
        $this->compteModel = new CompteModel();
    }

    function modifCompte($id_compte)
    {
        $id_compte = CompteFacade::getCompteId();
        $pseudo = $_POST['pseudo'];
        $photo = $_POST['photo'];
        $description_compte = $_POST['description_compte'];
        $this->template = 'monProfil.php';
        if (!empty($_POST['pseudo']) && !empty($_POST['photo']) && !empty($_POST['description_compte'])) {
            $this->compteModel->setCompteModel($pseudo, $photo, $description_compte, $id_compte);
            return $this->renderController();
        } else {
            $this->setMessage('Modification échouée');
        }
        return $this->renderController();
    }


    function addPublications($id_compte)
    {
        $resultat = $this->compteModel->incrementerPublications($id_compte);
        return $resultat;
    }

    function minusPublications($id_compte)
    {
        $resultat = $this->compteModel->decrementerPublications($id_compte);
        return $resultat;
    }
}
