<?php

use App\controller\PostosController as postos;

$postos = postos::index();

?>
<nav class="navbar fixed-top f-primario p-3">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="#!" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <h5 class="titulo ml-1">Postos</h5>
    </div>
</nav>
<main class="mt-5">
    <div class="submeno">
        <div class="">
            <div class="mb-2 col">
                <div class="form-group">
                    <input type="text" class="rounded-5 form-pesquisa form-control form-control-lg bg-transparent shadow-sm" placeholder="Pesquise por postos">
                </div>
            </div>
            <div class="float-start">
                <a href="#viva" class="nav-item">Tudo</a>
                <a href="#" class="nav-item">Cons.</a>
                <a href="#" class="nav-item">Not</a>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <section class="container-fluid posto">
        <div class="row mt-5">
            <?php
            // percorre as lista de todos os postos
            foreach ($postos as $posto) : ?>
                <div class="col-12 mb-2" data-aos="fade-up" data-aos-duration="1500">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <span class="post-nome"><?= $posto->postoDesignacao ?></span>
                                    <span class="post-tipo"><?= $posto->categoriaPostoDesignacao ?> | <b>Luanda</b></span>
                                    <div class="mt-2">
                                        <a href="<?= ROUTE ?>?page=informacoes-postos&id-posto=<?= $posto->idposto ?>" class="link">
                                            <i class="bi bi-plus-circle-fill me-1"></i>
                                            ver mais
                                        </a>
                                        <?php
                                        // verifica se o login existe.
                                        if ($idUtente) :  // se existir, o btn reserve funciona normalmente
                                        ?>
                                            <a href="#" class="link-2">
                                                <i class="bi bi-person-plus-fill ms-1"></i>
                                                reservar
                                            </a>
                                        <?php else : // senão, o btn redireciona para login 
                                        ?>
                                            <a href="<?= ROUTE ?>?page=login" class="link-2">
                                                <i class="bi bi-person-plus-fill ms-1"></i>
                                                reservar
                                            </a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <!-- fim do percurso -->
        </div>
    </section>
</main>

<style>
    footer,
    .navegacao {
        display: none !important;
    }
</style>