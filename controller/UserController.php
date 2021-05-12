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
        $this->userModel = new userModel();
        $this->commentaireController = new CommentaireController();
        $this->likeModel = new likeModel();
        parent::__construct(); //récupère les méthodes de la classe parente = validatorHelper
    }

    /**
     * afficherMonprofil
     *
     * @return Compte User + Article
     */
    public function afficherMonprofil()
    {

        $id_compte = CompteFacade::getCompteId();
        $this->template = 'profil/monProfil.php';
        $this->setCompte(CompteFacade::getUserCompte($id_compte));
        //Faire apparaitre les données articles du compte
        if (!empty($_SESSION['user'])) {
            $this->setArticle($this->article->afficheListeArticles(CompteFacade::getCompteId()));
        }
        //Si je souhaite modifier mon compte
        if (!empty($this->validatorHelper->getValue('pseudo'))) {
            $this->compteController->modifierCompte($id_compte);
            return $this->redirectTo('profil');
        }
        //Si je souhaite créer un article
        if ($_POST['submit-post'] !== null) {
            $this->article->nouvelArticle();
            return $this->redirectTo('profil');
        }
        //SI je souhaite supprimer mon compte
        if (isset($_POST['delete-compte'])) {
            $id_compte = CompteFacade::getCompteId();
            $this->likeModel->supprimeAllLike($id_compte);
            $this->commentaireController->supprimerToutLesCommentaires($id_compte);
            $this->article->effacerToutLesArticle($id_compte);
            CompteFacade::EraseAccount();
            $this->userModel->deleteUser(SessionFacade::getUserId());
            $_SESSION = array('');
            $this->setMessage('Votre compte a définitivement été supprimé');
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

            if ($this->userModel->inscription($nom, $prenom, $email, $mdp)) {

                $profil = $this->userModel->Login($email);
                SessionFacade::setUserSession($profil);
                $this->redirectTo('noAccount');
            } else {
                $this->setMessage('Inscription échouée', 'warning');
                return $this->renderController();
            }
        } else {
            $this->renderController();
        }
        return  $this->renderController();
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
            $profil = $this->userModel->login($email);

            if (password_verify($this->validatorHelper->getValue('mdp'), $profil['mdp'])) {
                SessionFacade::setUserSession($profil);
                $this->redirectTo('profil');
                exit;
            } else {
                $this->setMessage('Connexion échouée', 'warning');
                return $this->renderController();
            }
        }
        return $this->renderController();
    }

    function deconnexion()
    {
        return SessionFacade::clearSession();
    }
}
