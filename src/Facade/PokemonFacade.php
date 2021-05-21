<?php

class PokemonFacade
{
    public static function getPokemon()
    {
        $pokelol = new PokeService();
        return $pokelol->attack();
    }
}
