<?php
require_once('../../../vendor/autoload.php');
require '../../../config.php';

// verifica se o gestor já está autenticado

if (isset($_SESSION['idGestor'])) {
  // redireciona para dashboard caso tiver
  header('location:' . ROUTE . 'cpainel/cpainel-gestor/html/');
}

# Caso não, mantém a página de autemticação
?>
<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Criar conta - Gestor | PRSP</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <!--  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
 -->
  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!--   <link rel="stylesheet" href="<?= CSS ?>dash.css"> -->
  <!-- Page -->
  <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>

  <style>
    /* VARIAVEIS */
    :root {
      --cor-primario: #991f0c !important;
      --cor-secondario: #ffc745 !important;
      --fundo-primario: #991f0c !important;
      --fundo-secondario: #ffc745 !important;
      --cor-clara: #fbfbfb !important;
      --funda: #fbfbfb !important;
    }

    /* TEMAS CSS */
    .cor-primario {
      color: #991f0c !important;
    }

    .f-primario {
      background: #991f0c !important;
      color: #fff !important;
    }

    .f-secundario {
      background: #ffc745 !important;
    }

    .btn-primario {
      background: hsl(8, 85%, 32%) !important;
      color: #ffc745 !important;
      border: 1px solid hsl(8, 85%, 32%) !important;
    }

    .btn-secundario {
      background: hsl(42, 100%, 64%) !important;
      color: #991f0c !important;
    }

    .gradiente-1 {
      background: #991f0c;
      background: -moz-linear-gradient(45deg, #991f0c 0%, #ffc745 100%);
      background: -webkit-linear-gradient(45deg, #991f0c 0%, #ffc745 100%);
      background: linear-gradient(45deg, #991f0c 0%, #ffc745 100%) !important;
    }

    .gradiente-2 {
      background: rgba(153, 31, 12, 0.7);
      background: -moz-linear-gradient(45deg,
          rgba(153, 31, 12, 0.5) 0%,
          rgba(255, 199, 69, 0.7) 100%) !important;
      background: -webkit-linear-gradient(45deg,
          rgba(153, 31, 12, 0.5) 0%,
          rgba(255, 199, 69, 0.5) 100%) !important;
      background: linear-gradient(45deg,
          rgba(153, 31, 12, 0.5) 0%,
          rgba(255, 199, 69, 0.7) 100%) !important;
    }

    input {
      box-shadow: none !important;
      border: #991f0c 1.5px solid !important;
    }

    input:focus {
      box-shadow: #991f0c !important;
      border: #991f0c 1.5px solid !important;
    }

    .border-p {
      border: 1px solid #991f0c !important;
    }
  </style>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="justify-content-center text-center d-flex m-auto">
              <a href="index.html">
                <img src="<?= IMAGENS ?>logo/logotipo1_principal.svg" class="w-50" alt="logotipo">
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2 text-center">Abra uma conta</h4>
            <p class="mb-4 text-center">Gerencie um posto com a sua conta</p>

            <form id="form" class="mb-3">

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="username" class="form-label">Nome Completo <b class="cor-primario">*</b></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Digite o seu nome" autofocus />
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email <b class="cor-primario">*</b></label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Digite o seu e-mail" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone <b class="cor-primario">*</b></label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Digite o seu telefone" required />
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password <b class="cor-primario">*</b></label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                      <span class="input-group-text cursor-pointer border-p"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="pass" class="form-label">Número do passe <b class="cor-primario">*</b></label>
                    <input type="text" class="form-control" id="pass" name="pass" placeholder="Código ou número do passe" required maxlength="8" minlength="4" min="4" max="4" />
                  </div>
                </div>
              </div>
              <div class="resposta"></div>
              <button type="submit" class="btn f-primario text-white d-grid w-100">criar conta</button>
            </form>

            <p class="text-center">
              <span>Já tem uma conta?</span>
              <a href="./auth-login.php" class="cor-primario">
                <span>Faça login</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>

  <!-- Page JS -->
  <script>
    /* INSTRUÇÃO PARA REGISTRAR GESTORES */

    const divResposta = document.querySelector('.resposta')

    const formulario = document.querySelector('#form')

    formulario.addEventListener('submit', (e, dados) => { // ao submeter o formulário

      e.preventDefault() // remove a ação do formulário

      dados = new FormData(formulario) // capta os dados do formulário
      dados.append('acao', 'registrar-gestor')
      fetch('../../../Requests/requestAjax.php', { // envia os dados para uma página php
          body: dados, // Dados a serem enviados
          method: 'POST' // verbo ou metodo HTTP da requisição
        })
        .then(res => res.json()) // envia e espera uma resposta no formato json de dados
        .then(resposta => { // armazena os dados da resposta no objeto resposta
          if (resposta.status == 200) {
            divResposta.innerHTML = `<div class="alert alert-success text-center">${resposta.msg}</div>`
            setTimeout(() => {
              location.href = "./auth-login.php"
            }, 2000);
          } else {
            divResposta.innerHTML = `<div class="alert alert-danger">${resposta.msg}</div>`
          }
        })
        .catch(err => { // caso houver um erro

        })
    })
  </script>
</body>

</html>