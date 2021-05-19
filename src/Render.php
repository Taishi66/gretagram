<?php

class Render
{
    /* Contenu rendu */
    private $content = null;

    public function __construct()
    {
    }


    /**
     * Renvoie la vue envoyée par le contrôleur
     * @param $template
     * @param $datas
     * @return void
     */
    public function renderContent($template, $datas)
    {
        ob_start();
        include('view/header.php');
        include('view/' . $template);
        include('view/footer.php');
        $this->content = ob_get_contents();
        ob_end_clean();

        $this->showPage();
    }


    public function showPage()
    {
        echo $this->content;
        exit;
    }

    public function renderErrorNotFound()
    {
        ob_start();
        include('view/404.php');
        $this->content = ob_get_contents();
        ob_end_clean();
        $this->showPage();
    }
}
