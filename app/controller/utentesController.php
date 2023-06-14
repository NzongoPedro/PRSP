<?php

namespace App\controller;

use App\Model\Utentes as utentes;

class utentescontroller
{
    // controller cadastrar utente
    public static function cadastrar($nome, $email, $telefone, $senha)
    {
        return utentes::gravardaDadosUtente($nome, $email, $telefone, $senha);
    }

    //Controller autenticar utente
    public static function entrar($email, $senha)
    {
        return utentes::loginUtente($email, $senha);
    }
}
