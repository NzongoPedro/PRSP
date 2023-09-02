<?php

namespace App\Model;

use PDO;

use DateTime;
use DatePeriod;
use DateInterval;
use PDOException;
use App\Model\Conexao as ligar;

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

    public static function validarDados($estado, $nome, $posto)
    {

        $erro = "";

        $regexNomePt = '/^[\p{L}\s]+$/u';
        // valida o nome

        if (!preg_match($regexNomePt, $nome) && preg_match('/\d/', $nome)) {

            $erro = 'verifique o nome do documento por favor';
        }

        // verifica se esse documento já existe na bd
        $checkDoc = self::getInstance()->query("SELECT documentoDesignacao, idPosto FROM documentos WHERE documentoDesignacao = '$nome' AND idPosto ='$posto'");

        if ($checkDoc->rowCount() > 0) {

            $erro = 'Esta documento já existe na base de dados';
        }

        // verfifica  estado do posto
        if ($estado <= 1) {
            $erro = 'Ação não concluiída, o posto precisa ser ativado';
        }


        return $erro; // Retorna os possíveis erros analisados
    }

    // Método para adicionar os serviços na base dados

    public static function store($estado, $nome, $tempo, $preco, $validade, $requisitos, $posto)
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

            $erro = self::validarDados($estado, $nome, $posto);

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
                $mensagemErro = 'Verifique e preencha todos campos ' . $servico;
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
                Es.estadoSolicitacao = 'aprovado'");

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

                    return ['status' => 200, 'msg' => 'Sua reserva foi efetuada, aguarde... '];
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
        $data = "";
        // busca data na bd de solicitação de reserva
        $data = self::getInstance()->query("SELECT solicitacaoReservaData FROM solicitacao_reserva");
        // Data da última entrada na base de dados (simulada)
        if (($data->rowCount() <= 0)) {
            $data = '2023-05-05';
        } else {
            $data =   $data->fetch()->solicitacaoReservaData;
        }
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

    public static function verReservas($idPosto)
    {

        // query de busca juntando 4 entidades
        $query = "SELECT *FROM solicitacao_reserva AS SR
        INNER JOIN documentos AS DOC ON SR.idDocumento = DOC.iddocumento
        INNER JOIN utentes AS UT ON SR.idContaUtente = UT.idutente
        INNER JOIN estado_solicitacao AS ESR ON SR.idEstadoSolicitacao = ESR.idestado_solicitacao
        WHERE SR.idPosto= '$idPosto'
        ORDER BY SR.idsolicitacao_reserva DESC
         ";

        // retorna os dados da BD para a view
        return static::getInstance()->query($query)->fetchAll();
    }

    // aletrar estado da resrva

    public static function mudaEstado($id_estado, $id_solicitacao)
    {

        // query de mudança

        $query = "UPDATE solicitacao_reserva SET 
        idEstadoSolicitacao = ?
        WHERE idsolicitacao_reserva = ?";

        // prepara a alteração 
        $update = static::getInstance()->prepare($query);
        $update->bindValue(1, $id_estado);
        $update->bindValue(2, $id_solicitacao);

        // executa a mudança

        if ($update->execute()) {
            $msg = "";
            if ($id_estado == 1) {
                $msg = "Solicitação marcada como pendente";
            } elseif ($id_estado == 2) {
                $msg = "Solicitação aprovada com sucesso.";
            } else {
                $msg = "Solicitação recusada com sucesso.";
            }

            // sucesso

            http_response_code(200);

            return ['status' => 200, 'msg' => $msg];
        } else {

            // caso houver erro, exibe-0

            http_response_code(402);

            return ['status' => 402, 'msg' => $update->errorInfo()];
        }
    }

    //mostrar servisos por postos

    public static function verServicosPorIdPosto($idPosto)
    {

        $busca = "SELECT *FROM documentos WHERE idPosto = '$idPosto'";

        return static::getInstance()->query($busca)->fetchAll();
    }


    public static function verServicosPorId($id)
    {

        $busca = "SELECT *FROM documentos WHERE iddocumento = '$id'";

        return static::getInstance()->query($busca)->fetchAll();
    }

    // Gere comprovativo 

    public static function comprovativo($utente, $reserva, $referencia)
    {

        // coleta os dados
        $dados = "INSERT INTO comprovativo_reserva (codigoReferencia, idContaUtente, idReserva)
        VALUES(?,?,?)";

        // executa os dados coletados
        $salva = self::getInstance()->prepare($dados);

        $salva->bindValue(1, $referencia);
        $salva->bindValue(2, $utente);
        $salva->bindValue(3, $reserva);

        // verifica se o comprovativo ja foi gerado
        $verifica = self::getInstance()->query("SELECT idcomprovativo_reserva, idReserva FROM comprovativo_reserva WHERE idReserva = '$reserva'");

        if ($verifica->rowCount() > 0) {

            // retorna erro caso exista

            http_response_code(402);

            return ['status' => 402, 'msg' => 'Este comprovativo já foi gerado', 'id_comprovativo' => $verifica->fetch()->idcomprovativo_reserva];
        }
        // verfica se não há erros 

        if ($salva->execute()) {
            // salva os dados do comprovativo na BD
            // E pega o id do comprovativo por referencia
            $ultimoId =  self::getInstance()->query("SELECT idcomprovativo_reserva FROM comprovativo_reserva WHERE codigoReferencia = '$referencia'")->fetch()->idcomprovativo_reserva;
            http_response_code(200); // sucesso

            return ['status' => 200, 'msg' => 'Dados do comprovativo gerado', 'id_comprovativo' => $ultimoId];
        } else {

            // mostra erros, caso exista

            http_response_code(402); // erro
            return ['status' => 402, 'msg' => 'Erro', 'ErroMSG' => $salva->errorInfo()];
        }
    }

    // mostra comprovativo
    public static function mostrarDadosPDF($id_comprovativo)
    {
        // selecione os dados e junta s tabelas

        $select = self::getInstance()->query("SELECT *FROM comprovativo_reserva AS CP
        INNER JOIN utentes AS UT ON CP.idContaUtente = UT.idutente
        INNER JOIN solicitacao_reserva AS SR ON CP.idReserva = SR.idsolicitacao_reserva
        INNER JOIN documentos AS DOC ON SR.idDocumento = DOC.iddocumento
        INNER JOIN postos AS PT ON PT.idposto = SR.idPosto
        INNER JOIN estado_solicitacao AS ES ON SR.idEstadoSolicitacao = ES.idestado_solicitacao
        WHERE CP.idcomprovativo_reserva = '$id_comprovativo';
        ");
        // retorna e preenche o documento PDF

        return $select->fetch();
    }

    // verifica se o compravito do utente já foi gereado

    public static function verificaComprovativo($idUtente)
    {
        $busca = self::getInstance()->query("SELECT idcomprovativo_reserva FROM comprovativo_reserva WHERE idContaUtente ='$idUtente'");

        if ($busca->rowCount() > 0) {
            return $busca->fetch()->idcomprovativo_reserva;
        } else {
            return false;
        }
    }

    // lista comprovativos no utenete
    public static function listaComprovativo($idUtente)
    {
        $busca = self::getInstance()->query("SELECT *FROM comprovativo_reserva WHERE idContaUtente ='$idUtente'");

        if ($busca->rowCount() > 0) {
            return $busca->fetchAll();
        } else {
            return false;
        }
    }
}
