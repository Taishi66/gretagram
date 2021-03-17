<?php

include("model/profilsModel.php");
include("controller/verificationController.php");


class ProfilsController
{
    /* public $nom;
    public $prenom;
    public $email;
    public $mdp;
*/
    private $profilsModel;
    private $verif;

    private $message = null;
    private $template = null;


    public function __construct()
    {
        $this->verif = new Verification();
        $this->profilsModel = new ProfilsModel();
    }


    public function renderController () {
        return [
            'template' => $this->template,
            'datas' => array(
                'message' => $this->message,
                'user' => SessionFacade::getUserSession()
            )
        ];
    }

    //------------------------------LISTE DES PROFILS------------------------------------------------
    public function afficherListeProfils()
    {
        $listeProfils = $this->profilsModels->listeProfils();
        include("view/profil/viewListeProfils.php");
    }

    //-----------------------------PROFIL CONNECTE-------------------------------------------
    public function afficherMonprofil($id_user)
    {
        $id_user = SessionFacade::getUserId();
        $profil = $this->profilsModel->Profil($id_user);
        $this->template =  'profil/monProfil.php';
        $this->message = 'test';
        return $this->renderController();
    }

    //-------------------------------------------INSCRIPTION------------------------------------
    public function setInscription()
    {
        // je verifie que j'ai envoyé le formulaire
        // si le formulaire est envoyé j'entre dans la condition
        // si non j'affiche la vue du formulaire dans else

        $nom = $this->verif->verfNomPrenom(@$_POST["nom"]);
        $prenom = $this->verif->verfNomPrenom(@$_POST["prenom"]);
        $email = $this->verif->verfEmail(@$_POST["email"]);

        $this->template = 'inscription.php';

        if ($email && $nom && $prenom) {
            $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
            //var_dump($this->nom);
            if ($this->profilsModel->inscription($email, $nom, $prenom, $mdp)) {
                SessionFacade::setUserSession($profil);
                $this->redirectTo('noAccount');
            } else {
                $this->message = 'Inscription non prise en compte';
            }
        }
        $this->renderController();
    }

    public function redirectTo($page){
        header('Location:?page='.$page);
        exit;
    }

    //--------------------------------------------CONNEXION-----------------------------------------
    public function getLogin()
    {
        $this->template = 'login.php';
        
        if (isset($_POST["email"])) {
            $email = $this->verif->verfEmail(@$_POST["email"]);
            $profil = $this->profilsModel->login($email);

            if (password_verify($_POST['mdp'], $profil['mdp'])) {
                SessionFacade::setUserSession($profil);
                header('Location:?page=monProfil');
                exit;
            } else {
                $this->message = 'Erreur de connexion';
            }
        }
        return $this->renderController();
    }


    //-----------------------------------------------------CREER UN COMPTE---------------------------------
    public function newAccount($id)
    {
        $id = @$_SESSION['id_user'];
        $pseudo = @$_POST['pseudo'];
        $description_compte = @$_POST['description_compte'];
        $photo = @$_POST['photo'];
        var_dump($id . '=controller');
        // exit;

        $this->template = 'creAccount.php';

        if (!empty($pseudo) && !empty($photo) && !empty($description_compte)) {
            var_dump($pseudo);
            if ($this->profilsModel->creAccount($id, $photo, $pseudo, $description_compte)) {
                header('Location:?page=monProfil');
                exit;
            } else {
                $this->message = 'Création compte non prise en compte';
            }
        }

        return $this->renderController();
    }
}
