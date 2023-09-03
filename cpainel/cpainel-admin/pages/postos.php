    <!-- TABLE POSTOS -->

    <div class="container">
        <section class="table-posto mt-2" id="postos">

            <div class="carta-1 card rounded-0 mb-3" data-aos="fade-up" data-aos-transition="1000" data-aos-duration="500">
                <div class="card-body">
                    <div class="float-end">
                        <a href="#" class="grid bi bi-grid-3x3-gap btn btn-sm btn-dark rounded-3" title="Ver em grade"></a>
                        <a href="#" class="tab bi bi-table btn btn-sm btn-primary rounded-3" title="Ver em tabela"></a>
                    </div>
                    <h5 class="card-title titulo-page">Gerenciar postos</h5>
                </div>
            </div>

            <!-- Vista tabelada -->
            <div class="card vista-tabela" data-aos="fade-up" data-aos-transition="1000" data-aos-duration="500">
                <div class="card-body">
                    <table class="datatable table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Gestor</th>
                                <th scope="col">Localização</th>
                                <th scope="col">Status</th>
                                <th scope="col">Criado aos</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dadosPosto as $posto) :

                                $estado = "<span class='badge badge-center bg-success badge-fill'>Ativado</span>";
                                $btnStatusAcao = '<a href="#" class="bi bi-x text-danger" title="Desativar a conta" onclick="alteraEstadoConta(1, ' . $posto->idposto . ')"></a>';
                                if ($posto->idEstadoPosto <= 1) {
                                    $estado = "<span class='badge badge-center f-primario badge-fill'>Desativado</span>";
                                    $btnStatusAcao = '<a href="#" class="bi bi-check text-success" title="Ativar a conta" onclick="alteraEstadoConta(2, ' . $posto->idposto . ')"></a>';
                                }
                            ?>
                                <tr>
                                    <td><?= $posto->idposto ?></td>
                                    <td><?= $posto->postoDesignacao ?></td>
                                    <td><?= $posto->categoriaPostoDesignacao ?></td>
                                    <td><?= $posto->gestorNome ?></td>
                                    <td>Luanda - <?= $posto->postoMunicipio ?></td>
                                    <td><?= $estado ?></td>
                                    <td><?= $posto->postoDataRegistro ?></td>
                                    <td>
                                        <?php
                                        if ($dadosAdm->idNivelAcesso <= 1) : ?>
                                            <div class="text-center bg-light">
                                                <?= $btnStatusAcao ?>
                                                <a href="#" class="bi bi-trash text-danger" data-bs-toggle="modal" data-bs-target="#modalResponse" onclick="eliminaPosto(<?= $posto->idposto ?>)"></a>
                                            </div>
                                        <?php else : ?>
                                            -------
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer f-primario">
                    <div class="text-end">
                        <span class="text-warning text-lowercase">Tabela de exibição dos postos</span>
                    </div>
                </div>



            </div>
            <!-- Fim vista tabelado -->

            <!-- Vista tgrela -->
            <div class="vista-grelha d-none">
                <div class=" row">
                    <?php
                    foreach ($dadosPosto as $posto) :
                        $estado = "<span class='badge badge-center bg-success badge-fill'>Ativado</span>";
                        $btnStatusAcao = '<a href="#" class="bi bi-x text-danger text-decoration-none" title="Desativar a conta" onclick="alteraEstadoConta(1, ' . $posto->idposto . ')">
                        <span class="ms-1">Desativar</span>
                        </a>';
                        if ($posto->idEstadoPosto <= 1) {
                            $estado = "<span class='badge badge-center f-primario badge-fill'>Desativado</span>";
                            $btnStatusAcao = '<a href="#" class="bi bi-check text-success text-decoration-none" title="Ativar a conta" onclick="alteraEstadoConta(2, ' . $posto->idposto . ')">
                            <span class="ms-1">Activar</span>
                            </a>';
                        }

                    ?>
                        <div class="col-3" data-aos="fade-up" data-aos-transition="1000" data-aos-duration="500">
                            <div class="card" data-aos="fade-up" data-aos-transition="1000" data-aos-duration="500">
                                <div class="card-header f-primario">
                                    <h5 class="card-title">
                                        <?= $posto->postoDesignacao ?>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="card-text">
                                        <small class="text-muted">Gerido por: <?= $posto->gestorNome ?></small>
                                        <br>
                                        <small>localização: <?= $posto->postoMunicipio ?> </small>
                                        <br>
                                        <small>Estado: <?= $estado ?></small>
                                        <br>
                                        <i>Criado aos: <?= $posto->postoDataRegistro ?></i>
                                    </div>
                                </div>
                                <div class="card footer p-2 bg-light text.center">
                                    <div class="text-center">
                                        <?php
                                        if ($dadosAdm->idNivelAcesso <= 1) : ?>
                                            <?= $btnStatusAcao ?> |
                                            <a href="#" class="bi bi-trash text-danger text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalResponse" onclick="eliminaPosto(<?= $posto->idposto ?>)">
                                                <span class="ms-1">Eliminar</span>
                                            </a>
                                        <?php else : ?>
                                            <?= $btnStatusAcao ?>
                                        <?php endif ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

            </div>
            <!-- Fim grelha -->

        </section><!-- Fim table postos -->
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
        // altera estados posto
        function alteraEstadoConta(estado, posto) {
            let resposta = document.querySelector('.respos')
            const datas = new FormData()
            datas.append('acao', 'muda-estado-posto')
            datas.append('id-estado', estado)
            datas.append('posto', posto)
            fetch('<?= ROUTE ?>Requests/requestAjax.php', {
                    method: 'POST',
                    body: datas
                })
                .then(res => res.json())
                .then(result => {
                    if (estado == 2) {
                        resposta.innerHTML = `<div class="alert alert-success text-center">${result.msg}</div>`
                    } else {
                        resposta.innerHTML = `<div class="alert alert-danger">${result.msg}</div>`

                    }

                    var modal = new bootstrap.Modal(document.getElementById("modalErro"));
                    modal.show();

                    setTimeout(() => {
                        location.reload()
                    }, 5000);

                })
        }

        // elimina posto 
        function eliminaPosto(idposto) {

            let id = document.querySelector('#confirm')
            id.value = idposto


        }

        function confirmaEliminacao() {
            let id = document.querySelector('#confirm')
            let resposta = document.querySelector('.tt');
            alert(id.value)
            const datas = new FormData()
            datas.append('acao', 'elimina-posto')
            datas.append('posto', id.value)
            fetch('<?= ROUTE ?>Requests/requestAjax.php', {
                    method: 'POST',
                    body: datas
                })
                .then(res => res.json())
                .then(result => {
                    if (result == 200) {
                        resposta.innerHTML = `<div class="text-white text-center">${result.msg}</div>`
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
                    }, 5000);

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