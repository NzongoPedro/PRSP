<?php

namespace App\Model;

use App\Model\Conexao as ligar;


class Gestor
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

    public static function validarDados($nome, $email, $telefone, $senha, $passe)
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

        // verifica se ogestor já está cadastrado

        # Verifica via e-mail
        $chekMail = self::getInstance()->query("SELECT *FROM gestores WHERE gestorEmail = '$email'");
        if ($chekMail->rowCount() > 0) {
            $erro = 'Este e-mail já está registrado';
        }

        # verifica via telfone
        $chekPhonel = self::getInstance()->query("SELECT *FROM gestores WHERE gestorTelefone = '$telefone'");
        if ($chekPhonel->rowCount() > 0) {
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
    public static function gravardaDadosGestor($nome, $email, $telefone, $senha, $passe)
    {

        try {   // faz uma tentativa de captura de erros

            // cria um HasH de senha segura
            $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);

            $statment = self::getInstance()->prepare("INSERT INTO gestores (gestorNome, gestorTelefone, gestorEmail, gestorDocs, gestorSenha)
        VALUES(?,?,?,?,?)");
            $statment->bindValue(1, $nome);
            $statment->bindValue(2, $telefone);
            $statment->bindValue(3, $email);
            $statment->bindValue(4, $passe);
            $statment->bindValue(5, $senhaSegura);

            //verifica se existe algum dado mal preenchido
            $checkerros = self::validarDados($nome, $email, $telefone, $senha, $passe);

            if (!$checkerros) {
                // prepara os dados antes de inserir na Base de Dados
                if ($statment->execute()) {       // verifica se ta tudo em ordem
                    //sself::enviarEmailConfirmacao($nome, $email);
                    return ['status' => (200), 'msg' => 'Dados registrados'];      // envia mensagem de sucesso
                } else {
                    return ['status' => (402), 'msg' => 'algo deu errado, contacte o desenvolvedor'];      // envia mensagem de sucesso
                }
            } else {  // mostra o campo que foimal preenchido, caso houver
                http_response_code(402);
                return ['status' => (402), 'msg' => $checkerros];      // envia mensagem de erro
            }
        } catch (\Throwable $th) {
            return ['status' => (402), 'msg' => 'Algo deu errado, tente novamente' . $th];
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

    // exibindo Dados do Gestor autenticado
    public static function mostrarDadosGestorPorId($idGestor)
    {
        // Pesquisa na base de dado
        $busca = "SELECT *FROM gestores WHERE idgestor = '$idGestor'";

        // executa a busca
        $executaBusca = self::getInstance()->query($busca);

        //armazena o resultado da busca
        $resultadoBusca = $executaBusca->fetch();

        // retorna o resultado da busca
        return $resultadoBusca;
    }

    /* Fazer login Gestor no sistema */
    public static function loginGestor($email, $senha)
    {

        // verifica se o email fornecido existe na base de dados
        $selectEmail = self::getInstance()->query("SELECT gestorEmail FROM gestores WHERE gestorEmail = '" . $email . "'");

        if ($selectEmail->rowCount() > 0) {

            // se existir, scompara asenha da BD com a senha fornecida no login
            $selectPassordHash = self::getInstance()->query("SELECT gestorSenha FROM gestores WHERE gestorEmail = '" . $email . "'")->fetch()->gestorSenha;

            // VERICA A SENHA SEGURA

            if (password_verify($senha, $selectPassordHash)) {

                // se forem iguais as senhas, ele realiza o login
                $data = self::getInstance()->query("SELECT * FROM gestores WHERE gestorEmail = '$email' AND gestorSenha = '$selectPassordHash'");

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
