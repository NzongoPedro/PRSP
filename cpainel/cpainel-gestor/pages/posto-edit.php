 <?php
    if (isset($_SESSION['token-posto']) && isset($_SESSION['id-posto'])) : ?>
     <div class="content-wrapper">
         <!-- Content -->
         <div class="container-xxl flex-grow-1 container-p-y">
             <div class="demo-inline-spacing float-end">
                 <a href="./?gestorPage=posto-edit&id-posto=<?= $_SESSION['id-posto'] ?>" title="Editar dados" class="btn rounded-pill btn-icon btn-dark">
                     <span class="tf-icons bx bx-edit"></span>
                 </a>
             </div>
             <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Editar Dados</h4>

             <div class="row mb-5">
                 <div class="col-md col-lg-6 col-8">
                     <div class="card mb-3">
                         <div class="row g-0">
                             <!-- <div class="col-md-4">
                             <img class="card-img card-img-left" src="../assets/img/elements/12.jpg" alt="Card image" />
                         </div> -->
                             <div class="col">
                                 <div class="card-body">
                                     <h5 class="card-title">Dados atuais</h5>
                                     <h5 class="card-subtitle text-uppercase"><?= $posto->postoDesignacao ?></h5>
                                     <small class="text-muted"><?= $posto->categoriaPostoDesignacao ?></small>
                                     <div class="mb-1 p-2">
                                         <div>
                                             <span>
                                                 <i class='bx bx-envelope me-2'></i> adrress
                                             </span>
                                             <span class="float-end">
                                                 <?= ($posto->postoEmail) ?>
                                             </span>
                                         </div>
                                     </div>
                                     <div class="card-text">
                                         <div class="mb-1 p-2">
                                             <div>
                                                 <span>
                                                     <i class='bx bx-rss me-2'></i> Estado
                                                 </span>
                                                 <span class="float-end">
                                                     <?= ($posto->estadoPosto > 0 ? 'Activado' : 'Desativado') ?>
                                                 </span>
                                             </div>
                                         </div>
                                         <div class="mb-1 p-2">
                                             <div>
                                                 <span>
                                                     <i class='bx bx-map-pin me-2'></i>Localização
                                                 </span>
                                                 <span class="float-end">
                                                     <?= ($posto->postoMunicipio) ?>
                                                 </span>
                                             </div>
                                         </div>
                                         <div class="mb-1 p-2">
                                             <div>
                                                 <span>
                                                     <i class='bx bx-calendar me-2'></i>Criado em
                                                 </span>
                                                 <span class="float-end">
                                                     <?= ($posto->postoDataRegistro) ?>
                                                 </span>
                                             </div>
                                         </div>
                                         <div class="mb-1 p-2">
                                             <div>
                                                 <span>
                                                     <i class='bx bx-low-vision me-2'></i>Token
                                                 </span>
                                                 <span class="float-end">
                                                     <?= ($posto->token) ?>
                                                 </span>
                                             </div>
                                         </div>
                                         <?php
                                            if ($posto->idEstadoPosto <= 1) : ?>
                                             <div class="mb-1 p-2">
                                                 <div>
                                                     <span>
                                                         <i class='bx bx-check me-2'></i>Aprovado por
                                                     </span>
                                                     <span class="float-end">
                                                         ---
                                                     </span>
                                                 </div>
                                             </div>
                                         <?php else : ?>
                                             <div class="mb-1 p-2">
                                                 <div>
                                                     <span>
                                                         <i class='bx bx-check me-2'></i>Aprovado por
                                                     </span>
                                                     <span class="float-end">
                                                         <?= ($posto->admNome) ?>
                                                     </span>
                                                 </div>
                                             </div>

                                         <?php endif ?>

                                     </div>
                                     <p class="card-text mb-3 text-white"><small class="text-white">.</small></p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col">
                     <div class="card">
                         <div class="card-header">
                             Edição de dados
                         </div>
                         <div class="card-body">
                             <form id="formEditar">
                                 <div class="mb-1">
                                     <label for="nome" class="form-label">Nome</label>
                                     <input type="text" name="nomePosto" id="nome" class="form-control" placeholder="Digete um novo nome" aria-describedby="helpId" required>
                                 </div>
                                 <div class="mb-1">
                                     <label for="email" class="form-label">Email</label>
                                     <input type="email" name="emailPosto" id="email" class="form-control" placeholder="Digete um novo E-mail" aria-describedby="helpId" required>
                                 </div>
                                 <div class="mb-1">

                                     <div class="col mb-0">
                                         <div class="mb-1">
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
                                 </div>
                                 <div class="resposta">
                                     <p class="text-primary">
                                         Após a conclusão na edição dados, o seu posto voltará para o estado de <b>DESATIVAÇÃO.</b>
                                     </p>
                                 </div>
                                 <div class="mt-2 text-center">
                                     <button type="submit" class="btn btn-primary">Salvar dados </button>
                                 </div>
                                 <input type="hidden" name="id-posto" value="<?= $_SESSION['id-posto'] ?>">
                             </form>
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


         <div class="content-backdrop fade"></div>
     </div>
 <?php else : ?>
     <script>
         document.querySelector('title').innerHTML = "Gerenciamento de postos | PRSP"
         document.addEventListener("DOMContentLoaded", function() {
             var modal = new bootstrap.Modal(document.getElementById("modalToken"));
             modal.show();
         });
     </script>
 <?php endif ?>
 <!--Invocando a moda de postos -->

 <script>
     document.querySelector('title').innerHTML = "Gerenciamento de postos | PRSP"
 </script>

 <script>
     function extrairInformacoes() {

         var url = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.3262666072665!2d13.256975374713972!3d-8.849185190631907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a51f3dbbbb34d65%3A0xe3e16509bca00a1c!2s5%C2%AA%20Conservat%C3%B3ria%20de%20Luanda!5e0!3m2!1spt-PT!2sao!4v1693013449165!5m2!1spt-PT!2sao";

         // Use uma expressão regular para encontrar o bairro e o município na URL
         var regex = /\/(\w+)\!(\w+)\!(\w+)\/(\w+)\-(\w+)\!/;
         var matches = url.match(regex);

         if (matches && matches.length === 6) {
             var bairro = matches[4].replace(/%20/g, ' ');
             var municipio = matches[5].replace(/%20/g, ' ');
             alert("Bairro: " + bairro + "\nMunicípio: " + municipio);
         } else {
             // alert("Não foi possível extrair as informações.");
         }
     }
     extrairInformacoes()
 </script>

 <script>
     // salvar alterações
     const divResposta = document.querySelector('.resposta')

     const formulario = document.querySelector('#formEditar')

     formulario.addEventListener('submit', (e, dados) => { // ao submeter o formulário

         e.preventDefault() // remove a ação do formulário

         dados = new FormData(formulario) // capta os dados do formulário
         dados.append('acao', 'editar-posto')
         fetch('../../../Requests/requestAjax.php', { // envia os dados para uma página php
                 body: dados, // Dados a serem enviados
                 method: 'POST' // verbo ou metodo HTTP da requisição
             })
             .then(res => res.json()) // envia e espera uma resposta no formato json de dados
             .then(resposta => { // armazena os dados da resposta no objeto resposta
                 if (resposta.status == 200) {
                     divResposta.innerHTML = `<div class="alert alert-success text-center">${resposta.msg}</div>`
                     setTimeout(() => {
                         location.href = "./?gestorPage=posto"
                     }, 2000);
                 } else {
                     divResposta.innerHTML = `<div class="alert alert-danger">${resposta.msg}</div>`
                 }
             })
             .catch(err => { // caso houver um erro

             })

     })
 </script>