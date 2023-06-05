<nav class="navbar fixed-top mb-5 nav-2">
    <div class="container-fluid">
        <button class="btn icon-btn rounded-circle" type="button" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </button>
        <h5 class="titulo">Notórios e Conservatórias</h5>
    </div>
</nav>

<br><br>
<main class="mt-5">
    <section class="container">
        <div class="m-2 bg-white">
            <div class="float-start">
                <a href="#" class="nav-item">Tudo</a>
                <a href="#" class="nav-item">Cons.</a>
                <a href="#" class="nav-item">Not</a>
            </div>
            <div class="float-end">
                <div class="form-group">
                    <input type="text" class="form-control form-control-sm bg-transparent rounded-5 h-25" placeholder="Pesquise um local">
                </div>
            </div>
        </div>
        <br>
        <hr>
        <div class="row mt-2">
            <div class="col">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= IMAGENS ?>postos/p1.jpg" class="img-fluid rounded-start foto-posto">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title posto-nome">Nome Poste</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
</main>
<br><br><br><br><br><br><br><br>
<script>
    document.querySelector('.navegacao').classList.add('d-none')
</s