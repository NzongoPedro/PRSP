<?php

/*  Este arquivo tem a função de recber
    Toda a requização de API feita A requizição e assincrona
    Não devo alterar nada sem conhecimento
 */
require '../vendor/autoload.php'; // autoload de classes
use App\controller\utentesController as utentes; // controller de utentes
use App\controller\admController as adm; // controller adm
use App\controller\GestoresController as gestor; // controller gestor
use App\controller\PostosController as postos;
use App\controller\ServicosController as servicos;

// verifica se exite uma ação de token

if (isset($_POST['acao'])) {
    // guarda esta ação numa váriavel

    $acaoUtente = htmlspecialchars(filter_input(INPUT_POST, 'acao'));

    // executa ações diferente de acordo aos casos

    switch ($acaoUtente) {
        case 'registro-utente': // instrução para registro de utentes
            // pega os dados vindo do formulário
            $nomeUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteNome'));
            $emailUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteEmail', FILTER_SANITIZE_EMAIL));
            $telefoneUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteTelefone', FILTER_SANITIZE_NUMBER_INT));
            $senhaUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteSenha'));
            // chama a controller de registro
            print json_encode(utentes::cadastrar($nomeUtente, $emailUtente, $telefoneUtente, $senhaUtente));
            break;

        case 'editar-dados-utente': // para editar utentes
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
            // chama a controller de login
            $emailUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteEmail', FILTER_SANITIZE_EMAIL));
            $senhaUtente = htmlspecialchars(filter_input(INPUT_POST, 'utenteSenha'));
            print json_encode(utentes::entrar($emailUtente, $senhaUtente));
            break;

        case 'login-admin':
            $emailAdmin = htmlspecialchars(addslashes(filter_input(INPUT_POST, 'emailAdmin', FILTER_SANITIZE_EMAIL)));
            $senhaAdmin = htmlspecialchars(addslashes(filter_input(INPUT_POST, 'senhaAdmin')));
            print json_encode(adm::entrar($emailAdmin, $senhaAdmin));
            break;

        case 'registrar-gestor':
            // recupera os dados vindo do formulário
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            // grava os dados do gestor
            echo json_encode(gestor::cadastrar($dados['username'], $dados['email'], $dados['telefone'], $dados['password'], $dados['pass']));
            break;
        case 'login-gestor': // login do gesor
            // recupera os dados do formulário
            $emailGestor = htmlspecialchars(addslashes(filter_input(INPUT_POST, 'emailGestor', FILTER_SANITIZE_EMAIL)));
            $senhaGestor = htmlspecialchars(addslashes(filter_input(INPUT_POST, 'senhaGestor')));
            // chamada  o controller para o login, passa os parametros
            print json_encode(gestor::entrar($emailGestor, $senhaGestor));
            break;
        case 'registrar-posto':

            // recupera os dados

            $nomePosto = htmlspecialchars(filter_input(INPUT_POST, 'nomePosto'));
            $emailPosto = htmlspecialchars(filter_input(INPUT_POST, 'emailPosto', FILTER_VALIDATE_EMAIL));
            $categoriaPosto = htmlspecialchars(filter_input(INPUT_POST, 'categoriaPosto', FILTER_VALIDATE_INT));
            $municipioPosto = htmlspecialchars(filter_input(INPUT_POST, 'municipioPosto'));
            $linkPosto = htmlspecialchars(filter_input(INPUT_POST, 'linkPosto', FILTER_VALIDATE_URL));
            $id_gestor = htmlspecialchars(filter_input(INPUT_POST, 'id-gestor', FILTER_VALIDATE_INT));
            $token = htmlspecialchars(filter_input(INPUT_POST, 'token'));

            echo json_encode(Postos::cadastrar($nomePosto, $emailPosto, $token, $linkPosto, $categoriaPosto, $id_gestor, $municipioPosto));
            break;

        case 'registrar-servico-posto': // registra documentos 

            // recupera os dados preenchido no formul+ario de seriços
            $nomeServico = htmlspecialchars(filter_input(INPUT_POST, 'servico-nome'));
            $tempoDuracaoServico = htmlspecialchars(filter_input(INPUT_POST, 'servico-tempo-duracao'));
            $precoServico = htmlspecialchars(filter_input(INPUT_POST, 'servico-preco'));
            $validadeServico = htmlspecialchars(filter_input(INPUT_POST, 'servico-validade'));
            $requisitosServico = nl2br(htmlspecialchars(filter_input(INPUT_POST, 'servico-requisitos')));
            $posto = htmlspecialchars(filter_input(INPUT_POST, 'id-posto', FILTER_SANITIZE_NUMBER_INT));

            // chama a coontroller que recebe os dados e envia para model e retorna a resposta para a view

            echo json_encode(servicos::store($nomeServico, $tempoDuracaoServico, $precoServico, $validadeServico, $requisitosServico, $posto));
            break;

        case 'solicitar-reserva':

            $posto = filter_input(INPUT_POST, 'posto', FILTER_SANITIZE_NUMBER_INT);
            $utente = filter_input(INPUT_POST, 'utente', FILTER_SANITIZE_NUMBER_INT);
            $servico = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_NUMBER_INT);
            $dataFornecida = filter_input(INPUT_POST, 'data-reserva');
            $horaFornecida = filter_input(INPUT_POST, 'hora-reserva');

            echo json_encode(servicos::solicitarReservas($utente, $servico, $posto, $horaFornecida, $dataFornecida));
            break;
    }
}
