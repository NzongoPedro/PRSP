<?php

namespace App\Model;

use App\Model\Conexao as ligar;

use PDO;
use PDOException;

class Servicos
{
    public static function getInstance()
    {
        $ligar  = new  ligar();

        $ligar = $ligar->ligar();

        return $ligar;
    }

    /*
        @ Validação de dados 
        (Nome, e-mail, telefone, senha)
    */

    public static function validarDados($nome)
    {

        $erro = "";

        $regexNomePt = '/^[\p{L}\s]+$/u';
        // valida o nome

        if (!preg_match($regexNomePt, $nome) && preg_match('/\d/', $nome)) {

            $erro = 'verifique o nome do documento por favor';
        }

        // verifica se esse documento já existe na bd
        $checkDoc = self::getInstance()->query("SELECT documentoDesignacao FROM documentos WHERE documentoDesignacao = '$nome'");

        if ($checkDoc->rowCount() > 0) {

            $erro = 'Esta documento já existe na base de dados';
        }

        return $erro; // Retorna os possíveis erros analisados
    }

    // Método para adicionar os serviços na base dados

    public static function store($nome, $tempo, $preco, $validade, $requisitos, $posto)
    {

        try {

            // organiza a consulta
            $dados = "INSERT INTO documentos
            (idPosto, documentoDesignacao, documentoRequisitos, documentoPreco, documentoTempoDuracao, documentoDataValidade)
            VALUES(?,?,?,?,?,?)";

            // prapara para a execução 
            $store = self::getInstance()->prepare($dados);

            // crias as binds antes da execução

            $store->bindValue(1, $posto, PDO::PARAM_STR);
            $store->bindValue(2, $nome, PDO::PARAM_STR);
            $store->bindValue(3, $requisitos, PDO::PARAM_STR);
            $store->bindValue(4, $preco, PDO::PARAM_STR);
            $store->bindValue(5, $tempo, PDO::PARAM_STR);
            $store->bindValue(6, $validade, PDO::PARAM_STR);

            $erro = self::validarDados($nome);

            if (!$erro) { // verifica a existencia de erros

                if ($store->execute()) { //verica se existe um erro de sintaxe do programador

                    http_response_code(200);

                    return ['status' => 200, 'msg' => 'Serviço adiconado'];
                } else { // mostra os erros cometidos por programador, caso exista

                    http_response_code(402);

                    return ['status' => 402, 'msg' => $store->errorInfo()];
                }
            } else { // exibe todos os erros enecontrado caso houver

                http_response_code(402);

                return ['status' => 402, 'msg' => $erro];
            }
        } catch (PDOException $th) {

            http_response_code(402);

            return ['erro' => $th->getMessage()];
        }
    }

    # Método para solicitação de servço ou reservas

    public static function solicitarReservas($utente, $servico, $posto, $horaFornecida, $dataFornecida)
    {
        try {

            $mensagemErro = false;
            $dataSolicitacao = "";
            $horaSolicitacao = "";

            // verfica se há alguma valor vazio

            if (($posto <= 0) || ($servico <= 0) || ($utente <= 0)) {
                $mensagemErro = 'Verifique e preencha todos campos ';
            }

            // Verifique se a hora foi fornecida e está no formato apropriado (HH:MM)
            if (empty($horaFornecida) || !preg_match('/^(0[8-9]|1[0-5]):[0-5][0-9]$/', $horaFornecida)) {
                $mensagemErro = "Por favor, insira uma hora válida no formato HH:MM dentro do intervalo de 8h às 15h59.";
            } else {
                list($hora, $minuto) = explode(':', $horaFornecida);

                if ($hora < 8 || ($hora == 15 && $minuto > 59) || $hora > 15) {
                    $mensagemErro = "A hora deve estar no intervalo das 8h às 15h59.";
                } else {
                    $horaSolicitacao = $hora . ':' . $minuto;
                }
            }

            // Recupere a data fornecida pelo usuário (do seu campo de entrada HTML)
            // Verifique se a data foi fornecida e está no formato apropriado (AAAA-MM-DD)
            if (empty($dataFornecida) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataFornecida)) {
                $mensagemErro = "Por favor, insira uma data válida no formato AAAA-MM-DD.";
            } else {
                $dataFormatada = date('Y-m-d', strtotime($dataFornecida));

                if (strtotime($dataFormatada) > strtotime(date('Y-m-d'))) {
                    if (date('N', strtotime($dataFormatada)) >= 6) {
                        $mensagemErro = "A data futura não pode ser um sábado ou domingo.";
                    } else {
                        $dataFormatada = $dataFornecida;
                    }
                } else {
                    $mensagemErro = "A data deve ser uma data futura.";
                }
            }

            $dataSolicitacao = $dataFormatada;

            // verifica se há resrvas duplicadas do mesmo utente

            $check = static::getInstance()->query("SELECT *FROM  solicitacao_reserva AS SR
                INNER JOIN estado_solicitacao AS ES ON SR.idEstadoSolicitacao = ES.idestado_solicitacao
                WHERE 
                SR.idPosto = '$posto' AND 
                SR.idDocumento = '$servico' AND 
                SR.idContaUtente = '$utente' AND
                SR.solicitacaoReservaData = '$dataSolicitacao' AND
                Es.estadoSolicitacao = 'pendente' ");

            if ($check->rowCount() > 0) {
                $mensagemErro = 'Verificamos que já solicitou uma reserva para este serviço nesta data e posto.';
            }

            // prepara para efetuar a rserva
            $query = "INSERT INTO solicitacao_reserva (idContaUtente, idDocumento, idPosto, solicitacaoReservaHora, solicitacaoReservaData)
        VALUES(?,?,?,?,?)";

            //recupera os valores para a solicitação
            $solicitar = static::getInstance()->prepare($query);
            $solicitar->bindValue(1, $utente);
            $solicitar->bindValue(2, $servico);
            $solicitar->bindValue(3, $posto);
            $solicitar->bindValue(4, $horaSolicitacao);
            $solicitar->bindValue(5, $dataSolicitacao);
            //verifica a existencia de erros
            if (!$mensagemErro) {
                // verifica a inconsistencia da sintaxe
                if ($solicitar->execute()) {

                    // retorna a mensagem de sucesso caso estivr tudo ok

                    http_response_code(200);

                    return ['status' => 200, 'msg' => 'Sua reserva foi efetuada, aguarde... ' . $dataFornecida];
                } else {

                    // mostra a incositencia
                    http_response_code(402);

                    return ['status' => 402, 'msg' => $solicitar->errorInfo()];
                }
            } else {

                // exibe os erros captudarado

                http_response_code(402);

                return ['status' => 402, 'msg' => $mensagemErro];
            }
        } catch (PDOException $th) {

            // mensagem de erro de consulta caso existir
            http_response_code(402);

            return ['status' => 402, 'msg' => $th->getMessage()];
        }
    }

    # Mostra um calend+ario de datas disponiveis nesse ano

    public static function mostraDatasDisponiveisParaReserva()
    {

        // busca data na bd de solicitação de reserva
        $data = self::getInstance()->query("SELECT *FROM solicitacao_reserva")->fetch()->solicitacaoReservaData;
        // Data da última entrada na base de dados (simulada)
        $dataUltimaEntradaNaBD = new DateTime($data);

        // Data atual
        $dataAtual = new DateTime();

        // Dias da semana por extenso
        $diasDaSemana = [
            1 => 'Segunda-feira',
            2 => 'Terça-feira',
            3 => 'Quarta-feira',
            4 => 'Quinta-feira',
            5 => 'Sexta-feira',
            6 => 'Sábado',
            7 => 'Domingo'
        ];

        // Exibir datas que não estão na BD
        $intervalo = new DateInterval('P1D'); // Intervalo de um dia
        $dataTermino = clone $dataUltimaEntradaNaBD;
        $dataTermino->modify('+6 months'); // Defina o limite de acordo com suas necessidades

        $periodo = new DatePeriod($dataUltimaEntradaNaBD, $intervalo, $dataTermino);

        $datasNaBD = [
            '2023-08-23', // Substitua pelas datas reais da sua base de dados
            // Adicione mais datas aqui conforme necessário
        ];

        $datasExibidas = [];

        return ($periodo);
    }

    // mostrar reservas de um utente

    public static function show($idUtente)
    {

        // query de busca juntando 4 entidades
        $query = "SELECT *FROM solicitacao_reserva AS SR
        INNER JOIN documentos AS DOC ON SR.idDocumento = DOC.iddocumento
        INNER JOIN postos AS PT ON SR.idPosto = PT.idposto
        INNER JOIN estado_solicitacao AS ESR ON SR.idEstadoSolicitacao = ESR.idestado_solicitacao
        WHERE SR.idContaUtente = '$idUtente'";

        // retorna os dados da BD para a view
        return static::getInstance()->query($query)->fetchAll();
    }

    public static function verReservas()
    {

        // query de busca juntando 4 entidades
        $query = "SELECT *FROM solicitacao_reserva AS SR
        INNER JOIN documentos AS DOC ON SR.idDocumento = DOC.iddocumento
        INNER JOIN utentes AS UT ON SR.idContaUtente = UT.idutente
        INNER JOIN estado_solicitacao AS ESR ON SR.idEstadoSolicitacao = ESR.idestado_solicitacao";

        // retorna os dados da BD para a view
        return static::getInstance()->query($query)->fetchAll();
    }
}
