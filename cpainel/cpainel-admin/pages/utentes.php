    <?php

    use App\Model\Utentes as utentes;

    $utentes = utentes::index();

    ?>
    <!-- Gerenciando utentes -->
    <div class="container utente">
        <section class="mt-2 mb-3" id="utentes">
            <div class="carta-1 card rounded-0" data-aos="fade-in" data-aos-transition="1000" data-aos-duration="500">
                <div class="card-body">
                    <div class="float-end">
                        <a href="#" class="grid bi bi-grid-3x3-gap btn btn-sm btn-dark rounded-3" title="Ver em grade"></a>
                        <a href="#" class="tab bi bi-table btn btn-sm btn-primary rounded-3" title="Ver em tabela"></a>
                    </div>
                    <h5 class="card-title titulo-page">Gerenciar utentes</h5>
                </div>
            </div>
        </section><!-- Fim utentes -->

        <!-- Grelha de utentes -->
        <div class="row row-cols-1 row-cols-md-4 g-4 vista-tabela">
            <?php foreach ($utentes as $utente) : ?>
                <div class="col" data-aos="fade-up" data-aos-transition="1000" data-aos-duration="500">
                    <div class="utente-carta carta card h-100 carta-2">
                        <img src="<?= IMAGENS ?>admin/admin.png" alt="Foto de Perfil" class="shadow-sm profile-picture">
                        <div class="card-body content">
                            <h5 class="card-title utente-nome"><?= $utente->utenteNome ?></h5>
                            <div class="traco-2"></div>
                            <!-- <div class="mt-3 mb-3 text-center detalhe">
                                <a href="#" class="nav-link text-warning">ver mais detalhes</a>
                            </div> -->
                        </div>
                        <div class="shine"></div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <div class="table-responsive vista-grelha mt-5 d-none">
            <div class="card carta-1">
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($utentes as $utente) : ?>
                                <tr class="">
                                    <td scope="row"><?= $utente->idutente ?></td>
                                    <td scope="row"><?= $utente->utenteNome ?></td>
                                    <td><?= $utente->utenteTelefone ?></td>
                                    <td><?= $utente->utenteEmail ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        // alterna os estado do posto para grelha ou tabela

        const botao_grid = document.querySelector('.grid')
        const botao_tabela = document.querySelector('.tab')
        const div_grelha = document.querySelector('.vista-grelha')
        const div_tabela = document.querySelector('.vista-tabela')

        // alterapa de tabela para grelha
        botao_grid.addEventListener('click', () => {

            div_grelha.classList.remove('d-none')
            div_tabela.classList.add('d-none')
        })

        // alertanr de grelha para tabela 
        botao_tabela.addEventListener('click', () => {

            div_grelha.classList.add('d-none')
            div_tabela.classList.remove('d-none')
        })
    </script>