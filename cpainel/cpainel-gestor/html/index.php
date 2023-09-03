<?php
require_once('../../../vendor/autoload.php');
require '../../../config.php';

// imprta todas as controllers necessários

use App\controller\GestoresController as gestores;
use App\controller\PostosController as postos;
use App\controller\ServicosController as servicos;
use App\Model\Postos as p;
use App\controller\CounterController as contador;
// verifica se o gestor já está autenticado

if (!isset($_SESSION['idGestor'])) {
  // redireciona para o login caso não estiver
  header('location:' . ROUTE . 'cpainel/cpainel-gestor/html/auth-login.php');
}

$id_gestor = $_SESSION['idGestor'];
$gestor = gestores::mostraDadosGestor($id_gestor);
$posto = postos::mostrarDadosPostoPorGestor($id_gestor);

$idposto = "";
if (p::idPosto($id_gestor)) {
  $idposto = p::idPosto($id_gestor)->idposto;
}

$solicitacoes  = servicos::verReservas($idposto);

$servicos = servicos::verServicosPorIdPosto($idposto);

$fotoGestor = gestores::verFoto($id_gestor);

$contador = contador::counter($idposto);

?>

<!DOCTYPE html>

<html lang="pt-br" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Gestão de postos | PRSP</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <link rel="stylesheet" href="../../../public/css/theme.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />


  <!-- Page CSS -->


  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="">
          <a href="./">
            <span class="app-brand-logof">
              <img src="<?= IMAGENS ?>logo/logotipo1_principal.svg" alt="logotipo" class="w-75">
            </span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item">
            <a href="./index.php?gestorPage=dashboard" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>

          <?php
          if (isset($_SESSION['token-posto']) && isset($_SESSION['id-posto'])) : ?>
            <li class="menu-item">
              <a href="./index.php?gestorPage=solicitacoes" class="menu-link">
                <i class='menu-icon bx bx-barcode'></i>
                <div data-i18n="Analytics">Solicitações</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="./index.php?gestorPage=servicos" class="menu-link">
                <i class='menu-icon bx bx-task'></i>
                <div data-i18n="Analytics">Serviços</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="./?gestorPage=posto" class="menu-link">
                <i class='menu-icon bx bx-buildings'></i>
                <div data-i18n="Analytics">Posto</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="./?gestorPage=relatorios" class="menu-link">
                <i class='menu-icon bx bx-list-ul'></i>
                <div data-i18n="Analytics">Relatórios</div>
              </a>
            </li>
          <?php endif ?>

        </ul>

      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Utente -->
              <?php
              if (!isset($_SESSION['token-posto']) && !isset($_SESSION['id-posto'])) : ?>
                <div class="text-start">
                  <?php
                  if (postos::checkPosto($gestor->idgestor) == false) : ?>
                    <button type="button" class="btn btn-dark rounded-5 btn-lg rounded" data-bs-toggle="modal" data-bs-target="#modalPostoNovo" id="btnModal">
                      <span class="tf-icons bx bx-plus me-1"></span>
                      Criar posto
                    </button>
                  <?php endif ?>
                  <?php
                  if ($gestor->idEstadoConta <= 1) : ?>
                  <?php else : ?>
                    <a href="#" class="btn f-primario text-white rounded-5 btn-lg rounded" data-bs-toggle="modal" data-bs-target="#modalToken">
                      <i class='bx bxs-layer-plus me-2'></i>Aceder ao posto
                    </a>
                  <?php endif; ?>
                </div>
              <?php else : ?>
                <a class="btn btn-lg btn-light me-0">
                  <b><?= $posto->postoDesignacao ?></b>
                </a>
              <?php endif ?>
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="<?= $fotoGestor ?>" style="max-width: 100%; width:40px; height:40px;" alt class="rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-1">
                          <div class="avatar avatar-online">
                            <img src="<?= $fotoGestor ?>" style="max-width: 100%; width:40px; height:40px;" alt class="rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?= $gestor->gestorNome ?></span>
                          <small class="text-muted">Gestor</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="./index.php?gestorPage=perfil-gestor">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">Minha conta</span>
                    </a>
                  </li>
                  <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="./logout.php">
                  <i class="bx bx-power-off me-2"></i>
                  <span class="align-middle">Terminar sessão</span>
                </a>
              </li>
            </ul>
            </li>
            <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <?php
        # View das páginas
        # De Navegação

        // verfica se algum link foi clicado

        if (isset($_GET['gestorPage'])) {
          //guarda o parametro de rota da páginanuma variavel
          // e faz o tratamento de erros

          $page = addslashes(htmlspecialchars(filter_input(INPUT_GET, 'gestorPage')));

          //verifica a existência da página

          if (file_exists('../pages/' . $page . '.php')) {
            require '../pages/' . $page . '.php';  // exibe a página caso exista
          } else {
            require './404.php'; // mostra página de erro
          }
        } else {

          require '../pages/dashboard.php'; // mostra página principal
        }
        ?>



        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
      </div>
      <!-- / Layout wrapper -->

      <?php
      require '../components/modalAccessToken.php';
      require '../components/modalErro.php';
      require '../components/ModalNovoPosto.php';
      ?>

      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="../assets/vendor/libs/jquery/jquery.js"></script>
      <script src="../assets/vendor/libs/popper/popper.js"></script>
      <script src="../assets/vendor/js/bootstrap.js"></script>
      <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

      <script src="../assets/vendor/js/menu.js"></script>
      <!-- endbuild -->

      <!-- Vendors JS -->
      <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

      <!-- Main JS -->
      <script src="../assets/js/main.js"></script>

      <!-- Page JS -->
      <script>
        /**
         * Dashboard Analytics
         */

        'use strict';

        (function() {
          let cardColor, headingColor, axisColor, shadeColor, borderColor;

          cardColor = config.colors.white;
          headingColor = config.colors.headingColor;
          axisColor = config.colors.axisColor;
          borderColor = config.colors.borderColor;

          // Profit Report Line Chart

          // Order Statistics Chart
          // --------------------------------------------------------------------
          const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
            orderChartConfig = {
              chart: {
                height: 165,
                width: 130,
                type: 'donut'
              },
              labels: ['Postos', 'Solicitações', 'Documentos', 'Relatórios'],
              series: [1, <?= number_format($contador['num_solicitacoes']) ?>, <?= number_format($contador['num_documentos']) ?>, 1],
              colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
              stroke: {
                width: 5,
                colors: cardColor
              },
              dataLabels: {
                enabled: false,
                formatter: function(val, opt) {
                  return parseInt(val) + '100%';
                }
              },
              legend: {
                show: false
              },
              grid: {
                padding: {
                  top: 0,
                  bottom: 0,
                  right: 15
                }
              },
              plotOptions: {
                pie: {
                  donut: {
                    size: '75%',
                    labels: {
                      show: true,
                      value: {
                        fontSize: '1.5rem',
                        fontFamily: 'Public Sans',
                        color: headingColor,
                        offsetY: -15,
                        formatter: function(val) {
                          return parseInt(val) + '%';
                        }
                      },
                      name: {
                        offsetY: 20,
                        fontFamily: 'Public Sans'
                      },
                      total: {
                        show: true,
                        fontSize: '0.8125rem',
                        color: axisColor,
                        label: 'Total',
                        formatter: function(w) {
                          return '100%';
                        }
                      }
                    }
                  }
                }
              }
            };
          if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
            const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
            statisticsChart.render();
          }

          // Income Chart - Area chart
          // --------------------------------------------------------------------
          const incomeChartEl = document.querySelector('#incomeChart'),
            incomeChartConfig = {
              series: [{
                data: [0, <?= number_format($contador['num_solicitacoes']) ?>, <?= number_format($contador['num_solitacoes_recusadas']) ?>, <?= number_format($contador['num_solitacoes_pendentes']) ?>, <?= number_format($contador['num_solitacoes_aprovadas']) ?>, <?= number_format($contador['num_solitacoes_atendidas']) ?>]
              }],
              chart: {
                height: 215,
                parentHeightOffset: 0,
                parentWidthOffset: 0,
                toolbar: {
                  show: false
                },
                type: 'area'
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                width: 2,
                curve: 'smooth'
              },
              legend: {
                show: false
              },
              markers: {
                size: 6,
                colors: 'transparent',
                strokeColors: 'transparent',
                strokeWidth: 4,
                discrete: [{
                  fillColor: config.colors.white,
                  seriesIndex: 0,
                  dataPointIndex: 7,
                  strokeColor: config.colors.primary,
                  strokeWidth: 2,
                  size: 6,
                  radius: 8
                }],
                hover: {
                  size: 7
                }
              },
              colors: [config.colors.primary],
              fill: {
                type: 'gradient',
                gradient: {
                  shade: shadeColor,
                  shadeIntensity: 0.6,
                  opacityFrom: 0.5,
                  opacityTo: 0.25,
                  stops: [0, 95, 100]
                }
              },
              grid: {
                borderColor: borderColor,
                strokeDashArray: 3,
                padding: {
                  top: -20,
                  bottom: -8,
                  left: -10,
                  right: 8
                }
              },
              xaxis: {
                categories: ['', 'Total', 'Recusados', 'Pendentes', 'Aprovados', 'Antendidos'],
                axisBorder: {
                  show: false
                },
                axisTicks: {
                  show: false
                },
                labels: {
                  show: true,
                  style: {
                    fontSize: '13px',
                    colors: axisColor
                  }
                }
              },
              yaxis: {
                labels: {
                  show: false
                },
                min: 10,
                max: 50,
                tickAmount: 4
              }
            };
          if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
            const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
            incomeChart.render();
          }

          // Expenses Mini Chart - Radial Chart
          // --------------------------------------------------------------------
          const weeklyExpensesEl = document.querySelector('#expensesOfWeek'),
            weeklyExpensesConfig = {
              series: [65],
              chart: {
                width: 60,
                height: 60,
                type: 'radialBar'
              },
              plotOptions: {
                radialBar: {
                  startAngle: 0,
                  endAngle: 360,
                  strokeWidth: '8',
                  hollow: {
                    margin: 2,
                    size: '45%'
                  },
                  track: {
                    strokeWidth: '50%',
                    background: borderColor
                  },
                  dataLabels: {
                    show: true,
                    name: {
                      show: false
                    },
                    value: {
                      formatter: function(val) {
                        return '$' + parseInt(val);
                      },
                      offsetY: 5,
                      color: '#697a8d',
                      fontSize: '13px',
                      show: true
                    }
                  }
                }
              },
              fill: {
                type: 'solid',
                colors: config.colors.primary
              },
              stroke: {
                lineCap: 'round'
              },
              grid: {
                padding: {
                  top: -10,
                  bottom: -15,
                  left: -10,
                  right: -10
                }
              },
              states: {
                hover: {
                  filter: {
                    type: 'none'
                  }
                },
                active: {
                  filter: {
                    type: 'none'
                  }
                }
              }
            };
          if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
            const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
            weeklyExpenses.render();
          }
        })();
      </script>

      <script>
        // altera estado comnta do gestor
        function alteraEstadoConta() {
          let resposta = document.querySelector('.respos')
          const datas = new FormData()
          datas.append('acao', 'check-estado-gestor')
          datas.append('gestor', <?= $id_gestor ?>)
          fetch('<?= ROUTE ?>Requests/requestAjax.php', {
              method: 'POST',
              body: datas
            })
            .then(res => res.text())
            .then(estado => {
              if (estado == 1) {
                $('#modalErro').modal('show')

                document.getElementById('btnModal').classList.add('d-none');

              }

              if (estado == 2) {
                $('#modalErro').modal('hide')
                document.getElementById('btnModal').classList.remove('d-none');
              }


            })
        }

        setInterval(() => {
          alteraEstadoConta()
        }, 1020000);
      </script>
</body>

</html>