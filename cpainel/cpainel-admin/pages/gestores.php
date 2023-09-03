    <!-- TABLE gestorS -->
    <div class="container">
        <section class="table-gestor mt-2" id="gestores">
            <div class="carta-1 card rounded-0 mb-3" data-aos="fade-up" data-aos-transition="1000" data-aos-duration="500">
                <div class="card-body">
                    <div class="float-end">
                        <a href="#" class="grid bi bi-grid-3x3-gap btn btn-sm btn-dark rounded-3" title="Ver em grade"></a>
                        <a href="#" class="tab bi bi-table btn btn-sm btn-primary rounded-3" title="Ver em tabela"></a>
                    </div>
                    <h5 class="card-title titulo-page">Gerenciar gestores</h5>
                </div>
            </div>

            <div class="card vista-tabela" data-aos="fade-up" data-aos-transition="1000" data-aos-duration="500">
                <div class="card-body">
                    <table class="datatable table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Nº.Passe</th>
                                <th scope="col">Status</th>
                                <th scope="col">Criado aos</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            use App\controller\GestoresController;

                            foreach ($dadosGestor as $gestor) :

                                $estado = "<span class='badge badge-center bg-success badge-fill'>Ativado</span>";
                                $btnStatusAcao = '<a href="#" class="bi bi-x text-danger" title="Desativar a conta" onclick="alteraEstadoConta(1, ' . $gestor->idgestor . ')"></a>';
                                if ($gestor->idEstadoConta <= 1) {
                                    $estado = "<span class='badge badge-center f-primario badge-fill'>Desativado</span>";
                                    $btnStatusAcao = '<a href="#" class="bi bi-check text-success" title="Ativar a conta" onclick="alteraEstadoConta(2, ' . $gestor->idgestor . ')"></a>';
                                }
                            ?>
                                <tr>
                                    <td><?= $gestor->idgestor ?></td>
                                    <td><?= $gestor->gestorNome ?></td>
                                    <td><?= $gestor->gestorEmail ?></td>
                                    <td><?= $gestor->gestorTelefone ?></td>
                                    <td><?= $gestor->gestorDocs ?></td>
                                    <td><?= $estado ?></td>
                                    <td><?= $gestor->gestorDataRegistro ?></td>

                                    <td>
                                        <div class="text-center bg-light">
                                            <?php
                                            if ($dadosAdm->idNivelAcesso <= 1) : ?>
                                                <?= $btnStatusAcao ?>
                                                <a href="#" class="bi bi-trash text-danger" data-bs-toggle="modal" data-bs-target="#modalResponse" onclick="eliminaGestor(<?= $gestor->idgestor ?>)"></a>
                                            <?php else : ?>
                                                <?= $btnStatusAcao ?>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer f-primario">
                    <div class="text-end">
                        <span class="text-warning text-lowercase">Tabela de exibição dos gestors</span>
                    </div>
                </div>
            </div>
        </section><!-- Fim table gestors -->
    </div>

    <div class="vista-grelha d-none">
        <div class="row">
            <?php
            foreach ($dadosGestor as $gestor) :

                $foto = GestoresController::verFoto($gestor->idgestor);
                $estado = "<span class='badge badge-center bg-success badge-fill'>Ativada</span>";
                $btnStatusAcao = '<a href="#" class="bi bi-x text-danger text-decoration-none" title="Desativar a conta" onclick="alteraEstadoConta(1, ' . $gestor->idgestor . ')">
                <span class="ms-2">Desativar</span>
                </a>';
                if ($gestor->idEstadoConta <= 1) {
                    $estado = "<span class='badge badge-center f-primario badge-fill'>Desativada</span>";
                    $btnStatusAcao = '<a href="#" class="bi bi-check text-success text-decoration-none" title="Ativar a conta" onclick="alteraEstadoConta(2, ' . $gestor->idgestor . ')">
                    <span class="ms-2">Ativar</span>
                    </a>';
                }
            ?>
                <div class="col-3">
                    <div class="card-group" data-aos="fade-up" data-aos-durantion="1000" data-aos-transition="500">
                        <div class="card">
                            <div class="card-image p-3 mt-2 d-flex justify-content-center">
                                <img src="<?= $foto ?>" class="card-img-top img-fluid img-thumbnail-shadow rounded-circle shadow-sm" style="max-width: 100%; height:150px; width:150px; object-fit:cover; object-position:center top;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    <b><?= $gestor->gestorNome ?></b>
                                    <br>
                                    <small class="card-sutitle text-center cor-primario">
                                        <b>PASSE: <?= $gestor->gestorDocs ?></b>
                                    </small>
                                </h5>
                                <p class="card-text text-center">
                                    <span class="bi bi-envelope me-2"></span>
                                    <?= $gestor->gestorEmail ?>
                                    <br>
                                    <span class="bi bi-telephone me-2"></span>
                                    <?= $gestor->gestorTelefone ?>
                                </p>
                            </div>
                            <div class="mt-1 text-center mb-2">
                                <span>Conta <?= $estado ?></span>
                            </div>
                            <div class="card-footer">
                                <div class="text-center bg-light">
                                    <?php
                                    if ($dadosAdm->idNivelAcesso <= 1) : ?>
                                        <?= $btnStatusAcao ?> |
                                        <a href="#" class="bi bi-trash text-danger text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalResponse" onclick="eliminaGestor(<?= $gestor->idgestor ?>)">
                                            <span class="ms-2">Eliminar</span>
                                        </a>
                                    <?php else : ?>
                                        <?= $btnStatusAcao ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalErro" data-bs-keyboard="false" tabindex="1" aria-labelledby="modalErroLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 rounded-0">

                <div class="modal-body respos">

                </div>
            </div>
        </div>
    </div>

    <script>
        // altera estados gestor
        function alteraEstadoConta(estado, gestor) {
            let resposta = document.querySelector('.respos')
            const datas = new FormData()
            datas.append('acao', 'muda-estado-gestor')
            datas.append('id-estado', estado)
            datas.append('gestor', gestor)
            fetch('<?= ROUTE ?>Requests/requestAjax.php', {
                    method: 'POST',
                    body: datas
                })
                .then(res => res.json())
                .then(result => {
                    if (result == 2) {
                        resposta.innerHTML = `<div class="alert alert-success text-center">${result.msg}</div>`
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    } else {
                        resposta.innerHTML = `<div class="alert alert-danger">${result.msg}</div>`

                    }

                    var modal = new bootstrap.Modal(document.getElementById("modalErro"));
                    modal.show();
                    setTimeout(() => {
                        location.reload()
                    }, 1000);

                })
        }

        // elimina posto 
        function eliminaGestor(idgestor) {

            let id = document.querySelector('#confirm')
            id.value = idgestor

        }

        function confirmaEliminacao() {
            let id = document.querySelector('#confirm')
            let resposta = document.querySelector('.tt');

            const datas = new FormData()
            datas.append('acao', 'elimina-gestor')
            datas.append('gestor', id.value)
            fetch('<?= ROUTE ?>Requests/requestAjax.php', {
                    method: 'POST',
                    body: datas
                })
                .then(res => res.json())
                .then(result => {
                    if (result == 200) {
                        resposta.innerHTML = `<div class="tex-white text-center">${result.msg}</div>`
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    } else {
                        resposta.innerHTML = `<div class="text-white">${result.msg}</div>`

                    }

                    var modal = new bootstrap.Modal(document.getElementById("modalErro"));
                    modal.show();

                    setTimeout(() => {
                        location.reload()
                    }, 1000);

                })

        }

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