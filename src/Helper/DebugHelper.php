<?php

class DebugHelper
{
    public function __construct()
    {
    }

    public function dd($var)
    {
        if ($_ENV['DEBUG'] == 'true') {
            echo '<pre>';
            var_dump($var);
            exit();
        }
    }

    public function dump($var)
    {
        if ($_ENV['DEBUG'] == 'true') {
            echo '<pre>';
            var_dump($var);
        }
    }
}
