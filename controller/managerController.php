<?php

class ManagerController
{

    public $message = null;
    public $template = null;


    public function renderController()
    {
        return [
            'template' => $this->template,
            'datas' => $this->buildDatas()
        ];
    }

    public function buildDatas()
    {
        $output = [];
        if (!empty($this->getMessage())) {
            $output['message'] = $this->getMessage();
        }
        if (!empty($this->getCompte())) {
            $output['compte'] = $this->getCompte();
        }
        $output['user'] = SessionFacade::getUserSession();

        return $output;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getCompte()
    {
        return $this->compte;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setCompte($compte)
    {
        $this->compte = $compte;
    }


    public function redirectTo($page)
    {
        header('Location:?page=' . $page);
    }
}
