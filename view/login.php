<link rel="stylesheet" href="<?= CSS ?>login.css">

<nav class="navbar fixed-top navegacao">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="#!" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <span class="titulo">Autenticação</span>

        <!-- <button class="navbar-toggler icon-btn rounded-0 border-0 rounded-circle shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="bi bi-list"></span>
        </button> -->
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
<div class="login">
    <br><br><br>
    <div class="mt-5 mb-5 container info-auth" data-aos="fade-up" data-aos-duration="1500">
        <div>
            <h2 class="auth-title">PRSP</h2>
            <p>Cumpra fila no conforto da casa</p>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="card form-login border-0" data-aos="fade-up" data-aos-duration="2500">
        <div class="card-body">
            <form action="" class="form-1">
                <h5 class="card-title">Entre na sua Conta</h5>
                <div class="form-group mb-2">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text rounded-0" id="addon-wrapping">
                            <i class="bi bi-envelope-fill"></i>
                        </span>
                        <input type="mail" class="form-control form-control-lg" placeholder="e-mail" aria-label="e-mail" aria-describedby="addon-wrapping" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text rounded-0" id="addon-wrapping">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input type="password" class="form-control form-control-lg" placeholder="palavra-passe" aria-label="palavra-passe" aria-describedby="addon-wrapping" required>
                    </div>
                </div>
                <div class="mt-2 mb-2">
                    <span>esqueci a senha</span>
                </div>
                <div class="mt-3 mb-3 text-center">
                    <button class="btn btn-lg btn-primario w-75 rounded-5">ENTRAR</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="mt-5 text-center">
    <span class="text-center text-light">
        <b> Não tem uma conta?</b>
    </span>
    <br>
    <span class="text-warning">Login</span>
</div>

<style>
    footer {
        display: none !important;
    }
</style>

<script>
    const form = document.querySelector('.form-1');
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => input.value = '');
</script>