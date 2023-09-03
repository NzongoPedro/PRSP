<?php
if (isset($_SESSION['token-posto']) && isset($_SESSION['id-posto'])) : ?>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="demo-inline-spacing float-end">
                <button type="button" class="btn rounded-pill btn-icon bg-primary text-white" data-bs-toggle="modal" data-bs-target="#modalServico" id="btnModal">
                    <span class="tf-icons bx bx-plus"></span>
                </button>

            </div>
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Serviços</h4>

            <div class="row mb-5"">
                <div class=" col-md-12 col-lg-5 col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <?php

                        if (isset($_GET['servico-id'])) :
                            $id_servico = $_GET['servico-id'];
                            $servico_por_id = new  App\controller\ServicosController;
                            $documento =  $servico_por_id::verServicosPorId($id_servico)[0];

                        ?>
                            <div class="col vista">
                                <div class="card-body">

                                    <h5 class="card-title text-muted">

                                        <a href="#" class="cor-primario float-end link nav-link text-decoration-none">X</a>
                                        Detalhes do Documento
                                    </h5>
                                    <br>
                                    <div class="row mt-1">
                                        <div class="col">
                                            <div class="alert alert-light shadow-sm cursor-pointer border-danger border-1">
                                                <div class="text-start">
                                                    <i class="bx bx-book bx-sm bx-border-circle me-2 cor-primario border-danger border-1"></i>
                                                    <span class="cor-primario text-truncate d-inline">
                                                        <a class="btn btn-danger text-white btn-sm rounded-4 float-end"> <?= number_format($documento->documentoPreco, 2, ',', '.') ?> kz</a>
                                                        <?= $documento->documentoDesignacao ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="alert alert-light shadow-sm cursor-pointer border-danger border-1">
                                                <div class="text-start">
                                                    <i class="bx bx-calendar bx-sm bx-border-circle me-2 cor-primario border-danger border-1"></i>
                                                    <span class="text-truncate d-inline">
                                                        Duração: <a class="btn btn-danger text-white btn-sm rounded-4 ms-2"><?= $documento->documentoTempoDuracao ?></a>
                                                        | Validade: <a class="btn btn-danger text-white btn-sm rounded-4 me-2"> <?= $documento->documentoDataValidade ?></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion-item">
                                                    <div class="accordion-header text-center">
                                                        <button class="text-white border-0 bg-transparent collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                            ver mais
                                                        </button>
                                                    </div>
                                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            <b class="text-center">Requisitos</b>
                                                            <hr>
                                                            </p>
                                                            <?= html_entity_decode($documento->documentoRequisitos) ?>
                                                            <p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row" style="overflow: auto; height:50vh;">
                    <?php
                    foreach ($servicos as $servico) : ?>

                        <div class=" col-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx bx-list-ul bx-border-circle bx-sm"></i>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1"><?= $servico->documentoDesignacao ?></span>
                                    <p class="card-title text-nowrap mb-2">Kz <?= number_format($servico->documentoPreco, 2, ',', '.') ?></p>
                                    <small class="cor-primario fw-semibold"> <a href="./?gestorPage=servicos&servico-id=<?= $servico->iddocumento ?>" class="cor-primario">mais detalhes</a></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

        </div>
        <!--/ Content types -->


    </div>
    <!-- / Content -->

    <!-- Footer -->
    <?php require '../pages/footer.php'; ?>
    <!-- / Footer -->
    <?php require_once '../components/ModalNovoServico.php'; ?>
    <div class="content-backdrop fade"></div>
    </div>
<?php else : ?>
    <script>
        document.querySelector('title').innerHTML = "Serviços | PRSP"
    </script>
<?php endif ?>

<script>
    /* INSTRUÇÃO PARA REGISTRAR Posto */

    const divRespostaServico = document.querySelector('.respostaServico')

    const formularioServico = document.querySelector('#formServico')

    formularioServico.addEventListener('submit', (e, dados) => { // ao submeter o formulário

        e.preventDefault() // remove a ação do formulário

        dados = new FormData(formularioServico) // capta os dados do formulário
        dados.append('acao', 'registrar-servico-posto')
        dados.append('estado', <?= $posto->idEstadoPosto ?>)
        fetch('../../../Requests/requestAjax.php', { // envia os dados para uma página php
                body: dados, // Dados a serem enviados
                method: 'POST' // verbo ou metodo HTTP da requisição
            })
            .then(res => res.json()) // envia e espera uma resposta no formato json de dados
            .then(resposta => { // armazena os dados da resposta no objeto resposta
                if (resposta.status == 200) {
                    divRespostaServico.innerHTML = `<div class="alert alert-success text-center">${resposta.msg}</div>`
                    setTimeout(() => {
                        formularioServico.reset()
                        divRespostaServico.innerHTML = ""
                        location.reload()
                    }, 5000);
                } else {
                    divRespostaServico.innerHTML = `<div class="alert alert-danger">${resposta.msg}</div>`
                    setTimeout(() => {
                        divRespostaServico.innerHTML = ""
                    }, 3000);
                }
            })
            .catch(err => { // caso houver um erro
                divRespostaServico.innerHTML = `<div class="alert alert-danger">${err}</div>`
            })

    })

    let vista = document.querySelector(".vista")
    let link = document.querySelector(".link")

    link.addEventListener('click', () => {
        vista.classList.add('d-none')
    })
</script>