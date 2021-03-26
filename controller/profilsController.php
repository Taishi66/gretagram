<?php

include("model/profilsModel.php");
include("controller/verificationController.php");
//include("controller/managerController.php");
//include("controller/articleController.php");

class ProfilsController extends ArticleController
{
    private $article;
    private $profilsModel;
    private $verif;
    private $manager;



    public function __construct()
    {
        $this->verif = new Verification();
        $this->manager = new ManagerController();
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
        $this->manager->template = 'home.php';
        return $this->manager->renderController();
    }

    /**
     * afficherMonprofil
     *
     * @param  int $id_user
     * @return void
     */
    public function afficherMonprofil($id_user, $id_compte)
    {
        $this->manager->template = 'profil/monProfil.php';
        $id_user = SessionFacade::getUserId();
        $this->manager->message = $this->profilsModel->profil($id_user);
        $this->manager->compte = $this->article->afficheListeArticles($id_compte);


        /*  if (!empty($_POST['titre']) && !empty($_POST['media']) && !empty($_POST['contenu'])) {
            $this->article->newArticle($_POST['media'], $_POST['titre'], $_POST['contenu'], $_POST['date_art'], $this->id_compte);
            return $this->manager->renderController();
        } else {
            //   $this->manager->message = 'Données manquantes';
            return $this->manager->renderController();
        }*/
        return $this->manager->renderController();
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

        $this->manager->template = 'inscription.php';

        $nom = $this->verif->verfNomPrenom(@$_POST["nom"]);
        $prenom = $this->verif->verfNomPrenom(@$_POST["prenom"]);
        $email = $this->verif->verfEmail(@$_POST["email"]);

        if (!empty($email) && !empty($nom) && !empty($prenom)) {
            $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);

            if ($this->profilsModel->inscription($nom, $prenom, $email, $mdp)) {

                $profil = $this->profilsModel->Login($email);
                SessionFacade::setUserSession($profil);
                $this->manager->redirectTo('noAccount');
                exit;
            } else {
                $this->manager->message = 'Inscription échouée';
            }
        } else {
            $this->manager->renderController();
        }
        return  $this->manager->renderController();
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
        $this->manager->template = 'creAccount.php';

        if (!empty($pseudo) && !empty($photo) && !empty($description_compte)) {
            var_dump($pseudo);
            if ($this->profilsModel->creAccount($id, $photo, $pseudo, $description_compte)) {
                $this->manager->redirectTo('monProfil');
                exit;
            } else {
                $this->manager->message = 'Création de compte non enregistrée';
            }
            $this->manager->message = 'Données manquantes';
        }
        return $this->manager->renderController();
    }

    /**
     * getLogin
     *
     * @return void
     */
    public function getLogin()
    {
        $this->manager->template = 'login.php';

        if (isset($_POST["email"])) {

            $email = $this->verif->verfEmail(@$_POST["email"]);
            $profil = $this->profilsModel->login($email);

            if (password_verify($_POST['mdp'], $profil['mdp'])) {

                SessionFacade::setUserSession($profil);
                $this->manager->redirectTo('monProfil');
                exit;
            } else {
                $this->manager->message = 'Connexion échouée';
            }
        } else {
            $this->manager->message = 'Données erronées';
        }
        return $this->manager->renderController();
    }
}
