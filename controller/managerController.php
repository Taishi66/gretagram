<?php

class ManagerController
{

    public $message = null;
    public $template = null;


    public function renderController()
    {
        return [
            'template' => $this->template,
            'datas' => array(
                'compte' => $this->compte,
                'message' => $this->message,
                'user' => SessionFacade::getUserSession()
            )
        ];
    }


    public function redirectTo($page)
    {
        header('Location:?page=' . $page);
    }
}
