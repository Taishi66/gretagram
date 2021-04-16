<?php
class Render
{
    function __construct()
    {
    }

    public function renderHeader($datas)
    {
        ob_start();
        include('view/header.php');
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    public function renderContent($template, $datas)
    {
        ob_start();
        include('view/' . $template);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    public function renderFooter($datas)
    {
        ob_start();
        include('view/footer.php');
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    public function showPage($header, $content, $footer)
    {
        echo $header . $content . $footer;
        exit;
    }
}
