<?php

namespace App\Model;

use App\Model\Conexao as ligar;

class Counter
{

    /* 
        Instancia de ligação com base dados
     */
    public static function getInstance()
    {
        $ligar  = new  ligar();

        $ligar = $ligar->ligar();

        return $ligar;
    }

    // contadores de registros

    public static function counters($id_posto)
    {

        // Solicitações

        $solicitacoes = static::getInstance()->query("SELECT *FROM solicitacao_reserva WHERE idPosto = '$id_posto'");

        $solicitacoes_pendentes = static::getInstance()->query("SELECT *FROM solicitacao_reserva WHERE idPosto = '$id_posto' AND idEstadoSolicitacao = '1'");
        $solicitacoes_aprovadas = static::getInstance()->query("SELECT *FROM solicitacao_reserva WHERE idPosto = '$id_posto' AND idEstadoSolicitacao = '2'");
        $solicitacoes_recusadas = static::getInstance()->query("SELECT *FROM solicitacao_reserva WHERE idPosto = '$id_posto' AND idEstadoSolicitacao = '3'");

        // servicos 

        $servicos = static::getInstance()->query("SELECT *FROM documentos WHERE idPosto = '$id_posto'");

        return
            [
                'num_solicitacoes' => $solicitacoes->rowCount(),
                'num_documentos' => $servicos->rowCount(),
                'num_solitacoes_pendentes' => $solicitacoes_pendentes->rowCount(),
                'num_solitacoes_aprovadas' => $solicitacoes_aprovadas->rowCount(),
                'num_solitacoes_recusadas' => $solicitacoes_recusadas->rowCount(),
                'num_solitacoes_atendidas' => $solicitacoes_aprovadas->rowCount(),

            ];
    }

    public static function contadorGeral()
    {
        // utentes 

        $utentes = static::getInstance()->query("SELECT *FROM utentes");

        // postos

        $postos = static::getInstance()->query("SELECT *FROM postos");

        // gestores

        $gestores = static::getInstance()->query("SELECT *FROM gestores");

        // adm

        $adm = static::getInstance()->query("SELECT *FROM administradores");
        return [
            'num_gestores' => $gestores->rowCount(),
            'num_utentes' => $utentes->rowCount(),
            'num_postos' => $postos->rowCount(),
            'num_adm' => $adm->rowCount()
        ];
    }
}
