<?php

namespace App\controller;

use App\Model\Gestor as gestores;

class GestoresController
{
    // index, buscar todos
    public static function index()
    {
        // retorna para a view
        return gestores::index();
    }
    // controller cadastrar utente
    public static function cadastrar($nome, $email, $telefone, $senha, $passe)
    {
        return gestores::gravardaDadosGestor($nome, $email, $telefone, $senha, $passe);
    }

    // controller editar dados utente
    public static function editar($nome, $email, $telefone, $idUtente)
    {
        return gestores::alterardaDadosUtente($nome, $email, $telefone, $idUtente);
    }

    // controller alterar senha
    public static function editaSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idUtente)
    {
        return gestores::alterarSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idUtente);
    }

    // exbidar dados da controller na view
    public static function mostraDadosGestor($idGestor)
    {
        return gestores::mostrarDadosGestorPorId($idGestor);
    }

    //Controller autenticar utente
    public static function entrar($email, $senha)
    {
        return gestores::loginGestor($email, $senha);
    }
}
