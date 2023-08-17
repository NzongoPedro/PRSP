    <?php

    use App\Model\Utentes as utentes;

    $utentes = utentes::index();

    ?>
    <!-- Gerenciando utentes -->
    <div class="container utente">
        <section class="mt-2 mb-3" id="utentes">
            <div class="carta-1 card rounded-0" data-aos="fade-in" data-aos-transition="2000" data-aos-durantion="2500">
                <div class="card-body">
                    <div class="float-end">
                        <a href="#" class="bi bi-grid-3x3-gap btn btn-sm btn-dark rounded-3"></a>
                        <a href="#" class="bi bi-table btn btn-sm btn-primary rounded-3"></a>
                        <a href="#" class="bi bi-trash btn btn-sm btn-danger rounded rounded-3">
                        </a>
                    </div>
                    <h5 class="card-title titulo-page">Gerenciar utentes</h5>
                </div>
            </div>
        </section><!-- Fim utentes -->

        <!-- Grelha de utentes -->
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($utentes as $utente) : ?>
                <div class="col" data-aos="fade-up" data-aos-transition="2000" data-aos-durantion="2500">
                    <div class="utente-carta carta card h-100 carta-2">
                        <img src="<?= IMAGENS ?>admin/admin.png" alt="Foto de Perfil" class="shadow-sm profile-picture">
                        <div class="card-body content">
                            <h5 class="card-title utente-nome"><?= $utente->utenteNome ?></h5>
                            <div class="traco-2"></div>
                            <div class="mt-3 mb-3 text-center detalhe">
                                <a href="#" class="nav-link text-warning">ver mais detalhes</a>
                            </div>
                        </div>
                        <div class="shine"></div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>