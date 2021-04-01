<?php



class UserController extends ManagerController
{
    private $article;
    private $UserModel;
    private $compteModel;
    private $compteController;



    public function __construct()
    {
        $this->compteController = new CompteController();
        $this->article = new ArticleController();
        $this->UserModel = new UserModel();
        $this->compteModel = new CompteModel();
        parent::__construct();
    }

    /**
     * afficherListeProfils
     *
     * @return void
     */
    public function afficherListeProfils()
    {
        $listeProfils = $this->UserModel->getAllUsers();
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
        //Faire apparaitre les données articles du compte
        if (!empty($_SESSION['user'])) {
            $this->article->afficheListeArticles(CompteFacade::getCompteId());
        }
        //Si je souhaite modifier mon compte
        if (!empty($_POST['pseudo'])) {
            var_dump($_POST['pseudo']);
            $this->compteController->modifCompte($id_compte);
            return $this->redirectTo('profil');
        }
        //Si je souhaite créer un article
        if (!empty($_POST['titre']) && !empty($_POST['media']) && !empty($_POST['contenu'])) {
            $this->article->newArticle($_POST['media'], $_POST['titre'], $_POST['contenu'], $_POST['date_art'], $id_compte);
            $this->compteController->addPublications(CompteFacade::getCompteId());
            return $this->redirectTo('profil');
        }
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

        $nom = $this->validatorHelper->verfNomPrenom(@$_POST["nom"]);
        $prenom = $this->validatorHelper->verfNomPrenom(@$_POST["prenom"]);
        $email = $this->validatorHelper->verfEmail(@$_POST["email"]);

        if (!empty($email) && !empty($nom) && !empty($prenom)) {
            $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);

            if ($this->UserModel->inscription($nom, $prenom, $email, $mdp)) {

                $profil = $this->UserModel->Login($email);
                SessionFacade::setUserSession($profil);
                $this->redirectTo('noAccount');
            } else {
                $this->setMessage('Inscription échouée');
                return $this->renderController();
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
            if ($this->compteModel->creAccount($id, $photo, $pseudo, $description_compte)) {
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

            $email = $this->validatorHelper->verfEmail(@$_POST["email"]);
            $profil = $this->UserModel->login($email);

            if (password_verify($_POST['mdp'], $profil['mdp'])) {

                SessionFacade::setUserSession($profil);
                $this->redirectTo('profil');
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
