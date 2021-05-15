<?php



class UserController extends ManagerController
{
    private $article;
    private $userModel;
    private $compteController;
    private $commentaireController;
    private $likeModel;

    public function __construct()
    {
        $this->compteController = new CompteController();
        $this->article = new ArticleController();
        $this->userModel = new UserModel();
        $this->commentaireController = new CommentaireController();
        $this->likeModel = new LikeModel();
        parent::__construct(); //récupère les méthodes de la classe parente = validatorHelper
    }

    /**
     *
     *  Afficher mon profil et ses données
     *  Modifier son compte
     *  Créer un article
     *  Supprimer son compte
     *
     * @return Compte User + Article
     */
    public function afficherMonprofil()
    {
        $id_compte = CompteFacade::getCompteId();
        $this->template = 'view_profil/monProfil.php';
        $this->setCompte(CompteFacade::getUserCompte($id_compte));
        //Faire apparaitre les données articles du compte
        if (!empty($_SESSION['user'])) {
            $this->setArticle($this->article->afficheListeArticles(CompteFacade::getCompteId()));
        }
        //Si je souhaite modifier mon compte
        if (!empty($this->validatorHelper->getValue('pseudo'))) {
            $this->compteController->modifierCompte($id_compte);
            return $this->redirectTo('Profil');
        }
        //Si je souhaite créer un article
        if ($_POST['submit-post'] !== null) {
            $this->article->nouvelArticle();
            return $this->redirectTo('Profil');
        }
        //SI je souhaite supprimer mon compte
        if (isset($_POST['delete-compte'])) {
            $id_compte = CompteFacade::getCompteId();
            $this->likeModel->supprimeAllLike($id_compte); //ordre de suppression de données à suivre
            $this->commentaireController->supprimerToutLesCommentaires($id_compte);
            $this->article->effacerToutLesArticle($id_compte);
            CompteFacade::EraseAccount();
            $this->userModel->deleteUser(SessionFacade::getUserId());
            SessionFacade::clearSession();
            exit;
        }

        return $this->renderController();
    }

    /**
     * S'inscrire avant de créer son compte
     *
     * @return void
     */
    public function nouvelleInscription()
    {
        $this->template = 'view_inscription/inscription.php';
        //On récupère les valeurs des inputs
        $nom = $this->validatorHelper->verfNomPrenom($this->validatorHelper->getValue("nom"));
        $prenom = $this->validatorHelper->verfNomPrenom($this->validatorHelper->getValue("prenom"));
        $email = $this->validatorHelper->verfEmail($this->validatorHelper->getValue("email"));

        if (isset($_POST['inscription'])) {
            $mdp = password_hash($this->validatorHelper->getValue("mdp"), PASSWORD_DEFAULT);
            //hashage du mdp pour sécuriser en BDD

            if (!empty($email) && !empty($nom) && !empty($prenom) && !empty($mdp)) {
                $this->userModel->inscription($nom, $prenom, $email, $mdp);
                $profil = $this->userModel->Login($email); // stock les données du nouvel user
                SessionFacade::setUserSession($profil); //Pour ensuite ouvrir la session
                $this->redirectTo('NoAccount'); //redirige vers la création du compte
            } else {
                $this->setMessage('Inscription échouée', 'warning');
                return $this->renderController();
            }
        } else {
            $this->renderController();
        }
        return $this->renderController();
    }

    /**
     * Se connecter à son compte
     */
    public function seConnecter()
    {
        $this->template = 'view_page/login.php';

        if (!empty($this->validatorHelper->getValue("email"))) {
            $email = $this->validatorHelper->verfEmail($this->validatorHelper->getValue("email"));
            $profil = $this->userModel->login($email);

            if (password_verify($this->validatorHelper->getValue('mdp'), $profil['mdp'])) {
                SessionFacade::setUserSession($profil);
                $this->redirectTo('Profil');
                exit;
            } else {
                $this->setMessage('Connexion échouée', 'warning');
                return $this->renderController();
            }
        }
        return $this->renderController();
    }

    public function deconnexion()
    {
        return SessionFacade::clearSession(); //vide l'array SESSION
    }
}
