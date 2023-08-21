<link rel="stylesheet" href="<?= CSS ?>perfil.css">

<?php

use App\controller\utentesController as utentes;
use App\controller\ServicosController as servicos;
// chama a class de auth
require_once './Auth/checkSessionUtente.php';
// executa o método #1 de autorização
$idUtente = $auth->checkSEssion();
if ($idUtente) :

    // Grava dos dados do Utente num vetor de dados
    $dadosUtente = utentes::mostraDadosUtente($idUtente);

    //Grava os dados da reserva desse utente
    $reservas = servicos::show($idUtente);

endif
?>
<nav class="navbar fixed-top p-2 bg-dark">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="#!" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <span class="titulo"><?= $dadosUtente->utenteNome ?></span>
    </div>
</nav>
<!-- Section Cover (Capa) -->
<section>
    <div class="perfil-capa shadow-sm"></div>
    <div class="perfil-foto-utente" data-aos="fade-up" data-aos-transition="500" data-aos-duration="1000">
        <img src=" <?= IMAGENS ?>utentes/Boom.jfif" class="foto shadow-sm img-fluid" lazy>
    </div>
    <div class="menu-nav container">
        <a href="<?= ROUTE ?>?page=perfil-utente&view=reservas">
            <i class="bi bi-file-text-fill"></i>
            reservas
        </a>
        <a href="<?= ROUTE ?>?page=perfil-utente&view=dados">
            <i class="bi bi-file-person-fill"></i>
            Dados
        </a>
        <a href="#!">
            <i class="bi bi-file-pdf-fill"></i>
            Comprovativo
        </a>
        <a href="<?= ROUTE ?>?page=sair">
            <i class="bi bi-door-open-fill"></i>
            Sair
        </a>
    </div>
    <hr>

</section>
<!-- Fim seccção foto de capa -->

<?php
// alternando a vista de conteúdo de usuários
if (isset($_GET['view'])) {
    $page = filter_input(INPUT_GET, 'view');
    switch ($page) {
        case 'reservas': ?>
            <!-- Redervas -->
            <section class="reservas container">
                <h5 class="titulos">Minhas reservas</h5>
                <div class="mt-3 mb-3"></div>
                <div class="card-group">
                    <div class="row">~
                        <?php
                        foreach ($reservas as $reserva) { ?>
                            <div class="col-12 mb-3">
                                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-easing="ease" data-aos-duration="1000" data-aos-transition="500">
                                    <div class="card-body">
                                        <h5 class="nome-doc"><?= $reserva->documentoDesignacao ?></h5>
                                        <p class="card-text">
                                            <b>Estado:</b> <?= $reserva->estadoSolicitacao ?>
                                            <br>
                                            <b>Local:</b> <?= $reserva->postoDesignacao ?>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="cor-primaria text-dark">
                                            <i class="bi bi-calendar me-2"></i>
                                            <?= $reserva->solicitacaoReservaData ?> | <i class="bi bi-clock me-2"></i><?= $reserva->solicitacaoReservaHora ?>
                                        </small>
                                        <div class="icon-acao">
                                            <a href="#!" class="bi bi-trash" data-bs-toggle="modal" data-bs-target="#modalEliminar" onclick="confirmaEliminacaoReserva()"></a>
                                            <a href="#!" class="bi bi-file-pdf-fill"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <!-- Fim section reseevas -->
        <?php
            break;
        case 'dados': ?>
            <!-- dados pessoais -->
            <section class="dados-utente container">
                <h5 class="titulos">Meus Dados</h5>
                <div class="row">
                    <!-- Dados de identificação -->
                    <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-transition="500">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Dados pessoais</h5>
                            </div>
                            <div class="card-body">
                                <div class="resposta-edicao text-center">
                                </div>
                                <form action="#!" id="form-dado-pessoais">
                                    <div class="form-group mb-2">
                                        <input type="text" name="utenteNome" class="form-control rounded-0" value="<?= $dadosUtente->utenteNome ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="tel" name="utenteTelefone" class="form-control rounded-0" value="<?= $dadosUtente->utenteTelefone ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="mail" name="utenteEmail" class="form-control rounded-0" value="<?= $dadosUtente->utenteEmail ?>">
                                    </div>
                                    <input type="hidden" name="idUtente" value="<?= $idUtente ?>">
                                    <div class="mt-2 text-end">
                                        <input type="submit" class="btn btn-sm rounded-0 btn-primario" value="EDITAR">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- Fim dados identificação -->

                    <!-- Dados de segurança -->
                    <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-transition="500">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Alterar senha</h5>
                            </div>
                            <div class="card-body">
                                <div class="resposta-senha"></div>
                                <form action="#!" id="form-editar-senha">
                                    <div class="form-group mb-2">
                                        <input type="text" name="utenteSenhaAtual" class="form-control rounded-0" placeholder="Insira a senha atual">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="text" name="utenteSenhaNova" class="form-control rounded-0" placeholder="Insira uma senha nova">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="text" name="utenteSenhaNovaRepetida" class="form-control rounded-0" placeholder="Repita a senha nova">
                                    </div>
                                    <input type="hidden" name="senha" value="<?= $dadosUtente->utenteSenha ?>">
                                    <input type="hidden" name="idUtente" value="<?= $dadosUtente->idutente ?>">

                                    <div class="mt-2 text-end">
                                        <input type="submit" class="btn btn-sm rounded-0 btn-primario" value="Alterar Senha">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div><!-- Fim dados de segurança -->
                </div>
            </section>
            <!-- Fim seccção dados pessoais -->

<?php
            break;
        default:
            # code...
            break;
    }
}
?>




<!-- Modal Confirmação de eleinação de reservas-->
<div class="modal fade" id="modalEliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true" data-aos="zoom-in" data-aos-easing="ease" data-aos-duration="1500" data-aos-transition="500">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-eliminar-reserva border-0">
            <div class="modal-body">
                <div class="m-auto text-center">
                    <img src="<?= IMAGENS ?>icones/feito.png" class="img-fluid icon-img" alt="icon-aviso">
                </div>
                <div class="mt-2 texto-aviso">
                    prentende realmente cancelar está reserva?
                    está ação não poderá ser revertida.
                </div>
            </div>
            <div class="p-2 border-0 text-center">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">NÃO</button>
                <button type="button" class="btn btn-success btn-confirm">SIM</button>
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
<script>
    /* ========== ELIMINAR RESERVAS ============= */
    let corpo = document.querySelector('.modal-body')
    let botaoConfirmar = document.querySelector('.btn-confirm')

    const confirmaEliminacaoReserva = () => {
        alert(0)
    }
</script>
<script src="<?= JS ?>editarDados.js"></script>