var url = location.href; //pega endereço que esta no navegador
url = url.split("/"); //quebra o endeço de acordo com a / (barra)


let pathAjax = `${window.location.protocol}//${url[2]}/PRSP/requestAjax.php`
let dominio = `${window.location.protocol}//${url[2]}/PRSP`

/* INSERIR DADOS DA BD */

/* AJAX RESPONSAVEL PARA O MESTO */

let preLoader =
    `<div class="d-flex justify-content-center text-danger">
        <div class="spinner-border" role="status" style="font-size:5px"></div>
    </div>`

let respostaRegistro = document.querySelector('.resposta-login')

let formLogin = document.querySelector('#form-login')

// Login Admin and login
formLogin.addEventListener('submit', (e, dadosForm) => {
    e.preventDefault()
    dadosForm = new FormData(formLogin)

    respostaRegistro.innerHTML = preLoader

    fetch('../../Requests/requestAjax.php', {
        method: 'POST', // Método da solicitação (GET, POST, PUT, DELETE, etc.)
        body: dadosForm,
    })
        .then(res => res.json())
        .then(datas => {
            // verifica os status
            setTimeout(() => {
                if (datas.status == 'sucesso') {
                    respostaRegistro.innerHTML = `<div class="border-0 alert alert-success">${datas.msg}</div>`
                    window.location.href = dominio + '/cpainel/cpainel-admin/?admPage=dashboard#dash'
                } else {
                    respostaRegistro.innerHTML = `<div class="border-0 alert alert-danger">${datas.msg}</div>`
                }
            }, 1500);

        })
        .catch(err => { console.log(err) })

})