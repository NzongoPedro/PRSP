<nav class="navbar fixed-top navegacao">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Offcanvdas navbar</a>
    <button class="navbar-toggler icon-btn rounded-0 border-0 rounded-circle shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="bi bi-list"></span>
    </button>
    <div class="offcanvas menu custom-effect " data-bs-backdrop="static" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header f-primario">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
          <i class="bi bi-person-fill me-4"></i>
          Nome Utente
        </h5>
        <a href="#" class="btn-close text-light" data-bs-dismiss="offcanvas" aria-label="Close"></a>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= ROUTE ?>home">
              <i class="bi bi-house-fill me-4"></i>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ROUTE ?>postos">
              <i class="bi bi-geo-fill me-4"></i>
              Postos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-file-text-fill me-4"></i>
              Catalógos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ROUTE ?>login">
              <i class="bi bi-lock-fill me-4"></i>
              Login/Cadastro
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-question-circle-fill me-4"></i>
              Ajuda
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-power me-4"></i>
              Sair
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>