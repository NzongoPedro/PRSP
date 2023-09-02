<?php
if (isset($_SESSIONd['token-posto']) && isset($_SESSION['id-posto'])) : ?>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="demo-inline-spacing float-end">
                <a href="./?gestorPage=posto-edit&id-posto=<?= $_SESSION['id-posto'] ?>" title="Editar dados" class="btn rounded-pill btn-icon btn-dark">
                    <span class="tf-icons bx bx-edit"></span>
                </a>
            </div>
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Relatório</h4>

            <div class="row mb-5">
                <div class="col-md-6 col-lg-4 col-12">
                    <div class="card mb-3">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <span class="text-white">Gerear relatórios</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="alert mt-3 shadow-sm border-danger border-1 mb-2">
                                    <span class="float-end">
                                        <a href="#" class='bx bx-down-arrow-circle bx-sm text-primary'></a>
                                    </span>
                                    <h6 class="mt-1">
                                        <i class='bx bx-calendar-star me-2'></i>
                                        Diário
                                    </h6>
                                </div>
                                <div class="alert mt-2 shadow-sm border-danger border-1 mb-2">
                                    <span class="float-end">
                                        <a href="#" class='bx bx-down-arrow-circle bx-sm text-primary'></a>
                                    </span>
                                    <h6 class="mt-1">
                                        <i class='bx bx-calendar-week me-2'></i>
                                        Semanal
                                    </h6>
                                </div>
                                <div class="alert mt-2 shadow-sm border-danger border-1 mb-2">
                                    <span class="float-end">
                                        <a href="#" class='bx bx-down-arrow-circle bx-sm text-primary'></a>
                                    </span>
                                    <h6 class="mt-1">
                                        <i class='bx bx-calendar me-2'></i>
                                        Mensal
                                    </h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Resultados do filtro
                        </div>
                        <div class="card-body">
                            <div class="resultado">
                                <div class="d-flex justify-content-center align-content-center">
                                    <i class='bx bx-loader bx-lg bx-spin'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--/ Content types -->


    </div>
    <!-- / Content -->

    <!-- Footer -->
    <?php require '../pages/footer.php'; ?>
    <!-- / Footer -->


    <div class="content-backdrop fade"></div>
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
<!--Invocando a moda de postos -->

<script>
    document.querySelector('title').innerHTML = "Gerenciamento de postos | PRSP"
</script>

<script>
    // gerar relatório mensal

    fetch('<?=ROUTE?>')
</script>