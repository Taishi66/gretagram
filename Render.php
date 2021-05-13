<?php
class Render
{
    function __construct()
    {
    }


    /**
     * Renvoie la vue du header 
     * @param $datas 
     * @return $var = contenu de l'include
     */
    public function renderHeader($datas)
    {
        ob_start();
        include('view/header.php');
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    /**
     * Renvoie la vue envoyée par le contrôleur
     * @param $template 
     * @param $datas  
     * @return $var = contenu de l'include
     */
    public function renderContent($template, $datas)
    {
        ob_start();
        include('view/' . $template);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    /**
     * Renvoie la vue du footer
     * @param $datas 
     * @return $var = contenu de l'include 
     */
    public function renderFooter($datas)
    {
        ob_start();
        include('view/footer.php');
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }


    /**
     * Les fonctions précèdentes sont stockées dans des variables
     * On peut donc concaténer les vues dans l'ordre que l'on veut 
     * @param $header $header
     * @param $content $content 
     * @param $footer $footer 
     *
     * @return void
     */
    public function showPage($header, $content, $footer)
    {
        echo $header . $content . $footer;
        exit;
    }
}
