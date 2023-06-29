<?php

/*  Este arquivo tem a função de recber
    Toda a requização de API feita pelo Utente
    A requizição e assincrona
 */
require '../vendor/autoload.php'; // autoload de classes
use App\controller\utentesController as utentes; // controller de utentes

// verifica se exite uma ação de token

if (isset($_POST['acaoUtente'])) {
    // guarda esta ação numa váriavel

    $acaoUtente = htmlspecialchars(filter_input(INPUT_POST, 'acaoUtente'));

    // executa ações diferente de acordo aos casos

    switch ($acaoUtente) {
        case 'registro-utente': // Verifica o registro e o relaza
            // pega os dados vindo do formulário
            $nomeUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteNome'));
            $emailUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteEmail', FILTER_SANITIZE_EMAIL));
            $telefoneUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteTelefone', FILTER_SANITIZE_NUMBER_INT));
            $senhaUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteSenha'));
            // chama a controller de registro
            print json_encode(utentes::cadastrar($nomeUtente, $emailUtente, $telefoneUtente, $senhaUtente));
            break;

        case 'editar-dados-utente': // Verifica o registro e o relaza
            // pega os dados vindo do formulário
            $nomeUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteNome'));
            $emailUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteEmail', FILTER_SANITIZE_EMAIL));
            $telefoneUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteTelefone', FILTER_SANITIZE_NUMBER_INT));
            $idUtente = htmlspecialchars(filter_input(INPUT_POST, 'idUtente'));
            // chama a controller de registro
            print json_encode(utentes::editar($nomeUtente, $emailUtente, $telefoneUtente, $idUtente));
            break;
        case 'editar-senha-utente': // Verifica o registro e o relaza
            // pega os dados vindo do formulário
            $senha = filter_input(INPUT_POST, 'senha');
            $senhaAtual = filter_input(INPUT_POST, 'utenteSenhaAtual');
            $senhaNova = filter_input(INPUT_POST, 'utenteSenhaNova');
            $senhaNovaRepetida = filter_input(INPUT_POST, 'utenteSenhaNovaRepetida');
            $idUtente = filter_input(INPUT_POST, 'idUtente', FILTER_SANITIZE_NUMBER_INT);
            // chama a controller de registro
            print json_encode(utentes::editaSenha($senha, $senhaAtual, $senhaNova, $senhaNovaRepetida, $idUtente));
            break;


        case 'login-utente': // Verifica o login
            // pega os dados vindo do formulário

            // chama a controller de login
            $emailUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteEmail', FILTER_SANITIZE_EMAIL));
            $senhaUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteSenha'));
            print json_encode(utentes::entrar($emailUtente, $senhaUtente));
            break;
    }
}
