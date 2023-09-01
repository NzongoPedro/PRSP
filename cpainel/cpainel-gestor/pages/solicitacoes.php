<?php
if (isset($_SESSION['token-posto']) && isset($_SESSION['id-posto'])) :

?>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Solicitações de reservas</h4>

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <h5 class="card-header">Lista de reservas</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped table-hover hoverable">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Serviço</th>
                                    <th>Utente</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0 text-start">
                                <?php

                                $btnGerarPdf = "";
                                foreach ($solicitacoes as $solicitacao) {

                                    $statusClasse = 'warning';
                                    if ($solicitacao->estadoSolicitacao == "recusado") {
                                        $statusClasse = 'danger';
                                    }
                                    if ($solicitacao->estadoSolicitacao == "aprovado") {
                                        $statusClasse = 'success';
                                        $btnGerarPdf = '<a href="#!" class="text-danger bi bi-check" onclick="criarComprovativo(<?= $solicitacao->idutente ?>, <?= $solicitacao->idsolicitacao_reserva ?>)">
                                <span class="me-1">comprovativo</span></a>';
                                    }
                                ?>
                                    <tr>
                                        <td><?= $solicitacao->idsolicitacao_reserva ?> </td>
                                        <td>
                                            <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong><?= $solicitacao->documentoDesignacao ?></strong>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                <li>
                                                    <!-- <img src="<?= IMAGENS ?>admin/admin.png" alt="Avatar" class="rounded-circle" /> -->
                                                    <span class="ms-2"><?= $solicitacao->utenteNome ?></span>

                                                </li>
                                            </ul>
                                        </td>
                                        <td><?= $solicitacao->solicitacaoReservaData ?></td>
                                        <td><?= $solicitacao->solicitacaoReservaHora ?></td>
                                        <td><span class="badge bg-label-<?= $statusClasse ?> me-1 rounded-5"><?= $solicitacao->estadoSolicitacao ?></span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php
                                                    if ($solicitacao->estadoSolicitacao == "pendente") : ?>
                                                        <a class="dropdown-item text-success" href="javascript:void(0);" onclick="alterarEstadoSolicitacoes(2, <?= $solicitacao->idsolicitacao_reserva ?>)">
                                                            <i class="bx bx-check me-1"></i> Aprovar
                                                        </a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="alterarEstadoSolicitacoes(3, <?= $solicitacao->idsolicitacao_reserva ?>)">
                                                            <i class="bx bx-trash me-1"></i> Cancelar
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php

                                                    if ($solicitacao->estadoSolicitacao == "recusado") : ?>
                                                        <a class="dropdown-item text-success" href="javascript:void(0);" onclick="alterarEstadoSolicitacoes(2, <?= $solicitacao->idsolicitacao_reserva ?>)">
                                                            <i class="bx bx-check me-1"></i> Aprovar
                                                        </a>
                                                        <a class="dropdown-item text-warning" href="javascript:void(0);" onclick="alterarEstadoSolicitacoes(1, <?= $solicitacao->idsolicitacao_reserva ?>)">
                                                            <i class="bx bx-rotate-left me-1"></i> Reverter
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php

                                                    if ($solicitacao->estadoSolicitacao == "aprovado") : ?>

                                                        <a class="dropdown-item text-dark" onclick="criarComprovativo(<?= $solicitacao->idutente ?>, <?= $solicitacao->idsolicitacao_reserva ?>)">
                                                            <i class="bx bxs-file-pdf me-1"></i> Comprovativo
                                                        </a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="alterarEstadoSolicitacoes(3, <?= $solicitacao->idsolicitacao_reserva ?>)">
                                                            <i class="bx bx-trash me-1"></i> Recusar
                                                        </a>
                                                        <a class="dropdown-item text-warning" href="javascript:void(0);" onclick="alterarEstadoSolicitacoes(1, <?= $solicitacao->idsolicitacao_reserva ?>)">
                                                            <i class="bx bx-rotate-left me-1"></i> Reverter
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php  }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!--/ Basic Bootstrap Table -->

                </div>
                <!-- / Content -->

                <!-- Footer -->
                <?php require '../pages/footer.php'; ?>
                <!-- / Footer -->
            </div>
        </div>
    </div>
<?php else : ?>
    <script>
        document.querySelector('title').innerHTML = "Gerenciamento de postos | PRSP"
        document.addEventListener("DOMContentLoaded", function() {
            var modal = new bootstrap.Modal(document.getElementById("modalToken"));
            modal.show();
        });
    </script>
<?php endif ?>
<!-- Modal -->
<div class="modal fade bg-transparent border-0 shadow-none " id="modalResposta" tabindex="-1" aria-labelledby="modalRespostaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm bg-transparent border-0 shadow-none ">
        <div class="modal-content bg-transparent border-0 shadow-none ">
            <div class="modal-body bg-transparent border-0 shadow-none ">
                <div class="respos"></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('title').innerHTML = "Solicitação de reservas | PRSP"

    /* INSTRUÇÃO PARA MUDAR O ESTADO LICITAçAO */

    function alterarEstadoSolicitacoes(id_estado, id_solicitacao) {
        let resposta = document.querySelector('.respos')
        const datas = new FormData()
        datas.append('acao', 'muda-estado-solicitacoes')
        datas.append('id-estado', id_estado)
        datas.append('id-solicitacao', id_solicitacao)
        fetch('<?= ROUTE ?>Requests/requestAjax.php', {
                method: 'POST',
                body: datas
            })
            .then(res => res.json())
            .then(result => {
                if (id_estado == 1) {
                    resposta.innerHTML = `<div class="alert alert-warning">${result.msg}</div>`
                } else if (id_estado == 2) {
                    resposta.innerHTML = `<div class="alert alert-success">${result.msg}</div>`
                } else {
                    resposta.innerHTML = `<div class="alert alert-danger">${result.msg}</div>`

                }

                var modal = new bootstrap.Modal(document.getElementById("modalResposta"));
                modal.show();

                setTimeout(() => {
                    location.reload()
                }, 5000);

            })
    }


    // criar o compravitivo

    /* GERAR O CODIGO DE COMPROVATIVO */

    function generateRandomCode() {
        function generateRandomChars(length, chars) {
            let result = "";
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * chars.length);
                result += chars[randomIndex];
            }
            return result;
        }

        const numbers = "0123456789";
        const uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const lowercaseLetters = "abcdefghijklmnopqrstuvwxyz";

        const randomNumbers = generateRandomChars(2, numbers);
        const randomUppercaseLetters = generateRandomChars(2, uppercaseLetters);
        const randomLowercaseLetters = generateRandomChars(2, lowercaseLetters);

        const combinedRandomChars = randomNumbers + randomUppercaseLetters + randomLowercaseLetters;

        // Shuffle the characters to ensure randomness
        const shuffledCode = combinedRandomChars.split("").sort(() => 0.5 - Math.random()).join("");

        return shuffledCode;
    }

    let randomCode = "";

    setInterval(() => {
        randomCode = generateRandomCode()
    }, 500);

    function criarComprovativo(utente, reserva) {

        dados = new FormData() // capta os dados do formulário
        dados.append('acao', 'cria-comprovativo')
        dados.append('reserva', reserva)
        dados.append('utente', utente)
        dados.append('referencia', randomCode)
        fetch('<?= ROUTE ?>Requests/requestAjax.php ', { // envia os dados para uma página php
                body: dados, // Dados a serem enviados
                method: 'POST' // verbo ou metodo HTTP da requisição
            })
            .then(res => res.json()) // envia e espera uma resposta no formato json de dados
            .then(resposta => { // armazena os dados da resposta no objeto resposta
                if (resposta.status == 200) {
                    // alert(resposta.msg + ' ' + resposta.id_comprovativo)
                    setTimeout(() => {
                        location.href = '<?= ROUTE ?>comprovativo.php?id-comprovativo=' + resposta.id_comprovativo
                    }, 2000);
                } else {
                    alert(resposta.msg)
                    location.href = '<?= ROUTE ?>comprovativo.php?id-comprovativo=' + resposta.id_comprovativo
                }
            })
            .catch(err => { // caso houver um erro

            })

    }
</script>