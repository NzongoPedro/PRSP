<?php

namespace App\controller;

use App\Model\Admin as adm;

class admController
{
    // controller cadastrar Adm
    public static function cadastrar($nome, $email, $telefone, $senha, $nivel)
    {
        return adm::gravardaDadosAdm($nome, $email, $telefone, $senha, $nivel);
    }

    // controller editar dados Adm
    public static function editar($nome, $email, $telefone, $idAdm)
    {
        return adm::alterardaDadosAdm($nome, $email, $telefone, $idAdm);
    }

    // controller alterar senha
    public static function editaSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idAdm)
    {
        return adm::alterarSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idAdm);
    }

    // exbidar dados da controller na view
    public static function mostraDadosAdm($idAdm)
    {
        return adm::mostrarDadosAdmPorId($idAdm);
    }

    // ver todos

    public static function index()
    {
        return adm::index();
    }

    //Controller autenticar admin
    public static function entrar($email, $senha)
    {
        return adm::loginAdmin($email, $senha);
    }
    public static function alterarFoto($id_adm, $foto)
    {
        return adm::alterarFoto($id_adm, $foto);
    }
    public static function verFoto($idAdm)
    {
        return adm::verFoto($idAdm);
    }
}
