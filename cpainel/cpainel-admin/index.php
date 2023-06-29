<?php
require '../../config.php';
require_once('../../vendor/autoload.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de controle Geral</title>

    <!-- BOOTSTRAP  -->
    <link rel="stylesheet" href="<?= BOOTSTRAP ?>css/bootstrap.min.css">
    <!-- CSS PRINCIPAL -->
    <link rel="stylesheet" href="<?= CSS ?>dash.css">
    <!-- ICONS -->
    <link rel="stylesheet" href="<?= BICON ?>">
    <!-- Slick -->
    <link rel="stylesheet" href="<?= JS ?>slick/slick.css">

</head>

<body>
    <div class="row">
        <!-- NAV LATERAL ESQUERDO VERTCAL -->
        <div class="col-2"><!-- COLUNA De 2 -->
            <nav>
                <!-- DADOS ADMNI -->
                <div class="carta">
                    <img src="<?= IMAGENS ?>admin/admin.png" alt="Foto de Perfil" class="profile-picture">
                    <h3 class="admin-name">Admin</h3>
                </div><!-- FIM DADOS ADMIN -->
                <!-- MENU -->
                <ul class="list-group list-group menu-lateral">
                    <li class="list-group-item menu-lateral-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-house-fill"></i>
                            dashboard
                        </a>
                    </li>
                </ul><!-- FIM MENU -->
            </nav>
        </div><!-- FIM COLUNA DE 2 -->
        <!-- COLUNA CENTRAL -->
        <div class="col-10">
            <section class="nav-horizontal">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        ...
                    </div>
                </div>
            </section>
            <!-- SECÇÃO dasbh-->
            <section class="card dash border-0 rounded-0 shadow-sm">
                <div class="card-body corpo-dash">
                    <!-- CARDS DE INFORMAçÃO -->
                    <div class="row">
                        <div class="col-2">
                            <div class="alert alert-light alertas border-2 rounded-0 shadow-sm">
                                <div class="alerta-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5 class="alerta-titulo">
                                    Titulo
                                    <small class="alerta-num">
                                        20
                                    </small>
                                </h5>
                            </div>
                        </div>
                    </div> <!-- FIM CARDS DE INFORMAçÃO -->
                    <h5 class="card-title titulo-dash">dashboard</h5>
                </div>
            </section><!-- Fim secção dash -->
        </div>
        <!-- FIM NAV LATERAL ESQUERDO VERTICAL -->
    </div>

    <script src="<?= JS ?>jquery/jquery.js"></script>
    <script src="<?= JS ?>slick/slick.min.js"></script>
    <script src="<?= BOOTSTRAP ?>js/bootstrap.min.js"></script>
    <script src="<?= AOS ?>aos.js"></script>
</body>

</html>