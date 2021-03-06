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

    public function messageDirect($incoming_id = null, $outgoing_id = null, $msg = null)
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

    public function messageChat($incoming_id = null, $outgoing_id = null, $msg = null)
    {
        $incoming_id = $this->validatorHelper->getValue('incoming_id');
        $outgoing_id = $this->validatorHelper->getValue('outgoing_id');
        $msg = $this->validatorHelper->getValue('message');

        if (!empty($msg)) {
            $this->inboxModel->insertMsg($incoming_id, $outgoing_id, $msg);

            $output = [
                'pseudo' => CompteFacade::getComptePseudo(),
                'photo' => CompteFacade::getComptePhoto(),
                'date_message' => date('Y-m-d H:I:s')
            ];
            echo json_encode($output);
            exit;
        }
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
        // $incoming_id = $this->validatorHelper->getValue('');

        $this->setInbox($this->inboxModel->getChat($incoming_id, $outgoing_id));

        return $this->renderController();



        /*$inbox = array($this->inboxModel->getChat($incoming_id, $outgoing_id));
        while ($inbox['msg'] > 0) {
            $output = [
                'msg' => $inbox['msg'],
                'photo' => $inbox['photo'],
                'pseudo' => $inbox['pseudo'],
                'msg_id' => $inbox['msg_id'],
                'date_message' => $inbox['date_message'],
                'incoming_id' => $inbox['incoming_id'],
                'outgoing_id' => $inbox['outgoing_id']
            ];
        }

        $this->renderController();
        echo json_encode($output);
        exit;*/
    }

    public function refreshChat($incoming_id, $outgoing_id)
    {
        $incoming_id = $this->validatorHelper->getValue('incoming_id');
        $outgoing_id = $this->validatorHelper->getValue('outgoing_id');
    }
}
