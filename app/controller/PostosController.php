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


    // index, buscar todos
    public static function index_2($posto)
    {
        // retorna para a view
        return postos::index_2($posto);
    }

    
    // controller cadastrar postos
    public static function cadastrar($estado, $nome, $email, $token, $link, $categoria, $gestor, $municipio)
    {
        return postos::gravardaDadosPosto($estado, $nome, $email, $token, $link, $categoria, $gestor, $municipio);
    }

    //editar posto
    public static function editardaDadosPosto($estado, $nome, $email, $municipio, $posto)
    {
        return postos::editardaDadosPosto($estado, $nome, $email, $municipio, $posto);
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

    //acesso token
    public static function token($token, $idposto)
    {
        return postos::token($token, $idposto);
    }

    // verifica se o posto j+a existe
    public static function checkPosto($idGestor)
    {
        return postos::checkPosto($idGestor);
    }

    // muda estado
    public static function mudaEstado($estado, $conta)
    {
        return postos::mudaEstado($estado, $conta);
    }

    public static function eliminarPosto($id_posto)
    {
        return postos::eliminarPosto($id_posto);
    }
}
