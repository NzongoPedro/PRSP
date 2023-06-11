<nav class="navbar fixed-top navegacao">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="#!" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <span class="titulo">Notórios e Conservatórias</span>

        <button class="navbar-toggler icon-btn rounded-0 border-0 rounded-circle shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="bi bi-list"></span>
        </button>
        <div class="offcanvas menu custom-effect " data-bs-backdrop="static" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header f-primario">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                    <i class="bi bi-person-fill me-4"></i>
                    Nome Utente
                </h5>
                <a href="#" class="btn-close text-light" data-bs-dismiss="offcanvas" aria-label="Close"></a>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= ROUTE ?>home">
                            <i class="bi bi-house-fill me-4"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROUTE ?>postos">
                            <i class="bi bi-geo-fill me-4"></i>
                            Postos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-file-text-fill me-4"></i>
                            Catalógos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROUTE ?>login">
                            <i class="bi bi-lock-fill me-4"></i>
                            Login/Cadastro
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-question-circle-fill me-4"></i>
                            Ajuda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-power me-4"></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<main class="mt-5">
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
                                    <a href="#" class="link">
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
                                    <a href="#" class="link">
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
                                    <a href="#" class="link">
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
                                    <a href="#" class="link">
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
                                    <a href="#" class="link">
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
                                    <a href="#" class="link">
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
                                    <a href="#" class="link">
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
                                    <a href="#" class="link">
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
<br><br><br><br><br><br><br><br>