<?php

namespace App\Model;

use App\Model\Conexao as ligar;


class Utentes
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

    public static function validarDados($nome, $email, $telefone, $senha)
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

        $regexSenha = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
        if (!preg_match($regexSenha, $senha)) {
            $erro =  'Senha fraca, deve conter no minímo 8 carácteres letras e números';
        }

        $regexTelefoneAO = '/^\+244\d{9}$/';
        if (!preg_match($regexTelefoneAO, '+244' . $telefone)) { // valida o telefone
            $erro = 'Número de telefone inválido';
        }

        // verifica se o utente já está cadastrado

        # Verifica via e-mail
        $chekMailUtente = self::getInstance()->query("SELECT *FROM utentes WHERE utenteEmail = '$email'");
        if ($chekMailUtente->rowCount() > 0) {
            $erro = 'Este e-mail já está registrado';
        }

        # verifica via telfone
        $chekPhonelUtente = self::getInstance()->query("SELECT *FROM utentes WHERE utenteTelefone = '$telefone'");
        if ($chekPhonelUtente->rowCount() > 0) {
            $erro = 'Este telefone já está registrado';
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
        $senhaSegura = password_hash($senhaAtual, PASSWORD_DEFAULT);
        // verifica se a senha Digita é igual com a sennha atual
        if (password_verify($senha, $senhaSegura)) {
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
    public static function gravardaDadosUtente($nome, $email, $telefone, $senha)
    {

        try {   // faz uma tentativa de captura de erros

            // cria um HasH de senha segura
            $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);

            $statment = self::getInstance()->prepare("INSERT INTO utentes (utenteNome, utenteTelefone, utenteEmail, utenteSenha)
        VALUES(?,?,?,?)");
            $statment->bindValue(1, $nome);
            $statment->bindValue(2, $telefone);
            $statment->bindValue(3, $email);
            $statment->bindValue(4, $senhaSegura); // o (MD5()) criar uma máscara de senha

            //verifica se existe algum dado mal preenchido
            $checkerros = self::validarDados($nome, $email, $telefone, $senha);

            if (!$checkerros) {
                // prepara os dados antes de inserir na Base de Dados
                if ($statment->execute()) {       // verifica se ta tudo em ordem
                    //sself::enviarEmailConfirmacao($nome, $email);
                    return ['status' => 'sucesso', 'msg' => 'Dados registrados, foi enviado um e-mail com o código de ativação para ' . $email . ', verifica a sua caixa de entrada.'];      // envia mensagem de sucesso
                } else {
                    return ['status' => 'erro', 'msg' => 'algo deu errado, contacte o desenvolvedor'];      // envia mensagem de sucesso
                }
            } else {  // mostra o campo que foimal preenchido, caso houver
                return ['status' => 'erro', 'msg' => $checkerros];      // envia mensagem de erro
            }
        } catch (\Throwable $th) {
            return ['status' => 'erro', 'msg' => 'Algo deu errado, tente novamente' . $th];
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
            utenteSenha = ? 
            WHERE idutente = ?");

            $senhaSegura = password_hash($senhaNova, PASSWORD_DEFAULT);
            $statment->bindValue(1, $senhaSegura);
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

    // exibindo todos os utetes
    public static function index()
    {
        // consulta na base de dados
        $busca = "SELECT *FROM utentes";

        //executa a busca
        $executaBusca = self::getInstance()->query($busca);

        $resultadoBusca = $executaBusca->fetchAll(); // guarda o resultado a busca

        // retorna o resulta
        return $resultadoBusca;
    }

    // exibindo Dados do utente no perfil a partir do seu ID
    public static function mostrarDadosUtentePorId($idUtente)
    {
        $busca = "SELECT *FROM utentes WHERE idutente = '$idUtente'";

        $executaBusca = self::getInstance()->query($busca);

        $resultadoBusca = $executaBusca->fetch();

        // retorna o resulta
        return $resultadoBusca;
    }

    /* Fazer login Utente no sistema */
    public static function loginUtente($email, $senha)
    {

        $selectEmail = self::getInstance()->query("SELECT utenteEmail FROM utentes WHERE utenteEmail = '" . $email . "'");
        if ($selectEmail->rowCount() > 0) {

            //  $selectPassord = self::getInstance()->query("SELECT utenteSenha FROM utentes WHERE utenteEmail = '" . $email . "'")->fetch()->utenteSenha;
            $selectPassordHash = self::getInstance()->query("SELECT utenteSenha FROM utentes WHERE utenteEmail = '" . $email . "'")->fetch()->utenteSenha;

            // VERICA A SENHA SEGURA

            if (password_verify($senha, $selectPassordHash)) {
                $data = self::getInstance()->query("SELECT * FROM utentes WHERE utenteEmail = '$email' AND utenteSenha = '$selectPassordHash'");

                if ($data->rowCount() > 0) {
                    session_start();
                    $_SESSION['idUtente'] = $data->fetch()->idutente;

                    return ['status' => 'sucesso', 'msg' => 'Sucesso. Aguarde...'];
                } else {
                    return ['status' => 'erro', 'msg' => 'Verifique se os seus dados estão corretos', 'data' => $_POST];
                }
            } else {

                return ['status' => 'erro', 'msg' => 'palavra-passe incorreta'];
            }
        } else {
            return ['status' => 'erro', 'msg' => 'E-mail inexistente'];
        }
    }
}
