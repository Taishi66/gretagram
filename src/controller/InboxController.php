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

    public function envoyerMessage($incoming_id = null, $outgoing_id = null, $msg = null)
    {
        $incoming_id = $this->validatorHelper->getValue('incoming_id');
        $outgoing_id = $this->validatorHelper->getValue('outgoing_id');
        $msg = $this->validatorHelper->getValue('contenu_message');

        if (isset($_POST['message']) && !empty($contenu_message)) {
            $this->inboxModel->insertMsg($msg, $incoming_id, $outgoing_id);
            $this->setMessage('envoie réussie');
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
        $this->template = ("view_page/conversation.php");

        $id_destinataire = $id_compte;
        $id_compte = CompteFacade::getCompteId();
        $this->setInbox($this->inboxModel->getCompteMessageSent($id_compte, $id_destinataire));
        return $this->renderController();
    }
}
