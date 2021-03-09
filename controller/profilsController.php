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
            $message = "<center class='alert alert-danger'>Inscription n'est pas prise en compte <br>";
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
                echo $message = "<center class='alert alert-info>Inscription est pris en compte </center>";
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

            if (password_verify($_POST["mdp"], $profil['mdp'])) {

                $_SESSION['nom'] = $profil['nom'];
                $_SESSION['prenom'] = $profil['prenom'];
                $_SESSION['id_user'] = $profil['id_user'];
                // redirection vers la route monProfil
                header('Location: index.php?page=monProfil');
            } else {
                echo $message = "<center class='alert alert-danger'>Email ou mdp incorrecte</center>";
                include("view/login.php");
            }
        } else {
            include("view/login.php");
        }
    }
}
