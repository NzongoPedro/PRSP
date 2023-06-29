<?php

namespace App\controller;

use App\Model\Utentes as utentes;

class utentesController
{
    // controller cadastrar utente
    public static function cadastrar($nome, $email, $telefone, $senha)
    {
        return utentes::gravardaDadosUtente($nome, $email, $telefone, $senha);
    }

    // controller editar dados utente
    public static function editar($nome, $email, $telefone, $idUtente)
    {
        return utentes::alterardaDadosUtente($nome, $email, $telefone, $idUtente);
    }

    // controller alterar senha
    public static function editaSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idUtente)
    {
        return utentes::alterarSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idUtente);
    }

    // exbidar dados da controller na view
    public static function mostraDadosUtente($idUtente)
    {
        return utentes::mostrarDadosUtentePorId($idUtente);
    }

    //Controller autenticar utente
    public static function entrar($email, $senha)
    {
        return utentes::loginUtente($email, $senha);
    }
}
