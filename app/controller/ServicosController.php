<?php

namespace App\controller;

use App\Model\Servicos as servico;

class ServicosController
{

    // controller para adiconar serviços na base de dados

    public static function store($nome, $tempo, $preco, $validade, $requisitos, $posto)
    {

        // retorna para a view a resppsta da model

        return servico::store($nome, $tempo, $preco, $validade, $requisitos, $posto);
    }
}
