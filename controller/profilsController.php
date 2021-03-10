<?php

include("model/profilsModel.php");
include("controller/verificationController.php");


class ProfilsController extends ProfilsModel
{
    public $nom;
    public $prenom;
    public $email;
    public $mdp;

    public function __construct()
    {
        $this->verif = new Verification();
    }


    public function afficherListeProfils()
    {
        $listeProfils = $this->listeProfils();
        include("view/profil/viewListeProfils.php");
    }

    public function afficherMonprofil($id)
    {
        $profil = $this->Profil($id);
        include("view/profil/viewMonProfil.php");
    }


    public function setInscription()
    {
        // je verifie que j'ai envoyé le formulaire
        // si le formulaire est envoyé j'entre dans la condition
        // si non j'affiche la vue du formulaire dans else

        $this->nom = $this->verif->verfNomPrenom(@$_POST["nom"]);
        $this->prenom = $this->verif->verfNomPrenom(@$_POST["prenom"]);
        $this->email = $this->verif->verfEmail(@$_POST["email"]);


        // affiche les messages
        if (isset($_POST['email'])) {
            $message = "<center class='alert alert-danger'>Inscription n'est pas prise en compte<br>";
            if (!$this->email) {
                $message .= "mail incorrect <br>";
            }
            if (!$this->nom) {
                $message .= "nom incorrect <br>";
            }
            $message .= "</center>";
        }

        if ($this->email && $this->nom && $this->prenom) {
            $this->mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);

            if ($this->inscription()) {
                $message = "<center 
                style='background-color:black; 
                color:white; font-weight:bold; 
                font-size:x-large;'>
                Inscription réussie!
                </center>";
                // header('Location: ?page=creAccount');
                include("view/creAccount.php");
            } else {
                include("view/inscription.php");
            }
        }
        // si le formulaire n'est pas envoyé
        // j'affiche la vue du formulaire
        else {
            include("view/inscription.php");
        }
    }

    public function getLogin()
    {
        if (isset($_POST["email"])) {

            $this->email = $this->verif->verfEmail(@$_POST["email"]);
            $profil = $this->login();

            if (password_verify(@$_POST["mdp"], @$profil['mdp'])) {

                $_SESSION['nom'] = $profil['nom'];
                $_SESSION['prenom'] = $profil['prenom'];
                $_SESSION['id_user'] = $profil['id_user'];
                // redirection vers la route monProfil
                header('Location: index.php?page=monProfil');
            } else {
                $message = "<center class='alert alert-danger'>Email ou mdp incorrecte</center>";
                include("view/login.php");
            }
        } else {
            include("view/login.php");
        }
    }
    public function newAccount()
    {
        $id = @$_SESSION['id_user'];
        $this->pseudo = @$_POST['pseudo'];
        $this->description_compte = @$_POST['description_compte'];

        $this->photo = @$_POST['photo'];

        if (isset($_POST['pseudo'])) {
            $message = "<center class='alert alert-danger'>Création non prise en compte<br>";
            if (!$this->pseudo) {
                $message .= "Pseudo manquant <br>";
            }
            $message .= "</center>";
        }

        if ($this->pseudo) {

            if ($this->creAccount($id)) {
                $message = "<center 
                style='background-color:black; 
                color:white; 
                font-weight:bold; 
                font-size:x-large;'>
                Création du compte réussie!
                </center>";
                include("view/profil/viewMonProfil");
            } else {
                include("view/creAccount.php");
            }
        } else {
            include("view/creAccount.php");
        }
    }
}
