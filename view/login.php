<link rel="stylesheet" href="<?= CSS ?>login.css">
<?php
// chama a class de auth
require_once './Auth/checkSessionUtente.php';
// executa o método de autorização
print $auth->checkAccess();
?>
<nav class="navbar fixed-top f-primario">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="#!" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <span class="titulo">Autenticação</span>
    </div>
</nav>
<div class="login">
    <br><br><br>
    <div class="mt-1 mb-1 container info-auth" data-aos="fade-up" data-aos-duration="1500">
        <div>
            <h2 class="auth-title">PRSP </h2>
            <p>Cumpra fila no conforto da casa</p>
        </div>
    </div>
</div>
<br>
<div class="container b">
    <div class="card form-login border-0" data-aos="fade-up" data-aos-duration="2500">
        <div class="card-bbody">
            <form action="" class="form-1" id="form-login">
                <h5 class="card-title">Entre na sua Conta</h5>
                <div class="form-group mb-2">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text rounded-0" id="addon-wrapping">
                            <i class="bi bi-envelope-fill"></i>
                        </span>
                        <input type="mail" name="utenteEmail" class="form-control form-control-lg" placeholder="e-mail" aria-label="e-mail" aria-describedby="addon-wrapping" required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text rounded-0" id="addon-wrapping">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input type="password" name="utenteSenha" class="form-control form-control-lg" placeholder="palavra-passe" aria-label="palavra-passe" aria-describedby="addon-wrapping" required>
                    </div>
                </div>
                <div class="mt-2 mb-2">
                    <a href="#" class="text-danger ms-1 nav-link">Esqueci a senha</a>
                </div>
                <div class="respostas-auth text-center">
                </div>
                <div class="mt-1 mb-3 text-center">
                    <button class="btn btn-lg btn-primario w-75 rounded-5">ENTRAR</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="mt-2 text-center">
    <span class="text-center text-light">
        <b> Não tem uma conta?</b>
    </span>
    <br>
    <span class="text-warning">
        <a href="<?= ROUTE ?>?page=registro" class="nav-link">Registrar-se</a>
    </span>
</div>

<style>
    footer,
    .navegacao {
        display: none !important;
    }
</style>
<script>
    const form = document.querySelector('.form-1');
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => input.value = '');
</script>
<script src="<?= JS ?>login.js"></script>