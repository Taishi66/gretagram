<?php



class InboxController extends ManagerController

{

    private $inboxModel;

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        parent::__construct();
    }

    public function envoyerMessage($id_compte = null)
    {
        $id_destinataire = $id_compte;
        $id_compte = CompteFacade::getCompteId();
        $contenu_message = $this->validatorHelper->getValue('contenu_message');
        if (isset($_POST['message']) && !empty($contenu_message)) {
            $this->inboxModel->sendMessage($contenu_message, $id_compte, $id_destinataire);
            $this->template = ("view_page/inbox.php");
            return $this->renderController();
        } else {
            $this->setMessage('Message non envoyé', 'warning');
            return $this->renderController();
        }
    }

    public function mesDiscussions()
    {
        $this->template = ('view_page/inbox.php');
        $this->setInbox($this->inboxModel->seeInbox(CompteFacade::getCompteId()));
        return $this->renderController();
    }
}
