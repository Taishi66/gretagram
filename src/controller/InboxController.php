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


        if (isset($_POST['message']) && !empty($msg)) {
            $this->inboxModel->insertMsg($incoming_id, $outgoing_id, $msg);
            return $this->maConversation($incoming_id);
        } else {
            $this->setMessage('Message non envoyé', 'warning');
            return $this->renderController();
        }
    }

    public function messageChat()
    {
        $incoming_id = $this->validatorHelper->getValue('incoming_id');
        $outgoing_id = $this->validatorHelper->getValue('outgoing_id');
        $msg = $this->validatorHelper->getValue('contenu_message');
        $this->inboxModel->insertMsg($incoming_id, $outgoing_id, $msg);
        $output = [
            'pseudo' => CompteFacade::getComptePhoto(),
            'photo' => CompteFacade::getComptePhoto(),
            'message' => $msg,
            'destinataire' => $incoming_id,
            'destinateur' => $outgoing_id
        ];
        echo json_encode($output);
        exit;
    }

    public function mesDiscussions()
    {
        $this->template = "view_page/inbox.php";
        $this->setInbox($this->inboxModel->myDiscussions(CompteFacade::getCompteId()));
        return $this->renderController();
    }

    public function maConversation($incoming_id = null)
    {
        $this->template = "view_page/conversation.php";
        $outgoing_id = CompteFacade::getCompteId();
        $this->setInbox($this->inboxModel->getChat($incoming_id, $outgoing_id));
        return $this->renderController();
    }
}
