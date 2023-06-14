<?php

namespace App\Model;

use App\Model\conexao as ligar;


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

    /* este método insere para base de dados os dados vindo do formulário */
    public static function gravardaDadosUtente($nome, $email, $telefone, $senha)
    {
        try {   // faz uma tentativa de captura de erros
            $statment = self::getInstance()->prepare("INSERT INTO utentes (utenteNome, utenteTelefone, utenteEmail, utenteSenha)
        VALUES(?,?,?,?)");
            $statment->bindValue(1, $nome);
            $statment->bindValue(2, $telefone);
            $statment->bindValue(3, $email);
            $statment->bindValue(4, md5($senha)); // o (MD5()) criar uma máscara de senha

            //verifica se existe algum dado mal preenchido
            $checkerros = self::validarDados($nome, $email, $telefone, $senha);

            if (!$checkerros) {
                // prepara os dados antes de inserir na Base de Dados
                if ($statment->execute()) {       // verifica se ta tudo em ordem
                    return ['status' => 'sucesso', 'msg' => 'Dados registrados, aguarde verificação'];      // envia mensagem de sucesso
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

    /* Fazer login Utente no sistema */

    public static function loginUtente($email, $senha)
    {
        $selectEmail = self::getInstance()->query("SELECT utenteEmail FROM utentes WHERE utenteEmail = '" . $email . "'");
        if ($selectEmail->rowCount() > 0) {
            $selectPassord = self::getInstance()->query("SELECT utenteSenha FROM utentes WHERE utenteSenha = '" . $senha . "'");
            if ($selectPassord->rowCount() > 0) {
                $data = self::getInstance()->query("SELECT *FROM utentes WHERE utenteEmail = '$email' AND utenteSenha = '$senha'");
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
