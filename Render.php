<?php
class Render
{
    /* Contenu rendu */
    private $content = null;

    function __construct()
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


    /**
     * Les fonctions précèdentes sont stockées dans des variables
     * On peut donc concaténer les vues dans l'ordre que l'on veut 
     *
     * @return void
     */
    public function showPage()
    {
        echo $this->content;
        exit;
    }
}
