<?php

namespace App\Model;

use App\Model\Conexao as ligar;
use DateTime;
use PDOException;

class Postos
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

    /*
        @ Validação de dados 
        (Nome, e-mail, telefone, senha)
    */

    public static function validarDados($estado, $nome, $email, $token, $categoria, $municipio)
    {

        $erro = "";

        $patternEmail = '/^[\w-]+(\.[\w-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';
        if (!preg_match($patternEmail, $email)) { // verifica email
            $erro = 'E-mail inválido';
        }

        $regexNomePt = '/^[\p{L}\s]+$/u';
        // valida o nome

        if (ltrim(empty($nome)) || $nome == "" || strlen($nome) < 8) {
            $erro = 'verifique o nome do posto por favor';
        }

        // verifica se existe este nome na bd
        $chckNome = self::getInstance()->query("SELECT *FROM postos WHERE postoDesignacao = '$nome'");

        if ($chckNome->rowCount() > 0) {
            $erro = "Posto já cadastrado";
        }

        // categoria
        if ($categoria <= 0) {
            $erro = 'Escolha a catgoria do posto';
        }
        // municipio
        if ($municipio == 'Escolha o município') {
            $erro = 'Escolha o município do posto';
        }

        // verifica se posto já está cadastrado

        # Verifica via e-mail
        $chekMail = self::getInstance()->query("SELECT *FROM postos WHERE postoEmail = '$email'");
        if ($chekMail->rowCount() > 0) {
            $erro = 'Este e-mail já está registrado';
        }
        # Verifica via token
        $chekToken = self::getInstance()->query("SELECT *FROM tokens_posto WHERE token = '$token'");
        if ($chekToken->rowCount() > 0) {
            $erro = 'Este token já está registrado';
        }


        return $erro; // Retorna os possíveis erros analisados
    }


    /* este método insere para base de dados os dados vindo do formulário */
    public static function editardaDadosPosto($estado, $nome, $email, $municipio, $posto)
    {

        try {   // faz uma tentativa de captura de erros

            $statment = self::getInstance()->prepare("UPDATE postos SET
            postoDesignacao = ?, postoEmail = ?, postoMunicipio = ?, idEstadoPosto = ? WHERE idposto =?
       ");

            $statment->bindValue(1, $nome);
            $statment->bindValue(2, $email);
            $statment->bindValue(3, $municipio);
            $statment->bindValue(4, $estado);
            $statment->bindValue(5, $posto);


            //verifica se existe algum dado mal preenchido
            $erro = "";

            $patternEmail = '/^[\w-]+(\.[\w-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';
            if (!preg_match($patternEmail, $email)) { // verifica email
                $erro = 'E-mail inválido';
            }

            // municipio
            if ($municipio == 'Escolha o município') {
                $erro = 'Escolha o município do posto';
            }

            if (!$erro) {
                // prepara os dados antes de inserir na Base de Dados
                if ($statment->execute()) {       // verifica se ta tudo em ordem
                    session_start();
                    http_response_code(200);
                    unset($_SESSION['token-posto']);
                    return ['status' => (200), 'msg' => 'Dados registrados'];      // envia mensagem de sucesso

                } else {
                    http_response_code(402);
                    return ['status' => (402), 'msg' => 'algo deu errado, contacte o desenvolvedor ', 'error' => $statment->errorInfo()];      // envia mensagem de sucesso
                }
            } else {  // mostra o campo que foimal preenchido, caso houver
                http_response_code(402);
                return ['status' => (402), 'msg' => $erro];      // envia mensagem de erro
            }
        } catch (PDOException $th) {

            http_response_code(402);
            return ['status' => (402), 'msg' => 'Algo deu errado, tente novamente' . $th->getMessage()];
        }
    }

    /* este método insere para base de dados os dados vindo do formulário */
    public static function gravardaDadosPosto($estado, $nome, $email, $token, $link, $categoria, $gestor, $municipio)
    {

        try {   // faz uma tentativa de captura de erros

            $statment = self::getInstance()->prepare("INSERT INTO postos (postoDesignacao, postoEmail, postoMunicipio, postoLinkLocalizacao, idContaGestor, idCategoriaPosto, postoDataRegistro)
        VALUES(?,?,?,?,?,?,?)");

            $statment->bindValue(1, $nome);
            $statment->bindValue(2, $email);
            $statment->bindValue(3, $municipio);
            $statment->bindValue(4, $link);
            $statment->bindValue(5, $gestor);
            $statment->bindValue(6, $categoria);
            $statment->bindValue(7, date('Y-m-d H:i:s'));

            //verifica se existe algum dado mal preenchido
            $checkerros = self::validarDados($estado, $nome, $email, $token, $categoria, $municipio);

            if (!$checkerros) {
                // prepara os dados antes de inserir na Base de Dados
                if ($statment->execute()) {       // verifica se ta tudo em ordem
                    //sself::enviarEmailConfirmacao($nome, $email);
                    // Envia o id para o token
                    // Obtém o último ID inserido usando uma consulta SQL separada

                    $query = "SELECT idposto FROM postos WHERE postoEmail='$email'";
                    $result = self::getInstance()->query($query);
                    $row = $result->fetch();
                    $ultimoId = $row->idposto;

                    $insertToken = self::getInstance()->prepare("INSERT INTO tokens_posto (token, idPosto)
                    VALUES(?,?)");
                    $insertToken->bindValue(1, $token);
                    $insertToken->bindValue(2, $ultimoId);

                    if ($insertToken->execute()) {
                        http_response_code(200);
                        return ['status' => (200), 'msg' => 'Dados registrados'];      // envia mensagem de sucesso
                    } else {
                        http_response_code(402);
                        return ['status' => (402), 'msg' => 'algo deu errado, contacte o técnico ' . $ultimoId, 'error' => $insertToken->errorInfo()];      // envia mensagem de sucesso
                    }
                } else {
                    http_response_code(402);
                    return ['status' => (402), 'msg' => 'algo deu errado, contacte o desenvolvedor ', 'error' => $statment->errorInfo()];      // envia mensagem de sucesso
                }
            } else {  // mostra o campo que foimal preenchido, caso houver
                http_response_code(402);
                return ['status' => (402), 'msg' => $checkerros];      // envia mensagem de erro
            }
        } catch (PDOException $th) {

            http_response_code(402);
            return ['status' => (402), 'msg' => 'Algo deu errado, tente novamente' . $th->getMessage()];
        }
    }

    // exibindo dados do posto
    public static function index()
    {

        // consulta na base de dados
        $busca = "SELECT *FROM postos AS PT 
        INNER JOIN tipo_posto AS TP ON PT.idCategoriaPosto = TP.idcategoria_posto
        INNER JOIN gestores AS GT ON PT.idContaGestor = GT.idgestor
        INNER JOIN estado_posto AS EP ON PT.idEstadoPosto = EP.idestado_posto
        ORDER BY PT.postoDesignacao ASC";

        //executa a busca
        $executaBusca = self::getInstance()->query($busca);

        $resultadoBusca = $executaBusca->fetchAll(); // guarda o resultado a busca

        // retorna o resulta
        return $resultadoBusca;
    }
    // exibindo dados do posto
    public static function index_2($posto)
    {

        // consulta na base de dados
        $busca = "SELECT *FROM postos AS PT 
        INNER JOIN tipo_posto AS TP ON PT.idCategoriaPosto = TP.idcategoria_posto
        WHERE PT.idCategoriaPosto = '$posto'
        ORDER BY PT.postoDesignacao ASC
        ";

        //executa a busca
        $executaBusca = self::getInstance()->query($busca);

        $resultadoBusca = $executaBusca->fetchAll(); // guarda o resultado a busca

        // retorna o resulta
        return $resultadoBusca;
    }

    // retorna id posto

    public static function idPosto($idGestor)
    {
        $busca = static::getInstance()->query("SELECT *FROM postos WHERE idContaGestor = '$idGestor'")->fetch();
        return $busca;
    }
    // exibindo Dados do posto com o Gestor autenticado
    public static function mostrarDadosPostoPorGestor($idGestor)
    {

        try {
            // Pesquisa na base de dado juntando dados das tabelas relacionadas ao posto
            $busca = "SELECT *FROM postos AS PT
        INNER JOIN gestores AS GT ON PT.idContaGestor = GT.idgestor
         INNER JOIN estado_posto AS EP ON PT.idEstadoPosto = EP.idestado_posto
         INNER JOIN tipo_posto AS CP ON PT.idCategoriaPosto = CP.idcategoria_posto
         INNER JOIN administradores AS ADM ON EP.idContaAdm = ADM.idadministrador
        INNER JOIN tokens_posto AS TP ON TP.idPosto = PT.idposto
   
        WHERE PT.idContaGestor = '$idGestor'";

            $executaBusca = self::getInstance()->query($busca);
            // executa a busca

            //armazena o resultado da busca
            $resultadoBusca = $executaBusca->fetch();

            if (!$resultadoBusca) {
                return ['erro' => $executaBusca->errorInfo()];
            } else {
                // retorna o resultado da busca
                return $resultadoBusca;
            }
        } catch (PDOException $e) {
            return 'error ' . $e->getMessage();
        }
    } // exibindo Dados do posto com o Gestor autenticado

    public static function mostrarDadosPostoPorId($idposto)
    {

        try {
            // Pesquisa na base de dado juntando dados das tabelas relacionadas ao posto
            $busca = "SELECT *FROM documentos AS DC
            INNER JOIN postos AS PT ON PT.idposto = DC.idposto
             WHERE DC.idPosto = '$idposto' ORDER BY DC.documentoDesignacao ASC";

            $executaBusca = self::getInstance()->query($busca);
            // executa a busca

            //armazena o resultado da busca
            $resultadoBusca = $executaBusca->fetchAll();

            // retorna o resultado da busca
            return $resultadoBusca;
        } catch (PDOException $e) {
            return 'error ' . $e->getMessage();
        }
    }

    // verifica se um posto ja existe para Gestor

    public static function checkPosto($idGestor)
    {
        $select = static::getInstance()->query("SELECT *FROM postos WHERE idContaGestor = '$idGestor'");

        if ($select->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // aceeso via token ()

    public static function token($token, $idposto)
    {

        $msgErro = "";
        $msg = '';
        if (!isset($token)) {
            $msgErro = 'Token vazio';
        }

        // verifica o token na BD

        $tokenSelect = "SELECT *FROM tokens_posto WHERE token ='$token' && idPosto = '$idposto'";

        $pegarToken = static::getInstance()->query($tokenSelect);

        // verfica se o token existe

        if ($pegarToken->rowCount() > 0) {
            $msg = 'Acesso garantido, aguarde...';
        } else {
            $msgErro = "Token inválido " . $token;
        }

        // verifica se há erro

        if (!$msgErro) {

            // inicie a sessão
            session_start();

            $id_posto = $pegarToken->fetch()->idtokens_posto;
            $toke_acesso = $token;

            $_SESSION['token-posto'] = $toke_acesso;
            $_SESSION['id-posto'] = $id_posto;

            http_response_code(200);

            return ['status' => 200, 'msg' => $msg];
        } else {

            //caso houver erros
            http_response_code(402);

            return ['status' => 402, 'msg' => $msgErro];
        }
    }

    // aletrar estado da resrvao posto
    public static function mudaEstado($estado, $conta)
    {

        // query de mudança

        $query = "UPDATE postos SET 
           idEstadoPosto = ?
           WHERE idposto = ?";

        // prepara a alteração 
        $update = static::getInstance()->prepare($query);
        $update->bindValue(1, $estado);
        $update->bindValue(2, $conta);

        // executa a mudança

        if ($update->execute()) {
            $msg = "";
            if ($estado == 1) {
                $msg = "Conta desativada";
            } else {
                $msg = "Sucesso na ativação da conta";
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

    // eliminar posto
    public static function eliminarPosto($id_posto)
    {

        $remove = "DELETE FROM postos WHERE idposto = '$id_posto'";

        $executa = self::getInstance()->query($remove);

        // verifica se o posto foi removido:
        if ($executa) {

            // Remove todas as cheves ou registro relacionada a este posto

            http_response_code(200);
            return ['status' => 200, 'msg' => 'Sucesso ao eliminar o posto.'];
        } else {

            http_response_code(402);
            return ['status' => 402, 'msg' => 'falha ao eliminar o posto.'];
        }
    }
}
