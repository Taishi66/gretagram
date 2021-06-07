<?php



class InboxController extends ManagerController

{

    private $inboxModel;
    private $compteModel;


    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->compteModel = new CompteModel();
        parent::__construct();
    }

    public function envoyerMessage($id_compte = null)
    {
        $id_destinataire = $id_compte;
        $compteVisite = $this->compteModel->showProfil($id_compte);
        $id_compte = CompteFacade::getCompteId();
        $contenu_message = $this->validatorHelper->getValue('contenu_message');

        if (isset($_POST['message']) && !empty($contenu_message)) {
            $this->inboxModel->sendMessage($contenu_message, $id_compte, $id_destinataire);
            $this->template = ("view_page/conversation.php");
            $this->setCompteVisite($compteVisite);
            $this->setInbox($this->inboxModel->getCompteMessage($id_destinataire));
            return $this->renderController();
        } else {
            $this->setMessage('Message non envoyé', 'warning');
            return $this->renderController();
        }
    }

    public function mesDiscussions()
    {
        $this->template = ("view_page/inbox.php");
        $this->setInbox($this->inboxModel->myDiscussions(CompteFacade::getCompteId()));
        return $this->renderController();
    }

    public function maConversation($id_compte = null)
    {
        $id_destinataire = $id_compte;
        $this->template = ("view_page/conversation.php");
        //  $compteMessage = $this->inboxModel->getCompteMessage($id_destinataire);
        $this->setInbox($this->inboxModel->getCompteMessage($id_destinataire));
        return $this->renderController();
    }
}
