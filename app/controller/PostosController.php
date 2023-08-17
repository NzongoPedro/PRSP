<?php

namespace App\controller;

use App\Model\Postos as postos;

class PostosController
{
    // index, buscar todos
    public static function index()
    {
        // retorna para a view
        return postos::index();
    }
    // controller cadastrar postos
    public static function cadastrar($nome, $email, $token, $link, $categoria, $gestor, $municipio)
    {
        return postos::gravardaDadosPosto($nome, $email, $token, $link, $categoria, $gestor, $municipio);
    }

    // controller editar dados utente
    public static function editar($nome, $email, $telefone, $idUtente)
    {
        return postos::alterardaDadosUtente($nome, $email, $telefone, $idUtente);
    }

    // controller alterar senha
    public static function editaSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idUtente)
    {
        return postos::alterarSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idUtente);
    }

    // exbidar dados da controller na view
    public static function mostrarDadosPostoPorGestor($idGestor)
    {
        return postos::mostrarDadosPostoPorGestor($idGestor);
    }
    // exbidar dados da controller na view
    public static function mostrarDadosPostoPorId($idposto)
    {
        return postos::mostrarDadosPostoPorId($idposto);
    }

    //Controller autenticar utente
    public static function entrar($email, $senha)
    {
        return postos::loginGestor($email, $senha);
    }
}
