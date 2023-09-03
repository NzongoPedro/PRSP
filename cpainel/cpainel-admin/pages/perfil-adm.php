    <!-- TABLE POSTOS -->

    <div class="container" data-aos="fade-up" data-aos-transition="1000" data-aos-duration="500">
        <section class="mt-2" id="adm">
            <div class="row">
                <div class="col-5">
                    <div class="carta-1 card rounded-0 mb-3" data-aos="fade-in" data-aos-transition="2000" data-aos-durantion="2500">
                        <div class="card-header">
                            <span class="float-end">
                                <a href="#" class="bi bi-pen-fill text-dark m-2 edit" title="Editar dados"></a>
                            </span>
                            <h5 class="cor-primario">Dados de registro</h5>
                        </div>
                        <div class="card-body">

                            <div class="card-text">
                                <div class="alert alert-light shadow-sm mb-2 border-bottom">
                                    <i class="bi bi-person me-2 cor-primario"></i> Nome: <span class="float-end cor-primario"><?= $dadosAdm->admNome ?></span>
                                </div>
                                <div class="alert alert-light shadow-sm mb-2 border-bottom">
                                    <i class="bi bi-telephone me-2 cor-primario"></i> Telefone: <span class="float-end cor-primario"><?= $dadosAdm->admTelefone ?></span>
                                </div>
                                <div class="alert alert-light shadow-sm mb-2 border-bottom">
                                    <i class="bi bi-envelope me-2 cor-primario"></i> Email: <span class="float-end cor-primario"><?= $dadosAdm->admEmail ?></span>
                                </div>
                                <div class="alert alert-light shadow-sm mb-2 border-bottom">
                                    <i class="bi bi-chat me-2 cor-primario"></i> Nível: <span class="float-end cor-primario"><?= $dadosAdm->idNivelAcesso ?></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 form-1 d-none">
                    <div class="carta-1 card rounded-0 mb-3" data-aos="fade-in" data-aos-transition="2000" data-aos-durantion="2500">
                        <div class="card-header">
                            <h5 class="cor-primario">Editar dados</h5>
                        </div>
                        <div class="card-body">

                            <form action="#" id="formEdit">
                                <div class="form-group mb-3">
                                    <input type="text" name="nome" class="form-control form-control-lg" value="<?= $dadosAdm->admNome ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="tel" name="telefone" class="form-control form-control-lg" value="<?= $dadosAdm->admTelefone ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" name="email" class="form-control form-control-lg" value="<?= $dadosAdm->admEmail ?>">
                                </div>
                                <input type="hidden" name="adm" value="<?= $dadosAdm->idadministrador ?>">
                                <div class="resposta text-center"></div>
                                <div class="mb-3">
                                    <button class="btn btn-lg f-primario w-100">
                                        Salvar alterações
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-3 form-2 d-none">
                    <div class="card carta-1">
                        <div class="card-header">
                            <h5>Alterar foto de perfil</h5>
                        </div>
                        <div class="card-body">
                            <div class="texto text-center"></div>
                            <div class="w-25">
                                <input type="file" id="inputFile" name="imagem" class="fom-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- Fim table postos -->
    </div>


    <script>
        const divResposta = document.querySelector('.resposta')

        const formulario = document.querySelector('#formEdit')

        formulario.addEventListener('submit', (e, dados) => { // ao submeter o formulário

            e.preventDefault() // remove a ação do formulário

            dados = new FormData(formulario) // capta os dados do formulário
            dados.append('acao', 'edita-adm')
            fetch('<?= ROUTE ?>Requests/requestAjax.php ', { // envia os dados para uma página php
                    body: dados, // Dados a serem enviados
                    method: 'POST' // verbo ou metodo HTTP da requisição
                })
                .then(res => res.json()) // envia e espera uma resposta no formato json de dados
                .then(resposta => { // armazena os dados da resposta no objeto resposta
                    if (resposta.status == 200) {
                        divResposta.innerHTML = `<div class="alert alert-success text-center">${resposta.msg}</div>`
                        setTimeout(() => {
                            location.reload()
                        }, 2000);
                    } else {
                        divResposta.innerHTML = `<div class="alert alert-danger">${resposta.msg}</div>`
                    }
                })
                .catch(err => { // caso houver um erro

                })

        })

        let edit = document.querySelector('.edit')
        let foto1 = document.querySelector('.e-foto')

        edit.addEventListener('click', () => {
            document.querySelector('.form-1')
                .classList.toggle('d-none')
            document.querySelector('.form-2')
                .classList.toggle('d-none')
        })
    </script>

    <script>
        // alterar foto perfil

        // Adicione um evento 'change' ao elemento input file
        document.getElementById('inputFile').addEventListener('change', function(event) {
            const fileInput = event.target;
            const file = fileInput.files[0]; // Obtém o primeiro arquivo selecionado
            let texto = document.querySelector('.texto')
            if (file) {
                const formData = new FormData();
                formData.append('imagem', file); // 'imagem' é o nome do campo que você deseja no servidor
                formData.append('acao', 'altera-foto-adm')
                formData.append('adm', <?= $dadosAdm->idadministrador ?>)
                // Envia o arquivo para o servidor usando fetch
                fetch('<?= ROUTE ?>Requests/requestAjax.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Lida com a resposta do servidor, se necessário
                        if (data.status == 200) {
                            $('#modalErro').modal('show')
                            texto.innerHTML = `<h5 Class="text-center text-success">${data.msg}</h5>`
                            setTimeout(() => {
                                location.reload()
                            }, 2000);
                        } else {
                            // $('#modalErro').modal('show')
                            texto.innerHTML = `<h5 Class="text-center text-danger">${data.msg}</h5>`
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao fazer upload: ', error);
                    });
            }
        });
    </script>