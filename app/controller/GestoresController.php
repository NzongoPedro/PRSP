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

    // editar dados 
    public static function EditarGestor($nome, $email, $telefone, $gestor)
    {
        return gestores::EditarGestor($nome, $email, $telefone, $gestor);
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

    // muda estado
    public static function mudaEstado($estado, $conta)
    {
        return gestores::mudaEstado($estado, $conta);
    }

    public static function checkEstado($conta)
    {
        return gestores::checkEstado($conta);
    }

    public static function alterarFoto($id_gestor, $foto)
    {
        return gestores::alterarFoto($id_gestor, $foto);
    }

    public static function verFoto($idGestor)
    {
        return gestores::verFoto($idGestor);
    }

    public static function eliminarGestor($idGestor)
    {
        return gestores::eliminarGestor($idGestor);
    }
}
