<link rel="stylesheet" href="<?= CSS ?>login.css">

<nav class="navbar fixed-top f-primario">
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
                    Nome utente
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
    <div class=" conta container info-auth" data-aos="fade-up" data-aos-duration="1500">
        <br><br>
        <h2 class="auth-title mt-3">PRSP</h2>
        <p>crie uma conta e faça reservas de lugar a partir de casa.</p>
    </div>
</div>
<br>
<div class="container">
    <div class="card form-login border-0" data-aos="fade-up" data-aos-duration="2500">
        <div class="card-dbody">
            <form action="" class="form-1">
                <!--  <h5 class="card-title">Crie um conta</h5> -->
                <div class="form-group mb-2">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text rounded-0" id="addon-wrapping">
                            <i class="bi bi-person-plus-fill"></i>
                        </span>
                        <input type="text" name="utenteNome" class="form-control form-control-lg" placeholder="Nome completo" aria-label="nome" aria-describedby="addon-wrapping" required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text rounded-0" id="addon-wrapping">
                            <i class="bi bi-telephone-fill"></i>
                        </span>
                        <input type="text" name="utenteTelefone" class="form-control form-control-lg" placeholder="Telefone ou Whatsapp" aria-label="nome" aria-describedby="addon-wrapping" required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text rounded-0" id="addon-wrapping">
                            <i class="bi bi-envelope-fill"></i>
                        </span>
                        <input type="mail" name="utenteNome" class="form-control form-control-lg" placeholder="Seu E-mail" aria-label="e-mail" aria-describedby="addon-wrapping" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text rounded-0" id="addon-wrapping">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input type="password" name="utenteSenha" class="form-control form-control-lg" placeholder="Crie uma senha" aria-label="crie uma senha" aria-describedby="addon-wrapping" required>
                    </div>
                </div>
                <div class="mt-3 mb-3 text-center">
                    <button class="btn btn-lg w-100 btn-warning rounded-0">Criar conta</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="mt-3 mb-3 text-center">
    <span class="text-center text-light">
        <b> já tem uma conta?</b>
    </span>
    <br>
    <span class="text-warning">
        <a href="<?= ROUTE ?>login" class="nav-link"> Login</a>
    </span>
</div>

<style>
    footer, .navegacao {
        display: none !important;
    }
</style>

<script>
    const form = document.querySelector('.form-1');
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => input.value = '');
</script>