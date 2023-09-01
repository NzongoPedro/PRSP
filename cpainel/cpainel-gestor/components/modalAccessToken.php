<!-- Modal -->
<div class="modal fade" id="modalToken" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTokenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header f-primario">
                <h1 class="modal-title fs-3 text-white" id="modalTokenLabel">Autorização de acesso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form id="formToken">
                    <div class="mb1">
                        <label for="" class="form-label">Token</label>
                        <input type="text" class="form-control form-control-lg rounded-0" name="token" aria-describedby="helpId" placeholder="Token de acesso: aGtLO79HHH" required>
                        <small id="helpId" class="form-text text-dark">
                            Insira o <b>TOKEN </b> do posto, o mesmo gerado durante o registro
                        </small>
                    </div>
                    <div class="respostaToken"></div>
                    <input type="hidden" name="id-posto" value="<?= $idposto ?>">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    /* INSTRUÇÃO PARA  */

    const divRespostaToken = document.querySelector('.respostaToken')

    const formularioToken = document.querySelector('#formToken')

    formularioToken.addEventListener('submit', (e, dados) => { // ao submeter o formulário

        e.preventDefault() // remove a ação do formulário

        dados = new FormData(formularioToken) // capta os dados do formulário
        dados.append('acao', 'acesso-token')
        fetch('<?= ROUTE ?>Requests/requestAjax.php', { // envia os dados para uma página php
                body: dados, // Dados a serem enviados
                method: 'POST' // verbo ou metodo HTTP da requisição
            })
            .then(res => res.json()) // envia e espera uma resposta no formato json de dados
            .then(resposta => { // armazena os dados da resposta no objeto resposta
                if (resposta.status == 200) {
                    divRespostaToken.innerHTML = `<div class="alert alert-success text-center">${resposta.msg}</div>`
                    setTimeout(() => {
                        formularioToken.reset()
                        divRespostaToken.innerHTML = ""
                        location.reload()
                    }, 2000);
                } else {
                    divRespostaToken.innerHTML = `<div class="alert alert-danger">${resposta.msg}</div>`
                    setTimeout(() => {
                        divRespostaToken.innerHTML = ""
                    }, 3000);
                }
            })
            .catch(err => { // caso houver um erro
                divRespostaToken.innerHTML = `<div class="alert alert-danger">${err}</div>`
            })

    })
</script>