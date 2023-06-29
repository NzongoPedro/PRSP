<link rel="stylesheet" href="<?= CSS ?>perfil.css">

<?php

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
<nav class="navbar fixed-top p-2 bg-dark">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="#!" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <span class="titulo">Isidora Mendes</span>
    </div>
</nav>
<!-- Section Cover (Capa) -->
<section>
    <div class="perfil-capa shadow-sm"></div>
    <div class="perfil-foto-utente" data-aos="fade-up" data-aos-transition="500" data-aos-duration="1000">
        <img src=" <?= IMAGENS ?>utentes/Boom.jfif" class="foto shadow-sm img-fluid" lazy>
    </div>
    <div class="menu-nav container">
        <a href="#">
            <i class="bi bi-file-text-fill"></i>
            reservas
        </a>
        <a href="#">
            <i class="bi bi-file-person-fill"></i>
            Dados
        </a>
        <a href="#">
            <i class="bi bi-file-pdf-fill"></i>
            Comprovativo
        </a>
        <a href="#">
            <i class="bi bi-door-open-fill"></i>
            Sair
        </a>
    </div>
    <hr>

</section>

<?php
// alternando a vista de conteúdo de usuários
if (isset($_GET['view'])) {
    $page = filter_input(INPUT_GET, 'view');
    switch ($page) {
        case 'reservas': ?>
<!-- Redervas -->
<section class="reservas container d-none">
    <h5 class="titulos">Minhas reservas</h5>
    <div class="mt-3 mb-3"></div>
    <div class="card-group">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-duration="1000" data-aos-transition="500">
                    <div class="card-body">
                        <h5 class="nome-doc">Nome Documento</h5>
                        <p class="card-text">
                            <b>Estado:</b> Proccess
                            <br>6
                            <b>Local:</b> Nome Posto
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <i class="bi bi-calendar me-2"></i>
                            00/00/000 - 00:00
                        </small>
                        <div class="icon-acao">
                            <a href="#" class="bi bi-trash"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-duration="1000" data-aos-transition="500">
                    <div class="card-body">
                        <h5 class="nome-doc">Nome Documento</h5>
                        <p class="card-text">
                            <b>Estado:</b> Proccess
                            <br>6
                            <b>Local:</b> Nome Posto
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <i class="bi bi-calendar me-2"></i>
                            00/00/000 - 00:00
                        </small>
                        <div class="icon-acao">
                            <a href="#" class="bi bi-trash"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-duration="1000" data-aos-transition="500">
                    <div class="card-body">
                        <h5 class="nome-doc">Nome Documento</h5>
                        <p class="card-text">
                            <b>Estado:</b> Proccess
                            <br>6
                            <b>Local:</b> Nome Posto
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <i class="bi bi-calendar me-2"></i>
                            00/00/000 - 00:00
                        </small>
                        <div class="icon-acao">
                            <a href="#" class="bi bi-trash"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-duration="1000" data-aos-transition="500">
                    <div class="card-body">
                        <h5 class="nome-doc">Nome Documento</h5>
                        <p class="card-text">
                            <b>Estado:</b> Proccess
                            <br>6
                            <b>Local:</b> Nome Posto
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <i class="bi bi-calendar me-2"></i>
                            00/00/000 - 00:00
                        </small>
                        <div class="icon-acao">
                            <a href="#" class="bi bi-trash"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-duration="1000" data-aos-transition="500">
                    <div class="card-body">
                        <h5 class="nome-doc">Nome Documento</h5>
                        <p class="card-text">
                            <b>Estado:</b> Proccess
                            <br>6
                            <b>Local:</b> Nome Posto
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <i class="bi bi-calendar me-2"></i>
                            00/00/000 - 00:00
                        </small>
                        <div class="icon-acao">
                            <a href="#" class="bi bi-trash"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-duration="1000" data-aos-transition="500">
                    <div class="card-body">
                        <h5 class="nome-doc">Nome Documento</h5>
                        <p class="card-text">
                            <b>Estado:</b> Proccess
                            <br>6
                            <b>Local:</b> Nome Posto
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <i class="bi bi-calendar me-2"></i>
                            00/00/000 - 00:00
                        </small>
                        <div class="icon-acao">
                            <a href="#" class="bi bi-trash"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-duration="1000" data-aos-transition="500">
                    <div class="card-body">
                        <h5 class="nome-doc">Nome Documento</h5>
                        <p class="card-text">
                            <b>Estado:</b> Proccess
                            <br>6
                            <b>Local:</b> Nome Posto
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <i class="bi bi-calendar me-2"></i>
                            00/00/000 - 00:00
                        </small>
                        <div class="icon-acao">
                            <a href="#" class="bi bi-trash"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Fim section reseevas -->

<!-- dados pessoas -->
<section class="dados-utente container">
    <h5 class="titulos">Meus Dados</h5>
    <div class="row">
        <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-transition="500">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Dados pessoais</h5>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="form-group mb-2">
                            <input type="text" name="utenteNome" class="form-control rounded-0" value="Isidora dos Santos">
                        </div>
                        <div class="form-group mb-2">
                            <input type="tel" name="utenteTelefone" class="form-control rounded-0" value="947712834">
                        </div>
                        <div class="form-group mb-2">
                            <input type="mail" name="utenteEmail" class="form-control rounded-0" value="email@gmail.com">
                        </div>
                        <div class="mt-2 text-end">
                            <input type="button" class="btn btn-sm rounded-0 btn-primario" value="EDITAR">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-transition="500">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Alterar senha</h5>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="form-group mb-2">
                            <input type="text" name="utenteSenhaAtual" class="form-control rounded-0" placeholder="Insira a senha atual">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="utenteSenhaNova" class="form-control rounded-0" placeholder="Insira uma senha nova">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="utenteSenhaNovaRepetida" class="form-control rounded-0" placeholder="Repita a senha nova">
                        </div>

                        <div class="mt-2 text-end">
                            <input type="button" class="btn btn-sm rounded-0 btn-primario" value="Alterar Senha">
                        </div>
                    </form>
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

<script src="<?= JS ?>login.js"></script>