<?php
require '../../config.php';
if (isset($_SESSION['idAdmin'])) {
    header('location:' . ROUTE . 'cpainel/cpainel-admin/');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Painel de controle Geral</title>

    <!-- BOOTSTRAP  -->
    <link rel="stylesheet" href="<?= BOOTSTRAP ?>css/bootstrap.min.css">
    <!-- CSS PRINCIPAL -->
    <link rel="stylesheet" href="<?= CSS ?>dash.css">
    <!-- ICONS -->
    <link rel="stylesheet" href="<?= BICON ?>">
    <!-- Slick -->
    <link rel="stylesheet" href="<?= JS ?>slick/slick.css">
    <link rel="stylesheet" href="<?= JS ?>toast/file.css">

</head>

<body class="bg-light">

    <br><br><br><br>
    <div class="container shadow-sm border-1 sombra rounded rounded-2">
        <div class="row p-0 bg-light rounded-5  rounded">
            <div class="col-8">
                <div class="fundo-capa" data-aos="zoom-out" data-aos-duration="2000" data-aos-transition="1500">
                    <img src="<?= IMAGENS ?>auth/auth-1.jpg" class="w-100 h-auto" alt="">
                </div>
            </div>
            <div class="col-4 linha-login">

                <div class="card border-0 rounded-0 bg-transparent card-login shadow-none" data-aos="fade-up" data-aos-duration="900" data-aos-transition="1500">
                    <img src="<?= IMAGENS ?>logo/logotipo1_principal.svg" class="logotipo-login" alt="logo">
                    <div class="card-body">
                        <h5 class="card-title text-center">Login Administrativo</h5>
                        <div class="traco"></div>
                        <b>
                            <hr class="text-danger">
                        </b>
                        <form action="" id="form-login">
                            <div class="col-12 mb-3">
                                <label for="email" class="mb-1">e-mail</label>
                                <div class="form-group">
                                    <input name="emailAdmin" id="email" type="text" class="form-control form-control-lg" placeholder="seunome@provedor.com">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email" class="mb-1">palavra-passe</label>
                                <div class="form-group">
                                    <input name="senhaAdmin" id="password" type="password" class="form-control form-control-lg" placeholder="*********************************************">
                                </div>
                            </div>
                            <div class="resposta-login text-center"></div>
                            <input type="hidden" name="acao" value="login-admin">
                            <div class="mt-2">
                                <button class="w-100 btn btn-lg">Entrar</button>
                            </div>
                        </form>
                        <p class="text-center mt-3">
                            <a href="#" class="nav-link">Esqueceu a senha?</a>
                        </p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center p-2">
        <p>PRSP <?= date('Y') ?>. Todos os direitos reservados</p>
        <span>Desenvolvido por Arodisi</span>
    </div>

    <body>

        <script src="<?= JS ?>jquery/jquery.js"></script>
        <script src="<?= JS ?>toast/file.js"></script>
        <script src="<?= JS ?>slick/slick.min.js"></script>
        <script src="<?= BOOTSTRAP ?>js/bootstrap.min.js"></script>
        <script src="<?= AOS ?>aos.js"></script>
        <script>
            AOS.init()
        </script>
        <script src="<?= JS ?>auth.js"></script>
    </body>

</html>