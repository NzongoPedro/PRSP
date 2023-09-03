<!-- Modal -->
<div class="modal fade" id="modalPostoNovo" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="form">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPostoNovoTitle">Adicionar Posto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="m-auto">
                    <P class="alert alert-dark">
                        <span><b>token:</b> <b class="text-danger token"></b></span>
                        <br>
                        Copie e anote o seu token num local seguro.
                    </P>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Identificação do posto</label>
                        <input type="text" name="nomePosto" id="nomePosto" class="form-control border-p" placeholder="Escreva o nome exato do posto" autocomplete="off" required />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailBackdrop" class="form-label">E-mail</label>
                        <input type="text" name="emailPosto" id="emailPosto" class="form-control border-p" placeholder="xxxx@xxx.xx" autocomplete="off" required />
                    </div>
                    <div class="col mb-0">
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Categoria</label>
                            <select class="form-select" name="categoriaPosto" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option selected>Escolha a categoria</option>
                                <option value="1">Conservatória</option>
                                <option value="2">Notário</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-0">
                        <div class="mb-3">
                            <label for="exampleFormControlSelect2" class="form-label">Município</label>
                            <select class="form-select" name="municipioPosto" id="exampleFormControlSelect2" aria-label="Default select example">
                                <option selected>Escolha o município</option>
                                <option>Belas</option>
                                <option>Cacuaco</option>
                                <option>Cazenga</option>
                                <option>Luanda</option>
                                <option>Viana</option>
                            </select>
                        </div>
                    </div>
                    <div class="col -mb-3">
                        <label for="html5-url-input" class="col-form-label">Link de localização</label>
                        <input class="form-control border-p" name="linkPosto" type="url" value="https://themeselection.com" id="html5-url-input" autocomplete="off" required />
                    </div>
                </div>
            </div>
            <input type="hidden" name="id-gestor" value="<?= $id_gestor ?>">
            <input type="hidden" name="tokenName" value="">
            <div class="text-center resposta container"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-danger">Adicionar</button>
            </div>
        </form>
    </div>
</div>

<script>
    const divResposta = document.querySelector('.resposta')

    const formulario = document.querySelector('#form')

    formulario.addEventListener('submit', (e, dados) => { // ao submeter o formulário

        e.preventDefault() // remove a ação do formulário

        dados = new FormData(formulario) // capta os dados do formulário
        dados.append('acao', 'registrar-posto')
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

    /* GERAR O TOKEN DE ACESSO */

    function generateRandomCode() {
        function generateRandomChars(length, chars) {
            let result = "";
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * chars.length);
                result += chars[randomIndex];
            }
            return result;
        }

        const numbers = "0123456789";
        const uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const lowercaseLetters = "abcdefghijklmnopqrstuvwxyz";

        const randomNumbers = generateRandomChars(4, numbers);
        const randomUppercaseLetters = generateRandomChars(4, uppercaseLetters);
        const randomLowercaseLetters = generateRandomChars(4, lowercaseLetters);

        const combinedRandomChars = randomNumbers + randomUppercaseLetters + randomLowercaseLetters;

        // Shuffle the characters to ensure randomness
        const shuffledCode = combinedRandomChars.split("").sort(() => 0.5 - Math.random()).join("");

        return shuffledCode;
    }

    let randomCode = "";

    setInterval(() => {
        randomCode = generateRandomCode()
    }, 500);
    document.querySelector('#btnModal').addEventListener('click', () => {
        document.querySelector('.token').innerHTML = randomCode
        document.querySelector('input[name=tokenName]').value = randomCode
    })
</script>