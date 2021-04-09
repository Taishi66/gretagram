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

        if (!empty($this->validatorHelper->getValue('pseudo'))) {
            // var_dump($this->validatorHelper->getValue('pseudo'));
            $this->compteController->modifierCompte($id_compte);
            return $this->redirectTo('profil');
        } else {
            $this->setMessage('Modification échouée : Données manquantes', 'danger');
        }
        //Si je souhaite créer un article
        $file_name = $this->validatorHelper->upload('media');
        //DebugFacade::dd($_FILES);
        if (!empty($this->validatorHelper->getValue('titre')) && !empty($this->validatorHelper->getValue('contenu'))) {
            $this->article->nouvelArticle($file_name, $this->validatorHelper->getValue('titre'), $this->validatorHelper->getValue('contenu'), $this->validatorHelper->getValue('date_art'), $id_compte);
            CompteFacade::plusPublication();
            return $this->redirectTo('profil');
        } else {
            $this->setMessage('Article non posté : Données manquantes', 'danger');
        }
        //SI je souhaite supprimer mon compte
        if (isset($_POST['delete-compte'])) {
            CompteFacade::EraseAccount();
            return $this->redirectTo('');
        }

        return $this->renderController();
    }

    /**
     * setInscription
     *
     * @return void
     */
    public function nouvelleInscription()
    {
        // je verifie que j'ai envoyé le formulaire
        // si le formulaire est envoyé j'entre dans la condition
        // si non j'affiche la vue du formulaire dans else

        $this->template = 'inscription.php';

        $nom = $this->validatorHelper->verfNomPrenom($this->validatorHelper->getValue("nom"));
        $prenom = $this->validatorHelper->verfNomPrenom($this->validatorHelper->getValue("prenom"));
        $email = $this->validatorHelper->verfEmail($this->validatorHelper->getValue("email"));

        if (!empty($email) && !empty($nom) && !empty($prenom)) {
            $mdp = password_hash($this->validatorHelper->getValue("mdp"), PASSWORD_DEFAULT);

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
    public function nouveauCompte($id)
    {
        $id = SessionFacade::getUserId();
        $pseudo = $this->validatorHelper->getValue("pseudo");
        $description_compte = $this->validatorHelper->getValue("description_compte");
        $photo = $this->validatorHelper->getValue("photo");
        // exit;
        $this->template = 'creAccount.php';

        if (!empty($pseudo) && !empty($photo) && !empty($description_compte)) {
            //var_dump($pseudo);
            if ($this->compteModel->creAccount($id, $photo, $pseudo, $description_compte)) {
                $this->redirectTo('profil');
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
    public function seConnecter()
    {
        $this->template = 'login.php';

        if (!empty($this->validatorHelper->getValue("email"))) {

            $email = $this->validatorHelper->verfEmail($this->validatorHelper->getValue("email"));
            $profil = $this->UserModel->login($email);

            if (password_verify($this->validatorHelper->getValue('mdp'), $profil['mdp'])) {

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