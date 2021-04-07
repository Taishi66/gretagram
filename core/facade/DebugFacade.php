<?php

class DebugFacade
{

    static function dd($var)
    {
        $debug = new DebugHelper();
        return $debug->dd($var);
    }

    static function dump($var)
    {
        $debug = new DebugHelper();
        return $debug->dump($var);
    }
}
