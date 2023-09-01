<?php

use App\controller\utentescontroller as utentes;

if ($idUtente) :
  // Grava dos dados do Utente num vetor de dados
  $dadosUtente = utentes::mostraDadosUtente($idUtente);
endif
?>
<nav class="navbar fixed-top navegacao">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="<?= ROUTE ?>storage/image/logo/logotipo1_principal.png" alt="logotipo" class="imf-fluid" style="width: 170px; height:60px; max-width:100%">
    </a>
    <button class="navbar-toggler icon-btn rounded-0 border-0 rounded-circle shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="bi bi-list"></span>
    </button>
    <div class="offcanvas menu custom-effect " data-bs-backdrop="static" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header f-primario">
        <?php
        // exibe o nome do utente autenticado
        if ($idUtente) : ?>
          <h5 class="offcanvas-title text-uppercase" id="offcanvasNavbarLabel">
            <a href="<?= ROUTE ?>?page=perfil-utente" class="nav-link">
              <i class="bi bi-person-fill me-4"></i>
              <?= explode(' ', $dadosUtente->utenteNome)[0] ?>
            </a>
          </h5>

        <?php endif;
        ?>
        <a href="#" class="btn-close text-light" data-bs-dismiss="offcanvas" aria-label="Close"></a>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= ROUTE ?>?page=home">
              <i class="bi bi-house-fill me-4"></i>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ROUTE ?>?page=postos">
              <i class="bi bi-geo-fill me-4"></i>
              Postos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ROUTE ?>?page=solicitar">
              <i class="bi bi-bar-chart-steps me-4"></i>
              Reservar Lugar
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-file-text-fill me-4"></i>
              Catalógos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-question-circle-fill me-4"></i>
              Ajuda
            </a>
          </li>
          <?php
          // exibe o auth caso não estiver com sessão iniciada
          if (!$idUtente) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= ROUTE ?>?page=login">
                <i class="bi bi-lock-fill me-4"></i>
                Login/Cadastro
              </a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= ROUTE ?>?page=sair">
                <i class="bi bi-power me-4"></i>
                Sair
              </a>
            </li>
          <?php endif;
          ?>
        </ul>
      </div>
    </div>
  </div>
</nav>