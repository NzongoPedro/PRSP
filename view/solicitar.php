<link rel="stylesheet" href="<?= CSS ?>perfil.css">

<?php

use App\controller\utentesController as utentes;
use App\controller\ServicosController as servicos;
use App\Model\Servicos as comprovativo;


use App\controller\PostosController as postos;

$postos = postos::index();

// chama a class de auth
require_once './Auth/checkSessionUtente.php';
// executa o método #1 de autorização
$idUtente = $auth->checkSEssion();
if ($idUtente) :

    // Grava dos dados do Utente num vetor de dados
    $dadosUtente = utentes::mostraDadosUtente($idUtente);

    //Grava os dados da reserva desse utente
    $reservas = servicos::show($idUtente);

    // comprovativo
    $comprovativo = comprovativo::verificaComprovativo($idUtente);
    $comprovativos = comprovativo::listaComprovativo($idUtente);

endif
?>
<nav class="navbar fixed-top p-2 bg-dark">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="./" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <h5 class="titulo">Solicitar Reserva</h5>
    </div>
</nav>
<!-- Section Cover (Capa) -->
<br>
<section class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form action="#" id="form">
                <div class="form-floating mb-3">
                    <input type="hidden" name="utente" value="<?= $dadosUtente->idutente ?>">
                    <input type="text" value="<?= $dadosUtente->utenteNome ?>" class="form-control form-control-lg" id="floatingInput" disabled readonly>
                    <label for="floatingInput">O(A) solicitante</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <select class="form-select select-tipo" id="floatingSelect1" aria-label="Floating label select example">
                                <option selected>seleciona o tipo</option>
                                <option value="1">Notário</option>
                                <option value="2">Conservatório</option>
                            </select>
                            <label for="floatingSelect1">Tipo do posto</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected>selcione o posto</option>
                                <optgroup>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </optgroup>
                            </select>
                            <label for="floatingSelect">Posto</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-lg nome-documento" id="floatingSe" value="" readonly disabled>
                    <label for="floatingSe">Serviço solicitado</label>
                    <input type="hidden" id="idDocumento" value="" name="documento">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="date" name="data-reserva" class="form-control form-control-lg" id="floatingData" required>
                            <label for="floatingData">Escolha uma data</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="time" name="hora-reserva" class="form-control form-control-lg" id="floatingHora" required>
                            <label for="floatingHora">Escolha uma hora</label>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Ver dias disponíveis
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body" style="max-height: 200px; overflow-y: auto;">
                                    <?php
                                    $datasNaBD = [
                                        '2023-08-23', // Substitua pelas datas reais da sua base de dados
                                        // Adicione mais datas aqui conforme necessário
                                    ];
                                    $diasDaSemana = [
                                        1 => 'Segunda-feira',
                                        2 => 'Terça-feira',
                                        3 => 'Quarta-feira',
                                        4 => 'Quinta-feira',
                                        5 => 'Sexta-feira',
                                    ];

                                    foreach ($servicos as $dataHora) {
                                        $dataFormatada = $dataHora->format('Y-m-d');

                                        // Verificar se a data não está na base de dados
                                        if (!in_array($dataFormatada, $datasNaBD)) {
                                            $diaDaSemana = $dataHora->format('N'); // 1 (Segunda-feira) a 7 (Domingo)

                                            // Verificar se o dia da semana não é sábado (6) nem domingo (7)
                                            if ($diaDaSemana != 6 && $diaDaSemana != 7) {
                                                $dataPorExtenso = $dataHora->format('d/m/Y');
                                    ?>
                                                <div class="alert alert-success mb-2">
                                                    <span>
                                                        <i class="bi bi-check-circle-fill h5 me-2"></i>
                                                        <?= $dataPorExtenso ?> | <?= $diasDaSemana[$diaDaSemana] ?>
                                                    </span>
                                                </div>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid p-0 mt-3">
                        <div class="resposta text-center"></div>
                        <div class="text-center">
                            <button type="submit" class="col-12 btn btn-warning btn-lg rounded-4 border-0">Enviar a Solicitação</button>
                            <button type="button" class="mt-2 btn btn-danger btn-lg rounded-2 border-0" data-bs-dismiss="modal">Descartar o Envio</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</section>
<!-- Fim seccção foto de capa -->

<style>
    footer,
    .navegacao {
        display: none !important;
    }

    .acordos span {
        font-size: 12px !important;
        display: block !important;
        margin-bottom: 6px;
        border-bottom: dotted 1px #444 !important;

    }
</style>

<script>
    const select_tipo = document.querySelector('.select-tipo')

    select_tipo.addEventListener('change', () => {

        const dados = new FormData()

        dados.append('acao', 'busca-tipo-posto')
        dados.append('posto', select_tipo.value)
        // pega todos os postos selecionado

        fetch('<?= ROUTE ?>Requests/requestAjax.php', {
                method: 'POST',
                body: dados
            })
            .then(res => res.json())
            .then(resposta => {

            })
    })
</script>