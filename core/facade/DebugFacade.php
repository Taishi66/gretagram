<?php

/**
 * DebugFacade
 * Façade Debugger
 */
class DebugFacade
{

    /**
     * Method dd
     * Dump and Die équivalent de var_dump; puis exit;
     * @param $var
     *
     * 
     */
    static function dd($var)
    {
        $debug = new DebugHelper();
        return $debug->dd($var);
    }

    /**
     * Method dump
     * Var_dump
     *
     * @param $var $var [explicite description]
     *
     */
    static function dump($var)
    {
        $debug = new DebugHelper();
        return $debug->dump($var);
    }
}
