<?php
require_once('../../vendor/autoload.php');
require '../../config.php';

use App\controller\admController as adm;

if (!isset($_SESSION['idAdmin'])) {
    header('location:' . ROUTE . 'cpainel/cpainel-admin/auth.php');
}
$idAdm = $_SESSION['idAdmin'];
$dadosAdm = adm::mostraDadosAdm($idAdm);
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
    <!-- dATA TABLES -->
    <link rel="stylesheet" href="<?= JS ?>simple-datatables/style.css">
    <!-- AOS -->
    <link rel="stylesheet" href="<?= AOS ?>aos.css">

</head>

<body>
    <div class="row">
        <!-- NAV LATERAL ESQUERDO VERTCAL -->
        <div class="col-2 bg-white"><!-- COLUNA De 2 -->
            <nav class="h-100 bg-white">
                <!-- DADOS ADMNI -->
                <div class="menu-fixo h-100">
                    <div class="carta">
                        <img src="<?= IMAGENS ?>admin/admin.png" alt="Foto de Perfil" class="profile-picture">
                        <h3 class="admin-name"><?= $dadosAdm->admNome ?></h3>
                    </div><!-- FIM DADOS ADMIN -->
                    <!-- MENU -->
                    <ul class="list-group list-group menu-lateral">
                        <li class="list-group-item menu-lateral-item">
                            <a href="./?admPage=dashboard#dash" class="nav-link">
                                <i class="bi bi-laptop-fill"></i>
                                dashboard
                            </a>
                        </li>
                        <li class="list-group-item menu-lateral-item">
                            <a href="./?admPage=postos#postos" class="nav-link">
                                <i class="bi bi-bank2"></i>
                                postos
                            </a>
                        </li>
                        <li class="list-group-item menu-lateral-item">
                            <a href="./?admPage=utentes#utentes" class="nav-link">
                                <i class="bi bi-person-fill"></i>
                                utentes
                            </a>
                        </li>
                        <li class="list-group-item menu-lateral-item">
                            <a href="./?admPage=#" class="nav-link">
                                <i class="bi bi-person-plus-fill"></i>
                                admnistradores
                            </a>
                        </li>
                        <li class="list-group-item menu-lateral-item">
                            <a href="./?admPage=#" class="nav-link">
                                <i class="bi bi-person-lines-fill"></i>
                                gestores
                            </a>
                        </li>
                        <li class="list-group-item menu-lateral-item">
                            <a href="./?admPage=#" class="nav-link">
                                <i class="bi bi-newspaper"></i>
                                newlater
                            </a>
                        </li>
                        <li class="list-group-item menu-lateral-item">
                            <a href="./seesion_destroy.php" class="nav-link text-danger">
                                <i class="bi bi-power"></i>
                                terminar sessão
                            </a>
                        </li>
                    </ul><!-- FIM MENU -->
                </div>
            </nav>
        </div><!-- FIM COLUNA DE 2 -->
        <!-- COLUNA CENTRAL -->
        <div class="col-10">
            <!-- foto superior direito -->
            <section class="adm">
                <div class="logo-svg">
                    <a href="./" class="navbar-brand"><img src="<?= IMAGENS ?>logo/logotipo1_amarelo.svg" alt=""></a>

                </div>
                <div class="data">
                    <span class="tempo"></span>
                </div>
                <div class="adm-barra">
                    <div class="foto">
                        <img src="<?= IMAGENS ?>admin/admin.png" alt="Foto de Perfil" class="profile-picture">
                    </div>
                    <div class="dropdown drop-nome">
                        <a class="nav-link dropdown-toggle" href="#!" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= explode(" ", $dadosAdm->admNome)[0] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Definições</a></li>
                            <li><a class="dropdown-item" href="#">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </section><!-- Fim nome direito -->
            <br><br><br>
            <div style="position: sticky;">
                <?php
                # View das páginas
                # De Navegação

                // verfica se algum link foi clicado

                if (isset($_GET['admPage'])) {
                    //guarda o parametro de rota da páginanuma variavel
                    // e faz o tratamento de erros

                    $page = addslashes(htmlspecialchars(filter_input(INPUT_GET, 'admPage')));

                    //verifica a existência da página

                    if (file_exists('./pages/' . $page . '.php')) {
                        require './pages/' . $page . '.php';  // exibe a página caso exista
                    } else {
                        require './pages/404.php'; // mostra página de erro
                    }
                } else {

                    require './pages/prsp.php'; // mostra página de erro
                }
                ?>
            </div>
        </div>
        <!-- FIM NAV LATERAL ESQUERDO VERTICAL -->
    </div>

    <script src="<?= JS ?>poper.js"></script>
    <script src="<?= JS ?>slick/slick.min.js"></script>
    <script src="<?= BOOTSTRAP ?>js/bootstrap.min.js"></script>
    <script src="<?= AOS ?>aos.js"></script>
    <script src="<?= JS ?>simple-datatables/simple-datatables.js"></script>
    <script src="<?= JS ?>simple-datatables/tamynce.js"></script>
    <script src="<?= JS ?>simple-datatables/main.js"></script>
    <script>
        AOS.init()
        // criando um rélógio
        const saudacao = () => {
            let data = new Date();
            let dia = data.getDate();
            let mes = data.getMonth();
            let ano = data.getFullYear();
            let horas = data.getHours();
            let minutos = data.getMinutes();
            let segundos = data.getSeconds();
            let diaSemana = data.getDay();
            let diasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
            let meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

            // mensagens de saudação
            let msgSaudacao = "";

            // verifica o périodo da saudação 

            if (horas >= 0 && horas <= 11) {
                msgSaudacao = 'bom dia'
            } else if (horas >= 12 && horas <= 17) {
                msgSaudacao = 'boa tarde'
            } else {
                msgSaudacao = 'boa boite'
            }

            // organiza os minutos, segundos e horas adicionando 0 na frentw de horas
            // ou minutos com apenas um algarismo. 

            if (horas >= 0 && horas <= 9) {
                horas = '0' + horas
            }
            if (minutos >= 0 && minutos <= 9) {
                minutos = '0' + minutos
            }
            if (segundos >= 0 && segundos <= 9) {
                segundos = '0' + segundos
            }

            // mostrando e, portugues os meses e dias de semana

            diaSemana = diasSemana[diaSemana];
            mes = meses[mes]

            let tempo = `${dia} de ${mes} de ${ano} | ${horas}:${minutos}:${segundos} [${msgSaudacao}]`

            const el = document.querySelector('.tempo')

            el.innerHTML = tempo

            console.log(tempo)
        }

        setInterval(() => {
            return saudacao()
        }, 1000);
    </script>

</body>

</html>