<?php

namespace App\Model;

use PDO;
use PDOException;
use PDOStatement;

class Conexao
{
    private $username, $servername, $password, $ligar; // pega os requisitos para a conexão

    public  function ligar()
    {
        try {

            //atribui ou guardar as credecnias ndo banco numa variavel
            $this->username = 'root';
            $this->servername = 'localhost';
            $this->password = '';
            // tenta realizar a conexão
            $this->ligar = new PDO("mysql:host=" . $this->servername . ";dbname=prsp", $this->username, $this->password);
            $this->ligar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->ligar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $this->ligar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            $this->ligar->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $this->ligar;
            //echo "Sucesso na conexão";
        } catch (PDOException $e) {
            echo json_encode("Erro na conexão: " . $e->getMessage(), JSON_ERROR_UTF8);
            // falha de conexão
        }
    }
}
