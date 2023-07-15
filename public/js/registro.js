var url = location.href; //pega endereço que esta no navegador
url = url.split("/"); //quebra o endeço de acordo com a / (barra)


let pathAjax = `${window.location.protocol}//${url[2]}/PRSP/requestAjax.php`
let dominio = `${window.location.protocol}//${url[2]}/`

/* INSERIR DADOS DA BD */

/* AJAX RESPONSAVEL PARA O MESTO */

let preLoader =
    `
    <div class="spinner-border text-danger" role="status">
         <span class="visually-hidden">Loading...</span>
    </div>`

let respostaRegistro = document.querySelector('.respostas-auth')

let formRegistro = document.querySelector('#form-registro')
let formLogin = document.querySelector('#form-login')

// registro
formRegistro.addEventListener('submit', (e, dadosForm) => {
    e.preventDefault()
    dadosForm = new FormData(formRegistro)
    dadosForm.append('acao', 'registro-utente')

    respostaRegistro.innerHTML = preLoader

    fetch('./Requests/requestAjax.php', {
        method: 'POST', // Método da solicitação (GET, POST, PUT, DELETE, etc.)
        body: dadosForm,
    })
        .then(res => res.json())
        .then(datas => {
            // verifica os status
            setTimeout(() => {
                if (datas.status == 'sucesso') {
                    respostaRegistro.innerHTML = `<div class="border-0 alert alert-success">${datas.msg}</div>`
                } else {
                    respostaRegistro.innerHTML = `<div class="border-0 alert alert-danger">${datas.msg}</div>`
                }
            }, 1500);

        })
        .catch(err => { console.log(err) })

})

// Login
formLogin.addEventListener('submit', (e, dadosForm) => {
    e.preventDefault()
    dadosForm = new FormData(formLogin)
    dadosForm.append('acaoUtente', 'login-utente')

    respostaRegistro.innerHTML = preLoader

    fetch('./Requests/requestAjax.php', {
        method: 'POST', // Método da solicitação (GET, POST, PUT, DELETE, etc.)
        body: dadosForm,
    })
        .then(res => res.json())
        .then(datas => {
            // verifica os status
            setTimeout(() => {
                if (datas.status == 'sucesso') {
                    respostaRegistro.innerHTML = `<div class="border-0 alert alert-success">${datas.msg}</div>`
                } else {
                    respostaRegistro.innerHTML = `<div class="border-0 alert alert-danger">${datas.msg}</div>`
                }
            }, 1500);

        })
        .catch(err => { console.log(err) })

})