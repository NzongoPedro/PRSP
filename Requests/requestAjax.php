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
        case 'editar-gestor':
            // recupera os dados vindo do formulário
            $nome = filter_input(INPUT_POST, 'firstName');
            $sobrenome = filter_input(INPUT_POST, 'lastName');
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $gestor = filter_input(INPUT_POST, 'id-gestor', FILTER_SANITIZE_NUMBER_INT);
            $telefone = filter_input(INPUT_POST, 'phoneNumber');
            $nome = $nome . " " . $sobrenome;

            // edita os dados do gestor
            print json_encode(gestor::EditarGestor($nome, $email, $telefone, $gestor));

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
            $token = htmlspecialchars(filter_input(INPUT_POST, 'tokenName'));
            $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_NUMBER_INT);
            echo json_encode(Postos::cadastrar($estado, $nomePosto, $emailPosto, $token, $linkPosto, $categoriaPosto, $id_gestor, $municipioPosto));
            break;
        case 'editar-posto':


            // recupera os dados

            $nomePosto = htmlspecialchars(filter_input(INPUT_POST, 'nomePosto'));
            $emailPosto = htmlspecialchars(filter_input(INPUT_POST, 'emailPosto', FILTER_VALIDATE_EMAIL));
            $posto = filter_input(INPUT_POST, 'id-posto', FILTER_SANITIZE_NUMBER_INT);
            $municipioPosto = htmlspecialchars(filter_input(INPUT_POST, 'municipioPosto'));
            $estado = 1;
            echo json_encode(Postos::editardaDadosPosto($estado, $nomePosto, $emailPosto, $municipioPosto, $posto));
            break;

        case 'registrar-servico-posto': // registra documentos 

            // recupera os dados preenchido no formul+ario de seriços
            $nomeServico = htmlspecialchars(filter_input(INPUT_POST, 'servico-nome'));
            $tempoDuracaoServico = htmlspecialchars(filter_input(INPUT_POST, 'servico-tempo-duracao'));
            $precoServico = htmlspecialchars(filter_input(INPUT_POST, 'servico-preco'));
            $validadeServico = htmlspecialchars(filter_input(INPUT_POST, 'servico-validade'));
            $requisitosServico = nl2br(htmlspecialchars(filter_input(INPUT_POST, 'servico-requisitos')));
            $posto = htmlspecialchars(filter_input(INPUT_POST, 'id-posto', FILTER_SANITIZE_NUMBER_INT));
            $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_NUMBER_INT);
            // chama a coontroller que recebe os dados e envia para model e retorna a resposta para a view

            echo json_encode(servicos::store($estado, $nomeServico, $tempoDuracaoServico, $precoServico, $validadeServico, $requisitosServico, $posto));
            break;

        case 'solicitar-reserva':

            $posto = filter_input(INPUT_POST, 'posto', FILTER_SANITIZE_NUMBER_INT);
            $utente = filter_input(INPUT_POST, 'utente', FILTER_SANITIZE_NUMBER_INT);
            $servico = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_NUMBER_INT);
            $dataFornecida = filter_input(INPUT_POST, 'data-reserva');
            $horaFornecida = filter_input(INPUT_POST, 'hora-reserva');

            echo json_encode(servicos::solicitarReservas($utente, $servico, $posto, $horaFornecida, $dataFornecida));
            break;

        case 'muda-estado-solicitacoes':

            $id_estado = filter_input(INPUT_POST, 'id-estado', FILTER_SANITIZE_NUMBER_INT);
            $id_solicitacao = filter_input(INPUT_POST, 'id-solicitacao', FILTER_SANITIZE_NUMBER_INT);

            print json_encode(servicos::mudaEstado($id_estado, $id_solicitacao));
            break;

        case 'muda-estado-posto':

            $estado = filter_input(INPUT_POST, 'id-estado', FILTER_SANITIZE_NUMBER_INT);
            $conta = filter_input(INPUT_POST, 'posto', FILTER_SANITIZE_NUMBER_INT);

            print json_encode(postos::mudaEstado($estado, $conta));
            break;

        case 'muda-estado-gestor':

            $estado = filter_input(INPUT_POST, 'id-estado', FILTER_SANITIZE_NUMBER_INT);
            $conta = filter_input(INPUT_POST, 'gestor', FILTER_SANITIZE_NUMBER_INT);

            print json_encode(gestor::mudaEstado($estado, $conta));
            break;

        case 'check-estado-gestor':
            $conta = filter_input(INPUT_POST, 'gestor', FILTER_SANITIZE_NUMBER_INT);
            print gestor::checkEstado($conta);
            break;

        case 'altera-foto-gestor':
            $foto = $_FILES['imagem'];
            $conta = filter_input(INPUT_POST, 'gestor', FILTER_SANITIZE_NUMBER_INT);
            print json_encode(gestor::alterarFoto($conta, $foto));
            break;

        case 'altera-foto-adm':
            $foto = $_FILES['imagem'];
            $conta = filter_input(INPUT_POST, 'adm', FILTER_SANITIZE_NUMBER_INT);
            print json_encode(adm::alterarFoto($conta, $foto));
            break;

        case 'elimina-posto':

            $idposto = filter_input(INPUT_POST, 'posto', FILTER_SANITIZE_NUMBER_INT);
            print json_encode(postos::eliminarPosto($idposto));
            break;

        case 'elimina-gestor':

            $idgestor = filter_input(INPUT_POST, 'gestor', FILTER_SANITIZE_NUMBER_INT);
            print json_encode(gestor::eliminarGestor($idgestor));
            break;

        case 'acesso-token':

            $token = filter_input(INPUT_POST, 'token');
            $idposto = filter_input(INPUT_POST, 'id-posto');
            print json_encode(postos::token($token, $idposto));
            break;

        case 'cadastra-adm':
            $nome = filter_input(INPUT_POST, 'nome');
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone');
            $nivel = filter_input(INPUT_POST, 'senha');
            $senha = filter_input(INPUT_POST, 'nivel');
            print json_encode(adm::cadastrar($nome, $email, $telefone, $senha, $nivel));
            break;

        case 'edita-adm':
            $nome = filter_input(INPUT_POST, 'nome');
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone');
            $id_adm = filter_input(INPUT_POST, 'adm');
            print json_encode(adm::editar($nome, $email, $telefone, $id_adm));
            break;

        case 'cria-comprovativo':
            $utente = filter_input(INPUT_POST, 'utente', FILTER_SANITIZE_NUMBER_INT);
            $reserva = filter_input(INPUT_POST, 'reserva', FILTER_SANITIZE_NUMBER_INT);
            $referencia = filter_input(INPUT_POST, 'referencia');
            print json_encode(servicos::comprovativo($utente, $reserva, $referencia));
            break;

            //ver posto na reserva 
        case 'busca-tipo-posto':
            $posto = filter_input(INPUT_POST, 'posto');
            print json_encode(postos::index_2($posto));
            break;

        case 'busca-servico-posto':
            $posto = filter_input(INPUT_POST, 'posto');
            print json_encode(servicos::verServicosPorIdPosto($posto));
            break;

            // gera relatorios

        case 'relatorios':
            $tipo = filter_input(INPUT_POST, 'tipo');
            $response = (servicos::relatorios($tipo));
            echo
            '
            <div class="c">
                <div class="table-responsive mt-3">
                Relatório ' . $tipo . '
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Utente</th>
                                <th scope="col">Documento</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Data</th>
                                <th scope="col">Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                  ';
            if (count($response) > 0) {
                foreach ($response as $relatorio) {
                    echo '
                        <tr class="">
                                <td scope="row">' . $relatorio->utenteNome . '</td>
                                <td scope="row">' . $relatorio->documentoDesignacao . '</td>
                                <td scope="row">' . $relatorio->estadoSolicitacao . '</td>
                                <td>' . $relatorio->solicitacaoReservaData . '</td>
                                <td>' . $relatorio->solicitacaoReservaHora . '</td>
                        </tr>
                    ';
                }
            } else {
            }
            echo
            '
                </tbody>
                        </table>
                    </div>
                </div>
            ';
            break;

        default:

            break;
    }
}
