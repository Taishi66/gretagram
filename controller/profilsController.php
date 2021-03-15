<?php

include("model/profilsModel.php");
include("controller/verificationController.php");


class ProfilsController
{
    /*public $nom;
    public $prenom;
    public $email;
    public $mdp; */

    private $profilsModel;
    private $verif;

    public function __construct()
    {
        $this->verif = new Verification();
        $this->profilsModel = new ProfilsModel();
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
        $id_user = @$_SESSION['id_user'];
        $profil = $this->profilsModel->Profil($id_user);
        return array(
            'template' => 'monProfil.php',
        );
    }

    //-------------------------------------------INSCRIPTION------------------------------------
    public function setInscription()
    {
        // je verifie que j'ai envoyé le formulaire
        // si le formulaire est envoyé j'entre dans la condition
        // si non j'affiche la vue du formulaire dans else

        $this->nom = $this->verif->verfNomPrenom(@$_POST["nom"]);
        $this->prenom = $this->verif->verfNomPrenom(@$_POST["prenom"]);
        $this->email = $this->verif->verfEmail(@$_POST["email"]);


        //affiche les messages
        /* if (isset($_POST['email'])) {
            $message = "<center class='alert alert-danger'>Inscription n'est pas prise en compte<br>";
            if (!$this->email) {
                $message .= "mail incorrect <br>";
            }
            if (!$this->nom) {
                $message .= "nom incorrect <br>";
            }
            $message .= "</center>";
        }
*/
        if ($this->email && $this->nom && $this->prenom) {
            $this->mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
            //var_dump($_POST);
            if ($this->profilsModel->inscription()) {
                return array(
                    'template' => 'creAccount.php',
                    'datas' => array(
                        'message' => 'Bienvenue!'
                    )

                );
            } else {
                return array(
                    'template' => 'inscription.php',
                    'datas' => array(
                        'message' => 'Inscription non prise en compte'
                    )
                );
            }
            // si le formulaire n'est pas envoyé
            // j'affiche la vue du formulaire
        } else {
            return array(
                'template' => 'inscription.php',
                'datas' => [
                    'defaultDatas' => [
                        'email' => 'jc@greta.fr'
                    ]
                ]
            );
        }
    }

    //--------------------------------------------CONNEXION-----------------------------------------
    public function getLogin()
    {
        if (isset($_POST["email"])) {

            $this->email = $this->verif->verfEmail(@$_POST["email"]);
            $profil = $this->profilsModel->login();

            if (password_verify(@$_POST["mdp"], @$profil['mdp'])) {
                $_SESSION['nom'] = $profil['nom'];
                $_SESSION['prenom'] = $profil['prenom'];
                $_SESSION['id_user'] = $profil['id_user'];
                return array(
                    'template' => 'monProfil.php',
                    'datas' => array(
                        'message' => 'Connexion réussie'
                    )
                );
            } else {
                return array(
                    'template' => 'login.php',
                    'datas' => array(
                        'message' => 'Connexion échouée'
                    )
                );
            }
        } else {
            return array(
                'template' => 'login.php'
            );
        }
    }


    //-----------------------------------------------------CREER UN COMPTE---------------------------------
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

        if ($this->pseudo && $this->photo && $this->description_compte) {

            if ($this->profilsModel->creAccount($id)) {
                return array(
                    'template' => 'monProfil.php',
                    'datas' => array(
                        'message' => 'Votre compte vient d\'être créé!'
                    )
                );
            } else {
                return array(
                    'template' => 'creAcount.php',
                    'data' => array(
                        'message' => 'Création compte non prise en compte'
                    )
                );
            }
        } else {
            return array(
                'template' => 'creAccount.php'
            );
        }
    }
}
