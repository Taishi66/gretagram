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
            'template' => 'profil/monProfil.php',
            'datas' => array(
                'message' => 'test'
            )
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


        if ($this->email && $this->nom && $this->prenom) {
            $this->mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
            //var_dump($this->nom);
            if ($this->profilsModel->inscription($this->email, $this->nom, $this->prenom, $this->mdp)) {
                //header('Location:?page=noAccount');
                return array(
                    'template' => 'creAccount.php',
                    'datas' => array(
                        'message' => ''
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
                'datas' => array(
                    'message' => ''
                )
            );
        }
    }

    //--------------------------------------------CONNEXION-----------------------------------------
    public function getLogin()
    {
        if (isset($_POST["email"])) {

            $this->email = $this->verif->verfEmail(@$_POST["email"]);
            $profil = $this->profilsModel->login($this->email);
            var_dump($profil);


            if (password_verify($_POST['mdp'], $profil['mdp'])) {
                $_SESSION['nom'] = $profil['nom'];
                $_SESSION['prenom'] = $profil['prenom'];
                $_SESSION['id_user'] = $profil['id_user'];

                var_dump($_SESSION['id_user']);
                header('Location:?page=monProfil');
                return array(
                    'template' => 'profil/monProfil.php',
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
                'template' => 'login.php',
                'datas' => array(
                    'message' => 'Connectez vous'
                )
            );
        }
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


        if (!empty($pseudo) && !empty($photo) && !empty($description_compte)) {
            var_dump($pseudo);
            if ($this->profilsModel->creAccount($id, $photo, $pseudo, $description_compte)) {
                header('Location:?page=monProfil');
                exit;
            } else {
                var_dump("else1");
                return array(
                    'template' => 'creAcount.php',
                    'datas' => array(
                        'message' => 'Création compte non prise en compte'
                    )
                );
            }
        } else {
            var_dump("else2");
            return array(
                'template' => 'creAccount.php',
                'datas' => array(
                    'message' => 'testCREA'
                )
            );
        }
    }
}
