<?php

class Route
{
    private $path;
    private $callable;
    private $matches = [];
    private $params = [];


    //le construct retire dès l'instanciation de l'objet les / inutiles
    // et initialise le callable
    public function __construct($path, $callable)
    {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }


    /**
     * $url = Retire les / de l'url
     * $path = Regex pour dire le type de string(correspondance) qui sera remplacée par
     * une fonction lors de l'execution de preg_replace_callback()
     * $regex = Permet de vérifier toute la chaine, le 	drapeau ‘i’ permet de vérifier les majuscule/minuscules.
     *
     * preg_match($regex, 2nd param ce que je dois matcher,la variable dans
     * laquelle on va sauvegarder les différents match que l’on aura.)
     * @param $url
     *
     * @return bool
     */
    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches); //dégage le premier élément d’un tableau
        $this->matches = $matches; //stock toute les routes qui matchent dans la variable $matches
        return true;
    }


    /**
     * Si jamais j’ai un paramètre qui correspond à la variable $match en paramètre alors je retourne ce paramètre.
     *
     * @param $match
     *
     * @return une expression régulière qui accepte tout sauf un slash.Method paramMatch
     */
    private function paramMatch($match)
    {
        if (isset($this->params[$match[1]])) {
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }


    /**
     * Récupère le callable
     * Sépare en deux string à l'aide d'un #
     * Concatène la string Controller à la 1ere partie du callable
     * Ce qui instanciera un nouvel objet controller
     * Il parcours derrière les méthodes de ce nouvel objet pour trouver celle
     * qui correspond à la 2ème partie du callable et l'execute grâce à
     * call_user_func_array
     * @return l'execution d'une methode controller
     * ou alors la méthodes qui correspondra aux différents matches
     */
    public function call()
    {
        if (is_string($this->callable)) {
            $params = explode('#', $this->callable);
            $controller =  $params[0] . "Controller";
            $controller = new $controller();
            return call_user_func_array([$controller, $params[1]], $this->matches);
        } else {
            return call_user_func_array($this->callable, $this->matches);
        }
    }
}
