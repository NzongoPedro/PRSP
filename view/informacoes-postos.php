<link rel="stylesheet" href="<?= CSS ?>info-postos.css">

<?php

use App\controller\PostosController as postos;

$id_posto = null;
if (isset($_GET['id-posto'])) {
    $id_posto = filter_input(INPUT_GET, 'id-posto');
}

$postos = postos::mostrarDadosPostoPorId($id_posto);

use App\controller\utentesController as utentes;
// chama a class de auth
require_once './Auth/checkSessionUtente.php';
// executa o método #1 de autorização
$idUtente = $auth->checkSEssion();
if ($idUtente) :
    // Grava dos dados do Utente num vetor de dados
    $dadosUtente = utentes::mostraDadosUtente($idUtente);
endif
?>
<nav class="navbar fixed-top f-primario">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="#!" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <span class="titulo"><?= $postos[0]->postoDesignacao ?></span>
    </div>
</nav>
<div class="cover-photo">
    <img src="<?= IMAGENS ?>hero/1.png" alt="Foto de Capa">

</div>

<section class="servicos bg-white">
    <div class="container">
        <div class="card border-0 shadow-none">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="bi bi-gear-fill me-3"></i>
                    <b>Serviços disponíveis</b>
                </h5>
            </div>
        </div>
    </div>
</section>

<div class="mt-3">
    <div class="container">
        <div class="card-group">
            <div class="row">
                <!-- Listagem dos documentos ou servços de um posto -->
                <?php
                foreach ($postos as $posto) { ?>
                    <div class="col-12">
                        <div class="card rounded-3 docs" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                            <div class="card-body">
                                <div class="float-end">
                                    <a href="#" class="btn-danger text-danger h5 mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="enviaDocumetoParaModal(<?= $posto->iddocumento ?>, '<?= $posto->documentoDesignacao ?>')">
                                        <i class="bi bi-plus-circle-fill"></i>
                                    </a>
                                </div>
                                <h5 class="card-title">
                                    <i class="bi bi-book-fill me-2 text-danger"></i>
                                    <?= $posto->documentoDesignacao ?>
                                </h5>
                                <span class="card-text d-none" $posto->documentoTempoDuracao ?></span>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="accordion" id="accordionFlushExample">
                                    <div class="accordion-item border-0">
                                        <a href="#!" class="border-0 text-decoration-none nav-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-<?= $posto->iddocumento ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <i class="bi bi-info-circle-fill me-2 text-danger"></i> ver catalogo
                                        </a>
                                        <div id="flush-<?= $posto->iddocumento ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="acordos">
                                                    <span class="text-muted">Preço: <b class="float-end"><?= $posto->documentoPreco ?> Kz</b></span>
                                                    <span class="text-muted">Duração: <b class="float-end"><?= $posto->documentoTempoDuracao ?> Kz</b></span>
                                                    <span class="text-muted">Validade: <b class="float-end"><?= $posto->documentoDataValidade ?> Kz</b></span>
                                                </div>
                                                <h5 class="text-center">Requisitos Necessários</h5>
                                                <div class="alert alert-warning rounded-0">
                                                    <small><?= $posto->documentoRequisitos ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Fimda listagem -->
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header f-primario text-warning">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Solicitação de Reserva</h5>
                <button type="button" class="btn-close border-0 text-warning" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="card-text">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close border-0" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="mt-2">
                            <h6>Aviso Importante</h6>
                            <hr>
                            <small>
                                Nesta secção, todos dados da reserva são preenchidos automaticamente.
                                <b>Nota:</b> O sistema fará uma marcação automática da sua reversa,
                                então, deverás anotar num papel a data que será gerada pelo sistema
                                assim que clicares no botão da reserva
                            </small>
                        </div>
                    </div>
                </div>
                <form action="#">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="utente" value="<?= $dadosUtente->idutente ?>">
                        <input type="text" value="<?= $dadosUtente->utenteNome ?>" class="form-control form-control-lg" id="floatingInput" disabled readonly>
                        <label for="floatingInput">O(A) solicitante</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-lg" id="floatingPassword" value="<?= $postos[0]->postoDesignacao ?>" disabled readonly>
                        <label for="floatingPassword">Posto</label>
                        <input type="hidden" name="posto" value="<?= $posto->idposto ?>">
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-lg" id="floatingLocal" value="<?= $postos[0]->postoMunicipio ?>" disabled readonly>
                        <label for="floatingLocal">Posto Municipal de</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-lg nome-documento" id="floatingSe" value="" readonly disabled>
                        <label for="floatingSe">Serviço solicitado</label>
                        <input type="hidden" id="idDocumento" value="" name="documento">
                    </div>
            </div>
            <!-- <div class="form-floating">
                            <select name="servico" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected>Escolha um serviço</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <label for="floatingSelect">Serviços disponíveis</label>
                        </div> -->
            <div class="modal-footer">
                <div class="text-center">

                    <button type="button" class="btn w-100 btn-warning mb-2 btn-lg">Enviar a Solicitação</button>
                    <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">Descartar o Envio</button>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>

<style>
    footer,
    .navegacao {
        display: none !important;
    }

    /* Info postos */
    .acordos span {
        font-size: 12px !important;
        display: block !important;
        margin-bottom: 6px;
        border-bottom: dotted 1px #444 !important;

    }

    input,
    select,
    button {
        font-size: 14px !important;
        font-family: 'nunito' !important;
        border: 1px solid #444 !important;
        ;
    }
</style>

<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     var modal = new bootstrap.Modal(document.getElementById("exampleModal"));
    //     modal.show();
    // });

    // enviar o serviço e o id para a modal
    function enviaDocumetoParaModal(id_documento, documento) {
        let input_nome_documento = document.querySelector('.nome-documento')
        let input_id_documento = document.querySelector('#idDocumento')
        input_nome_documento.value = documento
        input_id_documento.value = id_documento

    }
</script>