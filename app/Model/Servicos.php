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
}
