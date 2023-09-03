<?php

namespace App\controller;

use App\Model\Servicos as servico;

class ServicosController
{

    // controller para adiconar serviços na base de dados

    public static function store($estado, $nome, $tempo, $preco, $validade, $requisitos, $posto)
    {

        // retorna para a view a resppsta da model

        return servico::store($estado, $nome, $tempo, $preco, $validade, $requisitos, $posto);
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
    public static function verReservas($idPosto)
    {
        return servico::verReservas($idPosto);
    }

    public static function mudaEstado($id_estado, $id_solicitacao)
    {
        return servico::mudaEstado($id_estado, $id_solicitacao);
    }

    public static function verServicosPorIdPosto($idPosto)
    {
        return servico::verServicosPorIdPosto($idPosto);
    }
    public static function verServicosPorId($id)
    {
        return servico::verServicosPorId($id);
    }

    // comprovativos

    public static function comprovativo($utente, $reserva, $referencia)
    {
        return servico::comprovativo($utente, $reserva, $referencia);
    }

    // mostra no pdf

    public static function mostrarDadosPDF($id_comprovativo)
    {

        return servico::mostrarDadosPDF($id_comprovativo);
    }

    // relatórios
    public static function relatorios($tipo)
    {
        return servico::relatorios($tipo);
    }
}
