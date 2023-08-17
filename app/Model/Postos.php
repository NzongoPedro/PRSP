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

    public static function validarDados($nome, $email, $token, $categoria, $municipio)
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
    /* 
    public static function enviarEmailConfirmacao($nome, $email)
    {
        header("Access-Control-Allow-Origin: *");

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = $email;

        // Set the email subject.
        $subject = "Ativação da conta PRSP";

        // Generate a random confirmation code.
        $codigo = mt_rand(10000000, 99999999);

        // Build the email content.
        $email_content = "<h1 style='color: #333;'>PRSP - Plataforma de Reserva de Serviços Públicos</h1><br>";
        $email_content .= "<p style='color: #555;'>Olá prezado(a) " . $nome . ",</p>";
        $email_content .= "<p style='color: #555;'>Você efetuou um registro na nossa plataforma. Para usar a sua conta, é necessário fazer a ativação.</p>";
        $email_content .= "<br>";
        $email_content .= "<h2 style='color: #f00;  padding: 30px; backgrounf: #444'><span style='color: fbfbfb;'>Código:</span>  " . $codigo . "</h2>";

        // Build the email headers.
        // Build the email headers.
        $email_headers = "From: PRSP <prsp.bcc.ao/prsp>\r\n";
        $email_headers .= "Reply-To: PRSP <seguranca@prsp.bcc.ao>\r\n";
        $email_headers .= "MIME-Version: 1.0\r\n";
        $email_headers .= "Content-Type: text/html; charset=UTF-8\r\n";


        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            $erro = "Algo deu errado, tente novamente.";
        }
    } */


    /* Validadr dados a editar */
    public static function validarDadosEditado($nome, $email, $telefone)
    {

        $erro = "";

        $patternEmail = '/^[\w-]+(\.[\w-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';
        if (!preg_match($patternEmail, $email)) { // verifica email
            $erro = 'E-mail inválido';
        }

        $regexNomePt = '/^[\p{L}\s]+$/u';
        // valida o nome
        if (!preg_match($regexNomePt, $nome) && preg_match('/\d/', $nome)) {
            $erro = 'Nome inválido';
        }

        $regexTelefoneAO = '/^\+244\d{9}$/';
        if (!preg_match($regexTelefoneAO, '+244' . $telefone)) { // valida o telefone
            $erro = 'Número de telefone inválido';
        }

        return $erro; // Retorna os possíveis erros analisados
    }

    /* Validadr senhas a editar */
    public static function validarSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida)
    {

        $erro = "";

        // verifica se a senha Digita é igual com a sennha atual
        if ($senha != md5($senhaAtual)) {
            $erro =  'Senha atual incorreta';
        }

        //verifica se as senha nova foram as mesma nos dois campos
        if ($senhaNova != $senhaNovaRepetida) {
            $erro =  'digite as mesmas senhas por favor.';
        }

        // valida a senha nova
        $regexSenha = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
        if (!preg_match($regexSenha, $senhaNovaRepetida)) {
            $erro =  'Senha fraca, deve conter no minímo 8 carácteres letras e números';
        }

        return $erro; // Retorna os possíveis erros analisados
    }

    /* este método insere para base de dados os dados vindo do formulário */
    public static function gravardaDadosPosto($nome, $email, $token, $link, $categoria, $gestor, $municipio)
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
            $checkerros = self::validarDados($nome, $email, $token, $categoria, $municipio);

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

    /* Editar dados pessoais */
    public static function alterardaDadosUtente($nome, $email, $telefone, $idUtente)
    {
        try {   // faz uma tentativa de captura de erros
            $statment = self::getInstance()->prepare("UPDATE utentes SET 
            utenteNome = ?, 
            utenteTelefone = ?, 
            utenteEmail = ?
            WHERE idutente = ?");

            $statment->bindValue(1, $nome);
            $statment->bindValue(2, $telefone);
            $statment->bindValue(3, $email);
            $statment->bindValue(4, $idUtente); // o (MD5()) criar uma máscara de senha

            //verifica se existe algum dado mal preenchido
            $checkerros = self::validarDadosEditado($nome, $email, $telefone);

            if (!$checkerros) {
                // prepara os dados antes de inserir na Base de Dados
                if ($statment->execute()) {       // verifica se ta tudo em ordem
                    return ['status' => 'sucesso', 'msg' => 'sucesso, aguarde....'];      // envia mensagem de sucesso
                } else {
                    return ['status' => 'erro', 'msg' => 'algo deu errado, contacte o desenvolvedor'];      // envia mensagem de sucesso
                }
            } else {  // mostra o campo que foimal preenchido, caso houver
                return ['status' => 'erro', 'msg' => $checkerros];      // envia mensagem de erro
            }
        } catch (\Throwable $th) {
            return ['status' => 'erro', 'msg' => 'Algo deu errado, tente novamente'];
        }
    }

    /* Editar senha */
    public static function alterarSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idUtente)
    {
        try {   // faz uma tentativa de captura de erros
            $statment = self::getInstance()->prepare("UPDATE utentes SET 
            gestorSenha = ? 
            WHERE idutente = ?");

            $statment->bindValue(1, md5($senhaNovaRepetida));
            $statment->bindValue(2, $idUtente); // o (MD5()) criar uma máscara de senha

            //verifica se existe algum dado mal preenchido
            $checkerros = self::validarSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida);

            if (!$checkerros) {
                // prepara os dados antes de inserir na Base de Dados
                if ($statment->execute()) {       // verifica se ta tudo em ordem
                    return ['status' => 'sucesso', 'msg' => 'senha alterada'];      // envia mensagem de sucesso
                } else {
                    return ['status' => 'erro', 'msg' => 'algo deu errado, contacte o desenvolvedor ' . $statment->execute()];      // envia mensagem de sucesso
                }
            } else {  // mostra o campo que foimal preenchido, caso houver
                return ['status' => 'erro', 'msg' => $checkerros];      // envia mensagem de erro
            }
        } catch (\Throwable $th) {
            return ['status' => 'erro', 'msg' => 'Algo deu errado, tente novamente ' . $th];
        }
    }

    // exibindo dados do posto
    public static function index()
    {
        // consulta na base de dados
        $busca = "SELECT *FROM postos AS PT 
        INNER JOIN categoria_posto AS CP ON PT.idCategoriaPosto = CP.idcategoria_posto
        ORDER BY PT.postoDesignacao ASC";

        //executa a busca
        $executaBusca = self::getInstance()->query($busca);

        $resultadoBusca = $executaBusca->fetchAll(); // guarda o resultado a busca

        // retorna o resulta
        return $resultadoBusca;
    }
    // exibindo Dados do posto com o Gestor autenticado
    public static function mostrarDadosPostoPorGestor($idGestor)
    {

        try {
            // Pesquisa na base de dado juntando dados das tabelas relacionadas ao posto
            $busca = "SELECT *FROM postos AS PT
        INNER JOIN gestores AS GT ON PT.idContaGestor = GT.idgestor
        INNER JOIN documentos AS DC ON PT.idposto = DC.idPosto
         INNER JOIN estado_posto AS EP ON PT.idEstadoPosto = EP.idestado_posto
         INNER JOIN categoria_posto AS CP ON PT.idCategoriaPosto = CP.idcategoria_posto
         INNER JOIN administradores AS ADM ON EP.idContaAdm = ADM.idadministrador
        INNER JOIN tokens_posto AS TP ON TP.idPosto = PT.idPosto
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


    /* Fazer login Gestor no sistema */
    public static function loginGestor($email, $senha)
    {

        // verifica se o email fornecido existe na base de dados
        $selectEmail = self::getInstance()->query("SELECT gestorEmail FROM postos WHERE gestorEmail = '" . $email . "'");

        if ($selectEmail->rowCount() > 0) {

            // se existir, scompara asenha da BD com a senha fornecida no login
            $selectPassordHash = self::getInstance()->query("SELECT gestorSenha FROM postos WHERE gestorEmail = '" . $email . "'")->fetch()->gestorSenha;

            // VERICA A SENHA SEGURA

            if (password_verify($senha, $selectPassordHash)) {

                // se forem iguais as senhas, ele realiza o login
                $data = self::getInstance()->query("SELECT * FROM postos WHERE gestorEmail = '$email' AND gestorSenha = '$selectPassordHash'");

                if ($data->rowCount() > 0) {

                    // inicie a sessão
                    session_start();

                    // armazena o id da sessão
                    $_SESSION['idGestor'] = $data->fetch()->idgestor;

                    http_response_code(200);

                    return ['status' => (200), 'msg' => 'Sucesso. Aguarde...'];
                } else {

                    http_response_code(402);
                    // Retorna erro se houver uma falha ao prrencher os dados de login
                    return ['status' => (402), 'msg' => 'Verifique se os seus dados estão corretos', 'data' => $_POST];
                }
            } else {

                // retorna erro, caso as senha não forem iguais
                http_response_code(402);

                return ['status' => (402), 'msg' => 'palavra-passe incorreta'];
            }
        } else {

            http_response_code(402);

            // reorna ero caso o email de login não existir na BD

            return ['status' => (402), 'msg' => 'E-mail inexistente'];
        }
    }
}
