<?php

namespace App\Model;

use App\Model\Conexao as ligar;


class Admin
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

    public static function validarDados($nome, $email, $telefone, $nivel, $senha)
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
            $erro =  'Senha fraca, deve conter no minímo 8 carácteres letras e números. ' . $senha;
        }

        $regexTelefoneAO = '/^\+244\d{9}$/';
        if (!preg_match($regexTelefoneAO, '+244' . $telefone)) { // valida o telefone
            $erro = 'Número de telefone inválido';
        }

        // verifica se o adm já está cadastrado

        # Verifica via e-mail
        $chekMailAdm = self::getInstance()->query("SELECT *FROM administradores
        WHERE admEmail = '$email'");
        if ($chekMailAdm->rowCount() > 0) {
            $erro = 'Este e-mail já está registrado';
        }

        # verifica via telfone
        $chekPhoneAdm = self::getInstance()->query("SELECT *FROM administradores
        WHERE admTelefone = '$telefone'");
        if ($chekPhoneAdm->rowCount() > 0) {
            $erro = 'Este telefone já está registrado';
        }

        if ($nivel == 'Selecione um nível') {
            $erro = 'Selecione um nível';
        }

        return $erro; // Retorna os possíveis erros analisados
    }

    /*   public static function enviarEmailConfirmacao($nome, $email)
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
    public static function gravardaDadosAdm($nome, $email, $telefone, $nivel, $senha)
    {

        try {   // faz uma tentativa de captura de erros

            // cria um HasH de senha segura
            $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);

            $statment = self::getInstance()->prepare("INSERT INTO administradores
            (idNivelAcesso, admNome, admTelefone, admEmail, admSenha)
        VALUES(?,?,?,?,?)");
            $statment->bindValue(1, $nivel);
            $statment->bindValue(2, $nome);
            $statment->bindValue(3, $telefone);
            $statment->bindValue(4, $email);
            $statment->bindValue(5, $senhaSegura); // o (MD5()) criar uma máscara de senha

            //verifica se existe algum dado mal preenchido
            $checkerros = self::validarDados($nome, $email, $telefone, $nivel, $senha);

            if (!$checkerros) {
                // prepara os dados antes de inserir na Base de Dados
                if ($statment->execute()) {       // verifica se ta tudo em ordem
                    // self::enviarEmailConfirmacao($nome, $email);
                    return ['status' => 200, 'msg' => 'Dados registrados. Aguarde...'];      // envia mensagem de sucesso
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
    public static function alterardaDadosadm($nome, $email, $telefone, $idadm)
    {
        try {   // faz uma tentativa de captura de erros
            $statment = self::getInstance()->prepare("UPDATE administradores
            SET 
            admNome = ?, 
            admTelefone = ?, 
            admEmail = ?
            WHERE idadministrador = ?");

            $statment->bindValue(1, $nome);
            $statment->bindValue(2, $telefone);
            $statment->bindValue(3, $email);
            $statment->bindValue(4, $idadm); // o (MD5()) criar uma máscara de senha

            //verifica se existe algum dado mal preenchido
            $checkerros = self::validarDadosEditado($nome, $email, $telefone);

            if (!$checkerros) {
                // prepara os dados antes de inserir na Base de Dados
                if ($statment->execute()) {       // verifica se ta tudo em ordem
                    return ['status' => 200, 'msg' => 'sucesso, aguarde....'];      // envia mensagem de sucesso
                } else {
                    return ['status' => 'erro', 'msg' => 'algo deu errado, contacte o desenvolvedor', 'algo' => $statment->errorInfo()];      // envia mensagem de sucesso
                }
            } else {  // mostra o campo que foimal preenchido, caso houver
                return ['status' => 'erro', 'msg' => $checkerros];      // envia mensagem de erro
            }
        } catch (\Throwable $th) {
            return ['status' => 'erro', 'msg' => 'Algo deu errado, tente novamente '];
        }
    }

    /* Editar senha */
    public static function alterarSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idadm)
    {
        try {   // faz uma tentativa de captura de erros
            $statment = self::getInstance()->prepare("UPDATE administradores
            SET 
            administradores
            nha = ? 
            WHERE idadm = ?");

            $statment->bindValue(1, md5($senhaNovaRepetida));
            $statment->bindValue(2, $idadm); // o (MD5()) criar uma máscara de senha

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

    // exibindo Dados do adm no perfil a partir do seu ID
    public static function mostrarDadosAdmPorId($idAdm)
    {
        $busca = "SELECT *FROM administradores AS ADM
        INNER JOIN nivel_acesso_adm AS NA ON NA.idnivel_acesso_adm = ADM.idNivelAcesso
         WHERE ADM.idadministrador = '$idAdm'";

        $executaBusca = self::getInstance()->query($busca);

        $resultadoBusca = $executaBusca->fetch();

        // retorna o resulta
        return $resultadoBusca;
    }
    public static function index()
    {
        $busca = "SELECT *FROM administradores AS ADM
        INNER JOIN nivel_acesso_adm AS NA ON NA.idnivel_acesso_adm = ADM.idNivelAcesso";

        $executaBusca = self::getInstance()->query($busca);

        $resultadoBusca = $executaBusca->fetchAll();

        // retorna o resulta
        return $resultadoBusca;
    }

    /* Fazer login administrador no sistema */
    public static function loginAdmin($email, $senha)
    {

        $selectEmail = self::getInstance()->query("SELECT admEmail FROM administradores WHERE admEmail = '" . $email . "'");
        if ($selectEmail->rowCount() > 0) {

            //  $selectPassord = self::getInstance()->query("SELECT admSenha FROM administradors WHERE admEmail = '" . $email . "'")->fetch()->admSenha;
            $selectPassordHash = self::getInstance()->query("SELECT admSenha FROM administradores WHERE admEmail = '" . $email . "'")->fetch()->admSenha;

            // VERICA A SENHA SEGURA

            if (password_verify($senha, $selectPassordHash)) {
                $data = self::getInstance()->query("SELECT * FROM administradores WHERE admEmail = '$email' AND admSenha = '$selectPassordHash'");

                if ($data->rowCount() > 0) {
                    session_start();
                    $_SESSION['idAdmin'] = $data->fetch()->idadministrador;

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

    /* ALTERAR FOTO PERFIL */

    public static function alterarFoto($id_adm, $foto)
    {
        // foto
        $erros = "";

        $formatos_permitidos = array('png', 'jpeg', 'jpg', 'webp', 'jfif');

        $foto = array(
            'arquivo'  => $foto['name'],
            'temporal' => $foto['tmp_name'],
            'tipo' => strtolower($foto['type']),
            'formato'  => strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION)),
            'nome' => uniqid() . '.' . strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION)),
            'diretorio' => '../fotos/adm/'
        );

        if (in_array($foto['formato'], $formatos_permitidos)) {

            # ========================= VERIFICA O DIRECTORIO =====================
            if (is_dir($foto['diretorio'])) {

                # ===================================== TENTA O UPLOAD ==================
                if (move_uploaded_file($foto['temporal'], $foto['diretorio'] . $foto['nome'])) {
                    $foto = $foto['nome'];
                } else {
                    $erros = 'Falha no upload.';
                }
            } else {
                mkdir($foto['diretorio']);
                move_uploaded_file($foto['temporal'], $foto['diretorio'] . $foto['nome']);
                $foto = $foto['nome'];
            }
        } else {
            $foto = "";
            $erros = 'Formato .' . $foto['formato'] . ' não é permitido';
        }

        // update
        $up = self::getInstance()->prepare("INSERT INTO foto_adm (admFoto, idAdm)
            VALUES(?,?)");
        $up->bindValue(1, $foto);
        $up->bindValue(2, $id_adm);

        if (!$erros) {
            if ($up->execute()) {

                http_response_code(200);
                return ['status' => 200, 'msg' => 'Foto de perfil alterada'];
            } else {

                html_entity_decode(402);
                return ['status' => 402, 'msg' => 'Algo deu errado', 'erro' => $up->errorInfo()];
            }
        } else {

            http_response_code(402);
            return ['status' => 402, 'msg' => $erros];
        }
    }

    // foto Gestor 
    public static function verFoto($idAdm)
    {
        $foto = self::getInstance()->query("SELECT admFoto FROM foto_adm WHERE idfoto_adm = '$idAdm' ORDER BY idfoto_adm DESC LIMIT 0, 1");
        if ($foto->rowCount() > 0) {
            $foto =  ROUTE . 'fotos/adm/' . $foto->fetch()->admFoto;
        } else {
            $foto = ROUTE . 'storage/image/logo/logotipo1_principal.png';
        }

        return $foto;
    }
}
