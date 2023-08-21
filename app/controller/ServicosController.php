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

    public static function solicitarReservas($utente, $servico, $posto, $horaFornecida, $dataFornecida)
    {
        return servico::solicitarReservas($utente, $servico, $posto, $horaFornecida, $dataFornecida);
    }

    public static function mostraDatasDisponiveisParaReserva()
    {
        return servico::mostraDatasDisponiveisParaReserva();
    }

    public static function show($idUtente)
    {
        return servico::show($idUtente);
    }
    public static function verReservas()
    {
        return servico::verReservas();
    }
}
