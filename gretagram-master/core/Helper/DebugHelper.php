<?php

class DebugHelper
{
    private static $enabled = true;


    public function __construct()
    {
    }

    public function dd($var)
    {
        if (self::$enabled) {
            echo '<pre>';
            var_dump($var);
            exit();
        }
    }

    public function dump($var)
    {
        if (self::$enabled) {
            echo '<pre>';
            var_dump($var);
        }
    }
}
