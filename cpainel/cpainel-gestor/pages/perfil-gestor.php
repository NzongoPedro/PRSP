   <!-- Content wrapper -->

   <style>
       input {
           box-shadow: none !important;
           border: #444 0.5px solid !important;
       }

       input:focus {
           box-shadow: none !important;
           border: #991F0C 1.5px solid !important;
       }

       input[type="phonenumber"] {
           border-top-left-radius: 0 !important;
           border-bottom-left-radius: 0 !important;
       }

       .fp {
           background: #991F0C !important;
           color: #fff;
       }

       .hh {
           border: #991F0C 5px solid
       }
   </style>

   <div class="content-wrapper">
       <!-- Content -->

       <div class="container-xxl flex-grow-1 container-p-y">
           <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Conta /</span> perfil</h4>

           <div class="row">
               <div class="col-md-12">
                   <ul class="nav nav-pills flex-column flex-md-row mb-3">
                       <li class="nav-item">
                           <a class="nav-link" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Dados da conta</a>
                       </li>
                   </ul>
                   <div class="card mb-4">
                       <h5 class="card-header">Detalhes do perfil</h5>
                       <!-- Account -->
                       <div class="card-body">
                           <div class="d-flex align-items-start align-items-sm-center gap-4">
                               <img src="<?= $fotoGestor ?>" alt="user-avatar" class="d-block rounded-circle" height="100" width="100" id="uploadedAvatar" />
                               <div class="button-wrapper">
                                   <label for="inputFile" class="btn  fp me-2 mb-4" tabindex="0">
                                       <span class="d-none d-sm-block">Carregar foto</span>
                                       <i class="bx bx-upload d-block d-sm-none"></i>
                                       <input type="file" id="inputFile" class="account-file-input" hidden accept="image/png, image/jpeg, image/webp, image/jpeg" onchange="changeFoto(3)" />
                                   </label>
                                   <p class="text-muted mb-0">Fotos JPG, JPEG ou PNG</p>
                               </div>
                           </div>
                       </div>
                       <hr class="my-0" />
                       <div class="card-body">
                           <form id="formAccountSettings" method="POST">
                               <div class="row">
                                   <div class="mb-3 col-md-6">
                                       <label for="firstName" class="form-label">Nome</label>
                                       <input class="form-control" type="text" id="firstName" name="firstName" value="<?= explode(" ", $gestor->gestorNome)[0] ?>" autofocus />
                                   </div>
                                   <div class="mb-3 col-md-6">
                                       <label for="lastName" class="form-label">Sobrenome</label>
                                       <input class="form-control" type="text" name="lastName" id="lastName" value="<?= explode(" ", $gestor->gestorNome)[1] ?>" />
                                   </div>
                                   <div class="mb-3 col-md-6">
                                       <label for="email" class="form-label">E-mail</label>
                                       <input class="form-control" type="text" id="email" name="email" value="<?= $gestor->gestorEmail ?>" placeholder="john.doe@example.com" />
                                   </div>
                                   <div class="mb-3 col-md-6">
                                       <label for="organization" class="form-label">Posto</label>
                                       <input type="text" class="form-control" id="organization" name="organization" value="<?= (isset($posto->postoDesignacao) ? $posto->postoDesignacao : 'Não registrado') ?>" readonly disabled />
                                   </div>
                                   <div class="mb-3 col-md-6">
                                       <label class="form-label" for="phoneNumber">Telefone</label>
                                       <div class="input-group input-group-merge">
                                           <span class="input-group-text fp border-2 hh ">AO (+244)</span>
                                           <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="<?= $gestor->gestorTelefone ?>" />
                                       </div>
                                   </div>
                                   <div class="mb-3 col-md-6">
                                       <label for="zipCode" class="form-label">Nº. Passe</label>
                                       <input type="text" class="form-control" id="zipCode" name="zipCode" value="<?= $gestor->gestorDocs ?>" maxlength="8" readonly disabled />
                                   </div>

                                   <div class="mb-3 col-md-6">
                                       <label for="state" class="form-label">Cargo</label>
                                       <input class="form-control" type="text" id="state" name="state" placeholder="Gestor" readonly disabled />
                                   </div>

                                   <div class="mb-3 col-md-6">
                                       <label for="address" class="form-label">Localização</label>
                                       <input type="text" class="form-control" id="address" name="address" placeholder="Luanda Angola" readonly disabled />
                                   </div>
                               </div>
                               <div class="text-center resposta"></div>
                               <div class="mt-2">
                                   <button type="submit" class="btn fp me-2">Salvar alterações</button>
                                   <a href="./" class="btn btn-outline-secondary c">Cancelar</a>
                               </div>
                               <input type="hidden" name="id-gestor" value="<?= $gestor->idgestor ?>">
                           </form>
                       </div>
                       <!-- /Account -->
                   </div>
                   <div class="card d-none">
                       <h5 class="card-header">Delete Account</h5>
                       <div class="card-body">
                           <div class="mb-3 col-12 mb-0">
                               <div class="alert alert-warning">
                                   <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                   <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                               </div>
                           </div>
                           <form id="formAccountDeactivation" onsubmit="return false">
                               <div class="form-check mb-3">
                                   <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                                   <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                               </div>
                               <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- / Content -->

       <div class="content-backdrop fade"></div>
   </div>

   <div class="modal fade" id="modalErro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalErroLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header borde-0">
                   <h1 class="modal-title fs-3 text-white text-center" id="modalErroLabel">Alerta</h1>
                   <div class="modal-header">

                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
               </div>
               <div class="modal-body">
                   <div class="text-white h5 texto">

                   </div>
               </div>
           </div>
       </div>
   </div>

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
               formData.append('acao', 'altera-foto-gestor')
               formData.append('gestor', <?= $gestor->idgestor ?>)
               // Envia o arquivo para o servidor usando fetch
               fetch('../../../Requests/requestAjax.php', {
                       method: 'POST',
                       body: formData,
                   })
                   .then(response => response.json())
                   .then(data => {
                       // Lida com a resposta do servidor, se necessário
                       if (data.status == 200) {
                           $('#modalErro').modal('show')
                           texto.innerHTML = `<h5 Class="text-center text-success">Foto alterada</h5>`
                           setTimeout(() => {
                               location.reload()
                           }, 2000);
                       } else {
                           $('#modalErro').modal('show')
                           texto.innerHTML = `<h5 Class="text-center text-danger">Erro durante o processo</h5>`
                       }
                   })
                   .catch(error => {
                       console.error('Erro ao fazer upload: ', error);
                   });
           }
       });
   </script>

   <script>
       /* INSTRUÇÃO PARA Editar dados do gestor */

       const divResposta = document.querySelector('.resposta')

       const formulario = document.querySelector('#formAccountSettings')

       formulario.addEventListener('submit', (e, dados) => { // ao submeter o formulário

           e.preventDefault() // remove a ação do formulário

           dados = new FormData(formulario) // capta os dados do formulário
           dados.append('acao', 'editar-gestor')
           fetch('<?= ROUTE ?>Requests/requestAjax.php', { // envia os dados para uma página php
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


       // botão cancelar

       function reset() {

           
       }
   </script>