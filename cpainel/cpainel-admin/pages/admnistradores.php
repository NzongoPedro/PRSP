    <!-- Gerenciando adm -->
    <div class="container">
        <section class="mt-2 mb-3" id="adm">
            <div class="carta-1 card rounded-0" data-aos="fade-in" data-aos-transition="2000" data-aos-durantion="2500">
                <div class="card-body">
                    <h5 class="card-title titulo-page">Gerenciar adm</h5>
                </div>
            </div>
        </section><!-- Fim ADM -->
        <!-- Linha de dados -->

        <section class="adms disabled">

            <div class="carta-1 card rounded-0" data-aos="fade-in" data-aos-transition="2000" data-aos-durantion="2500">
                <div class="card-body">

                    <div class="row">
                        <?php
                        if ($dadosAdm->idNivelAcesso <= 1) : ?>

                            <div class="col-4">
                                <h5 class="card-title titulo-page">Cadastrar ADM</h5>
                                <form action="" id="formAdm">
                                    <div class="mb-2">
                                        <input type="text" name="nome" class="form-control" id="floatingInputName" placeholder="Nome completo">
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <input type="tel" name="telefone" class="form-control" id="floatingInputTelefone" placeholder="9xx xxx xxx">
                                        </div>
                                        <div class="col-md mb-2">
                                            <div class="form-floatings">
                                                <select name="nivel" class="form-control form-select-md" id="floatingSelectGrid">
                                                    <option selected>Selecione um nível</option>
                                                    <option value="1">Nível 1</option>
                                                    <option value="2">Nível 2</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="E-mail">
                                    </div>

                                    <div class="form-floatig mb-2">
                                        <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Palavra.passe">
                                    </div>
                                    <div class="resposta text-center"></div>
                                    <div class="text-center mt-3">
                                        <input type="submit" class="btn btn-lg f-primario w-100" value="Criar conta">
                                    </div>
                                </form>
                            </div>
                        <?php endif ?>

                        <div class="col">
                            <div class="table-responsive">
                                <h5 class="card-title titulo-page">Administradores</h5>
                                <table class="table light datatable">
                                    <thead>
                                        <tr>
                                            <th>#ID </th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">Nivel</th>
                                            <th>ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dados_adm as $adm) { ?>
                                            <tr class="">
                                                <td><?= $adm->idadministrador ?></td>
                                                <td scope="row"><?= $adm->admNome ?></td>
                                                <td><?= $adm->admTelefone ?></td>
                                                <td><?= $adm->admEmail ?></td>
                                                <td><?= $adm->idNivelAcesso ?></td>
                                                <td>----</td>
                                            </tr>
                                        <?php  } ?>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    <script>
        const divResposta = document.querySelector('.resposta')

        const formulario = document.querySelector('#formAdm')

        formulario.addEventListener('submit', (e, dados) => { // ao submeter o formulário

            e.preventDefault() // remove a ação do formulário

            dados = new FormData(formulario) // capta os dados do formulário
            dados.append('acao', 'cadastra-adm')
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
    </script>