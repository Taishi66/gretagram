<?php

include("model/profilsModel.php");
include("controller/verificationController.php");


class ProfilsController extends ManagerController
{
    private $article;
    private $profilsModel;
    private $verif;



    public function __construct()
    {
        $this->verif = new Verification();
        $this->article = new ArticleController();
        $this->profilsModel = new ProfilsModel();
    }

    /**
     * afficherListeProfils
     *
     * @return void
     */
    public function afficherListeProfils()
    {
        $listeProfils = $this->profilsModels->listeProfils();
        $this->template = 'home.php';
        return $this->renderController();
    }

    /**
     * afficherMonprofil
     *
     * @param  int $id_user
     * @return void
     */
    public function afficherMonprofil($id_user, $id_compte)
    {
        $this->template = 'profil/monProfil.php';
        $this->setCompte(CompteFacade::getUserCompte($id_compte));

        return $this->renderController();
    }

    /**
     * setInscription
     *
     * @return void
     */
    public function setInscription()
    {
        // je verifie que j'ai envoyé le formulaire
        // si le formulaire est envoyé j'entre dans la condition
        // si non j'affiche la vue du formulaire dans else

        $this->template = 'inscription.php';

        $nom = $this->verif->verfNomPrenom(@$_POST["nom"]);
        $prenom = $this->verif->verfNomPrenom(@$_POST["prenom"]);
        $email = $this->verif->verfEmail(@$_POST["email"]);

        if (!empty($email) && !empty($nom) && !empty($prenom)) {
            $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);

            if ($this->profilsModel->inscription($nom, $prenom, $email, $mdp)) {

                $profil = $this->profilsModel->Login($email);
                SessionFacade::setUserSession($profil);
                $this->redirectTo('noAccount');
                exit;
            } else {
                $this->message = 'Inscription échouée';
            }
        } else {
            $this->renderController();
        }
        return  $this->renderController();
    }

    /**
     * newAccount
     *
     * @param  int $id
     * @return void
     */
    public function newAccount($id)
    {
        var_dump(SessionFacade::getUserId());
        $id = SessionFacade::getUserId();
        $pseudo = @$_POST['pseudo'];
        $description_compte = @$_POST['description_compte'];
        $photo = @$_POST['photo'];
        var_dump($id . '=controller');
        // exit;
        $this->template = 'creAccount.php';

        if (!empty($pseudo) && !empty($photo) && !empty($description_compte)) {
            var_dump($pseudo);
            if ($this->profilsModel->creAccount($id, $photo, $pseudo, $description_compte)) {
                $this->redirectTo('monProfil');
                exit;
            } else {
                $this->message = 'Création de compte non enregistrée';
            }
            $this->message = 'Données manquantes';
        }
        return $this->renderController();
    }

    /**
     * getLogin
     *
     * @return void
     */
    public function getLogin()
    {
        $this->template = 'login.php';

        if (isset($_POST["email"])) {

            $email = $this->verif->verfEmail(@$_POST["email"]);
            $profil = $this->profilsModel->login($email);

            if (password_verify($_POST['mdp'], $profil['mdp'])) {

                SessionFacade::setUserSession($profil);
                $this->redirectTo('monProfil');
                exit;
            } else {
                $this->message = 'Connexion échouée';
            }
        } else {
            $this->message = 'Données erronées';
        }
        return $this->renderController();
    }
}
