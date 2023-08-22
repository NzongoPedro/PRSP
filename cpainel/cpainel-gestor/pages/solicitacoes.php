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


                            foreach ($solicitacoes as $solicitacao) {

                                $statusClasse = 'warning';
                                if ($solicitacao->estadoSolicitacao == "cancelado") {
                                    $statusClasse = 'danger';
                                }
                                if ($solicitacao->estadoSolicitacao == "aprovado") {
                                    $statusClasse = 'success';
                                }
                            ?>
                                <tr>
                                    <td><?= $solicitacao->idsolicitacao_reserva ?></td>
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
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
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

<script>
    document.querySelector('title').innerHTML = "Solicitação de reservas | PRSP"
    /* document.addEventListener("DOMContentLoaded", function() {
        var modal = new bootstrap.Modal(document.getElementById("modalPostoNovo"));
        modal.show();
    }); 

    /* INSTRUÇÃO PARA REGISTRAR Posto */
</script>