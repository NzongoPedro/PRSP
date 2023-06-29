<nav class="navbar fixed-top f-primario p-3">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="#!" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <span class="titulo">Nome Do Posto</span>
    </div>
</nav>
<main class="mt-2">
    <div class="submeno">
        <div class="">
            <div class="mb-2 col">
                <div class="form-group">
                    <input type="text" class="rounded-0 form-pesquisa form-control bg-transparent shadow-sm" placeholder="Busque por [Notório e Conservatórias]">
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
    <section class="container posto">
        <div class="row mt-5">
            <div class="col-12 mb-2" data-aos="fade-up" data-aos-duration="1500">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <span class="post-nome">Nome Poste</span>
                                <span class="post-tipo">Tipo posto | <b>Luanda</b></span>
                                <div class="mt-2">
                                    <a href="<?= ROUTE ?>?page=informacoes-postos" class="link">
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
                                        ?>
                                    <?php endif ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2" data-aos="fade-up" data-aos-duration="1500">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <span class="post-nome">Nome Poste</span>
                                <span class="post-tipo">Tipo posto | <b>Luanda</b></span>
                                <div class="mt-2">
                                    <a href="<?= ROUTE ?>?page=informacoes-postos" class="link">
                                        <i class="bi bi-plus-circle-fill me-1"></i>
                                        ver mais
                                    </a>
                                    <a href="#" class="link-2">
                                        <i class="bi bi-person-plus-fill ms-1"></i>
                                        reservar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2" data-aos="fade-up" data-aos-duration="1500">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <span class="post-nome">Nome Poste</span>
                                <span class="post-tipo">Tipo posto | <b>Luanda</b></span>
                                <div class="mt-2">
                                    <a href="<?= ROUTE ?>?page=informacoes-postos" class="link">
                                        <i class="bi bi-plus-circle-fill me-1"></i>
                                        ver mais
                                    </a>
                                    <a href="#" class="link-2">
                                        <i class="bi bi-person-plus-fill ms-1"></i>
                                        reservar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2" data-aos="fade-up" data-aos-duration="1500">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <span class="post-nome">Nome Poste</span>
                                <span class="post-tipo">Tipo posto | <b>Luanda</b></span>
                                <div class="mt-2">
                                    <a href="<?= ROUTE ?>?page=informacoes-postos" class="link">
                                        <i class="bi bi-plus-circle-fill me-1"></i>
                                        ver mais
                                    </a>
                                    <a href="#" class="link-2">
                                        <i class="bi bi-person-plus-fill ms-1"></i>
                                        reservar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2" data-aos="fade-up" data-aos-duration="1500">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <span class="post-nome">Nome Poste</span>
                                <span class="post-tipo">Tipo posto | <b>Luanda</b></span>
                                <div class="mt-2">
                                    <a href="<?= ROUTE ?>?page=informacoes-postos" class="link">
                                        <i class="bi bi-plus-circle-fill me-1"></i>
                                        ver mais
                                    </a>
                                    <a href="#" class="link-2">
                                        <i class="bi bi-person-plus-fill ms-1"></i>
                                        reservar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2" data-aos="fade-up" data-aos-duration="1500">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <span class="post-nome">Nome Poste</span>
                                <span class="post-tipo">Tipo posto | <b>Luanda</b></span>
                                <div class="mt-2">
                                    <a href="<?= ROUTE ?>?page=informacoes-postos" class="link">
                                        <i class="bi bi-plus-circle-fill me-1"></i>
                                        ver mais
                                    </a>
                                    <a href="#" class="link-2">
                                        <i class="bi bi-person-plus-fill ms-1"></i>
                                        reservar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2" data-aos="fade-up" data-aos-duration="1500">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <span class="post-nome">Nome Poste</span>
                                <span class="post-tipo">Tipo posto | <b>Luanda</b></span>
                                <div class="mt-2">
                                    <a href="<?= ROUTE ?>?page=informacoes-postos" class="link">
                                        <i class="bi bi-plus-circle-fill me-1"></i>
                                        ver mais
                                    </a>
                                    <a href="#" class="link-2">
                                        <i class="bi bi-person-plus-fill ms-1"></i>
                                        reservar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2" data-aos="fade-up" data-aos-duration="1500">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <span class="post-nome">Nome Poste</span>
                                <span class="post-tipo">Tipo posto | <b>Luanda</b></span>
                                <div class="mt-2">
                                    <a href="<?= ROUTE ?>?page=informacoes-postos" class="link">
                                        <i class="bi bi-plus-circle-fill me-1"></i>
                                        ver mais
                                    </a>
                                    <a href="#" class="link-2">
                                        <i class="bi bi-person-plus-fill ms-1"></i>
                                        reservar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    footer,
    .navegacao {
        display: none !important;
    }
</style>