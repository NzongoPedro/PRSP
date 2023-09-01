var url = location.href; //pega endereço que esta no navegador
url = url.split("/"); //quebra o endeço de acordo com a / (barra)

let pathAjax = `${window.location.protocol}//${url[2]}/PRSP/requestAjax.php`;
let dominio = `${window.location.protocol}//${url[2]}/PRSP`;

/* INSERIR DADOS DA BD */

/* AJAX RESPONSAVEL PARA O MESTO */

let preLoader = `
    <div class="spinner-border text-danger" role="status">
         <span class="visually-hidden">Loading...</span>
    </div>`;

let respostaEdicao = document.querySelector(".resposta-edicao");
let respostaEdicaoSenha = document.querySelector(".resposta-senha");

let form = document.querySelector("#form-dado-pessoais");
let formSenha = document.querySelector("#form-editar-senha");

// Editar Dados Utente
form.addEventListener("submit", (e, dadosForm) => {
  e.preventDefault();
  dadosForm = new FormData(form);
  dadosForm.append("acao", "editar-dados-utente");

  respostaEdicao.innerHTML = preLoader;

  fetch("./Requests/requestAjax.php", {
    method: "POST", // Método da solicitação (GET, POST, PUT, DELETE, etc.)
    body: dadosForm,
  })
    .then((res) => res.json())
    .then((datas) => {
      // verifica os status
      setTimeout(() => {
        if (datas.status == "sucesso") {
          respostaEdicao.innerHTML = `<div class="border-0 rounded-0 alert alert-success">${datas.msg}</div>`;
          window.location.reload();
        } else {
          respostaEdicao.innerHTML = `<div class="border-0 rounded-0 alert alert-danger">${datas.msg}</div>`;
        }
      }, 1500);
    })
    .catch((err) => {
      console.log(err);
    });
});

// Editar Senha Utente
formSenha.addEventListener("submit", (e, dadosForm) => {
  e.preventDefault();
  dadosForm = new FormData(formSenha);
  dadosForm.append("acao", "editar-senha-utente");

  respostaEdicaoSenha.innerHTML = preLoader;

  fetch("./Requests/requestAjax.php", {
    method: "POST", // Método da solicitação (GET, POST, PUT, DELETE, etc.)
    body: dadosForm,
  })
    .then((res) => res.json())
    .then((datas) => {
      // verifica os status
      setTimeout(() => {
        if (datas.status == "sucesso") {
          respostaEdicaoSenha.innerHTML = `<div class="border-0 rounded-0 alert alert-success">${datas.msg}</div>`;
          window.location.reload();
        } else {
          respostaEdicaoSenha.innerHTML = `<div class="border-0 rounded-0 alert alert-danger">${datas.msg}</div>`;
        }
      }, 1500);
    })
    .catch((err) => {
      console.log(err);
    });
});
