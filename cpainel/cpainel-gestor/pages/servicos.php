 <div class="content-wrapper">
     <!-- Content -->
     <div class="container-xxl flex-grow-1 container-p-y">
         <div class="demo-inline-spacing float-end">
             <button type="button" class="btn rounded-pill btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#modalServico" id="btnModal">
                 <span class="tf-icons bx bx-plus"></span>
             </button>

         </div>
         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Serviços</h4>

         <div class="row mb-5">
             <div class="col-md-12 col-lg-12 col-12">
                 <div class="card mb-3">
                     <div class="row g-0">
                         <!-- <div class="col-md-4">
                             <img class="card-img card-img-left" src="../assets/img/elements/12.jpg" alt="Card image" />
                         </div> -->
                         <div class="col">
                             <div class="card-body">
                                 <h5 class="card-title text-uppercase">Lista de serviços</h5>
                                 <small class="text-muted">Clique ém um serviço para ver detalhes</small>

                                 <!-- <div class="row mt-5">
                                     <div class="col-3">
                                         <div class="alert alert-light shadow-sm cursor-pointer border-danger border-1">
                                             <div class="text-start">
                                                 <i class="bx bx-book bx-sm bx-border-circle me-2 text-danger border-danger border-1"></i>
                                                 <span class="text-danger text-truncate d-inline">Nome do serviço vai</span>
                                             </div>
                                         </div>
                                     </div>
                                 </div> -->
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
         <!--/ Content types -->


     </div>
     <!-- / Content -->

     <!-- Footer -->
     <?php require '../pages/footer.php'; ?>
     <!-- / Footer -->
     <?php require_once '../components/ModalNovoServico.php'; ?>
     <div class="content-backdrop fade"></div>
 </div>
 <script>
     document.querySelector('title').innerHTML = "Gerenciamento de postos | PRSP"
     //  document.addEventListener("DOMContentLoaded", function() {
     //      var modal = new bootstrap.Modal(document.getElementById("modalServico"));
     //      modal.show();
     //  });

     /* INSTRUÇÃO PARA REGISTRAR Posto */

     const divResposta = document.querySelector('.resposta')

     const formulario = document.querySelector('#form')

     formulario.addEventListener('submit', (e, dados) => { // ao submeter o formulário

         e.preventDefault() // remove a ação do formulário

         dados = new FormData(formulario) // capta os dados do formulário
         dados.append('acao', 'registrar-servico-posto')
         fetch('../../../Requests/requestAjax.php', { // envia os dados para uma página php
                 body: dados, // Dados a serem enviados
                 method: 'POST' // verbo ou metodo HTTP da requisição
             })
             .then(res => res.json()) // envia e espera uma resposta no formato json de dados
             .then(resposta => { // armazena os dados da resposta no objeto resposta
                 if (resposta.status == 200) {
                     divResposta.innerHTML = `<div class="alert alert-success text-center">${resposta.msg}</div>`
                     setTimeout(() => {
                         formulario.reset()
                         divResposta.innerHTML = ""
                         location.reload()
                     }, 5000);
                 } else {
                     divResposta.innerHTML = `<div class="alert alert-danger">${resposta.msg}</div>`
                     setTimeout(() => {
                         divResposta.innerHTML = ""
                     }, 3000);
                 }
             })
             .catch(err => { // caso houver um erro
                 divResposta.innerHTML = `<div class="alert alert-danger">${err}</div>`
             })

     })
 </script>