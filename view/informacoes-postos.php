<link rel="stylesheet" href="<?= CSS ?>info-postos.css">
<nav class="navbar fixed-top f-primario">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="#!" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <span class="titulo">Nome posto</span>
        <?php
        // verifica se o login existe.
        if ($idUtente) :  // se existir, o botçao de reserva é exibibo
        ?>
            <button class="pulse-button">
                <span class="plus-symbol">+</span>
            </button>
        <?php endif ?>
    </div>
</nav>
<div class="cover-photo">
    <img src="<?= IMAGENS ?>hero/1.png" alt="Foto de Capa">
    <!--  <div class="text-end c">
        <button class="pulse-button tbtn">
            <span class="plus-symbol">+</span>
        </button>
    </div> -->
    <div class="username">
        Nome de Usuário
    </div>
</div>

<section class="info bg-white p-2 mt-0">
    <div class="contaifner">
        <div class="row">
            <div class="col">
                <div class="info-card">
                    <span class="info-card-icon"></span>
                    <h5 class="info-card-title">Servicos</h5>
                    <span class="info-card-text"></span>
                </div>
            </div>
            <div class="col">
                <div class="info-card">
                    <span class="info-card-icon"></span>
                    <h5 class="info-card-title">Detalhes</h5>
                    <span class="info-card-text"></span>
                </div>
            </div>
            <div class="col">
                <div class="info-card">
                    <span class="info-card-icon"></span>
                    <h5 class="info-card-title">Calendário</h5>
                    <span class="info-card-text"></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="servicos bg-white">
    <div class="container">
        <div class="card border-0 shadow-none">
            <div class="card-body">
                <h5 class="card-title"><b>Serviços</b></h5>
            </div>
        </div>
    </div>
</section>

<div class="mt-3">
    <div class="container">
        <div class="card-group">
            <div class="row">
                <div class="col-12">
                    <div class="card rounded-3 docs" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                        <div class="card-body">
                            <div class="float-end">
                                <a href="#" class="btn-danger text-danger h5 mt-5"><i class="bi bi-plus-circle-fill"></i></a>
                            </div>
                            <h5 class="card-title">Nome Documento</h5>
                            <span class="card-text">Duração: 5 dias</span>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">ver catalógo</small>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-3 docs" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                        <div class="card-body">
                            <div class="float-end">
                                <a href="#" class="btn-danger text-danger h5 mt-5"><i class="bi bi-plus-circle-fill"></i></a>
                            </div>
                            <h5 class="card-title">Nome Documento</h5>
                            <span class="card-text">Duração: 5 dias</span>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">ver catalógo</small>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-3 docs" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                        <div class="card-body">
                            <div class="float-end">
                                <a href="#" class="btn-danger text-danger h5 mt-5"><i class="bi bi-plus-circle-fill"></i></a>
                            </div>
                            <h5 class="card-title">Nome Documento</h5>
                            <span class="card-text">Duração: 5 dias</span>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">ver catalógo</small>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-3 docs" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                        <div class="card-body">
                            <div class="float-end">
                                <a href="#" class="btn-danger text-danger h5 mt-5"><i class="bi bi-plus-circle-fill"></i></a>
                            </div>
                            <h5 class="card-title">Nome Documento</h5>
                            <span class="card-text">Duração: 5 dias</span>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">ver catalógo</small>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-3 docs" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                        <div class="card-body">
                            <div class="float-end">
                                <a href="#" class="btn-danger text-danger h5 mt-5"><i class="bi bi-plus-circle-fill"></i></a>
                            </div>
                            <h5 class="card-title">Nome Documento</h5>
                            <span class="card-text">Duração: 5 dias</span>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">ver catalógo</small>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-3 docs" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                        <div class="card-body">
                            <div class="float-end">
                                <a href="#" class="btn-danger text-danger h5 mt-5"><i class="bi bi-plus-circle-fill"></i></a>
                            </div>
                            <h5 class="card-title">Nome Documento</h5>
                            <span class="card-text">Duração: 5 dias</span>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">ver catalógo</small>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-3 docs" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                        <div class="card-body">
                            <div class="float-end">
                                <a href="#" class="btn-danger text-danger h5 mt-5"><i class="bi bi-plus-circle-fill"></i></a>
                            </div>
                            <h5 class="card-title">Nome Documento</h5>
                            <span class="card-text">Duração: 5 dias</span>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">ver catalógo</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<style>
    footer,
    .navegacao {
        display: none !important;
    }
</style>