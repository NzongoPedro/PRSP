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
            <form action="" class="form-1" id="form-registro">
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
                        <input type="mail" name="utenteEmail" class="form-control form-control-lg" placeholder="Seu E-mail" aria-label="e-mail" aria-describedby="addon-wrapping" required>
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
                <div class="respostas-auth text-center">
                </div>
                <div class="mt-3 mb-3 text-center">
                    <button class="btn btn-lg w-100 btn-warning rounded-0">Criar conta</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="mt-3 mb-3 text-center">
    <span class="text-center text-danger">
        <b> já tem uma conta?</b>
    </span>
    <br>
    <span class="text-warning">
        <a href="<?= ROUTE ?>?page=login" class="nav-link"> Login</a>
    </span>
</div>

<style>
    footer,
    .navegacao {
        display: none !important;
    }
</style>

<!-- SCRIPT REGISTRO JS -->
<script src="<?= JS ?>registro.js"></script>
<script>
    const form = document.querySelector('.form-1');
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    var form1 = document.getElementById('form-registro');

    // Ajusta a posição da janela quando um campo recebe foco
    form1.addEventListener('focusin', function(event) {
        var targetElement = event.target;

        // Ajusta a posição da janela para que o campo seja visível
        window.scrollTo({
            top: targetElement.offsetTop - 20,
            behavior: 'smooth'
        });
    });
</script>