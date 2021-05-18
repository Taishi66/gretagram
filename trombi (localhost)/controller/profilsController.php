<?php
//include("../bdd.php");
include("model/profilsModel.php");
include("controller/verificationController.php");
include("controller/fileController.php");

class ProfilsController extends ProfilsModel
{

    public $nom;
    public $prenom;
    public $infos;
    public $image;
    public $cv;
    public $email;
    public $mdp;
    public $verif;
    public $description;
    public $id_categorie;
    // public $bdd;

    // execute au meme temps que l'instentiation de la class
    public function __construct()
    {
        $this->verif = new Verification();
    }


    public function AfficheListeProfils()
    {
        $listeProfils = $this->listeProfils(); // model
        //    var_dump($listeProfils); test
        include("view/profils/viewListeProfils.php"); // vue
    }

    public function AfficheProfil($id = null)
    {
        if ($id !== null) {
            $profil = $this->Profil($id);
            $profilConCat = $this->ProfilContenusCategories($id);
            $categorie = $this->categorie();

            //si je modifie mon profil
            if (isset($_POST['submit'])) {
                $this->setModificationProfil();
            }
            if (isset($_POST['submitContenu'])) {
                $this->newContenu();
            }
            include("view/profils/viewProfil.php");
        } else {
            include("view/404.php");
        }
    }


    public function newContenu()
    {
        $id = $_SESSION['id_user'];
        $this->nom = @$_POST['titre'];
        $this->description = @$_POST['description'];
        $this->id_categorie = @$_POST['id_categorie'];
        $this->ajoutContenu($id);
    }


    public function setInscription()
    {
        // je verifie que j'ai envoyer le formulaire
        // si le formulaire est envoyé j'entre dans la condition
        // si non j'affiche la vue du formulaire dans else

        $this->nom = $this->verif->verfNomPrenom(@$_POST["nom"]);
        $this->prenom = $this->verif->verfNomPrenom(@$_POST["prenom"]);
        $this->infos = @$_POST["infos"];
        $this->image = @$_POST["image"];
        $this->email = $this->verif->verfEmail(@$_POST["email"]);


        // affiche les message
        if (isset($_POST['email'])) {
            $message = "<center class='alert alert-danger'>Inscription n'est pas pris en compte <br>";
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
                echo   $message = "<center class='alert alert-info>Inscription est pris en compte </center>";
            } else {
                include("view/inscription.php");
            }
        }
        // si le frmulaire n'est pas envoyer
        // j'affiche la vue du formulaire
        else {
            include("view/inscription.php");
        }
    }


    public function getConnexion()
    {
        if (isset($_POST["email"])) {

            $this->email = $this->verif->verfEmail(@$_POST["email"]);
            $profil = $this->connexion();

            if (password_verify($_POST["mdp"], $profil['mdp'])) {

                $_SESSION['nom'] = $profil['nom'];
                $_SESSION['prenom'] = $profil['prenom'];
                $_SESSION['id_user'] = $profil['id_user'];
                // redirection vers la route monProfil
                header('Location: index.php?page=monProfil');
            } else {
                echo $message = "<center class='alert alert-danger'>Email ou mdp incorrecte</center>";
                include("view/connexion.php");
            }
        } else {
            include("view/connexion.php");
        }
    }


    public function setModificationProfil()
    {
        $id = @$_SESSION["id_user"];
        $this->nom = $this->verif->verfNomPrenom(@$_POST["nom"]);
        $this->prenom = $this->verif->verfNomPrenom(@$_POST["prenom"]);
        $this->infos = @$_POST["infos"];
        $this->email = $this->verif->verfEmail(@$_POST["email"]);

        if ($this->email && $this->nom && $this->prenom) {

            $photo = new FileController();


            $this->image = $photo->upload('image', $this->nom);
            $this->cv = $photo->upload('cv', $this->nom);

            $this->mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

            if (!$this->image) {
                echo "image";
                return false;
            }
            if (!$this->cv) {
                echo "cv";
                return false;
            }


            if ($this->modificationProfil($id)) {
                $_SESSION['nom'] = $this->nom;
                $_SESSION['prenom'] = $this->prenom;
                header('Location:index.php?page=monProfil');

                /*$message="<center class='alert alert-danger'>Modification non pris en compte<br>";
            if (!$this->email){
                $message.="mail erroné<br>";
            }
            if (!$this->nom){
                $message.="nom erroné<br>";
            }
            $message.="</center";
            */

            
            }
        }
    }
}
    // test 
    // $profils = new ProfilsController();
    // $profils->AfficheListeProfils();
    //$profils->AfficheProfil(1);