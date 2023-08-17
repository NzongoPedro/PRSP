 <div class="content-wrapper">
     <!-- Content -->
     <div class="container-xxl flex-grow-1 container-p-y">
         <div class="demo-inline-spacing float-end">
             <button type="button" class="btn rounded-pill btn-icon btn-dark" data-bs-toggle="modal" data-bs-target="#modalPostoNovo" id="btnModal">
                 <span class="tf-icons bx bx-plus"></span>
             </button>
             <button type="button" class="btn rounded-pill btn-icon btn-dark">
                 <span class="tf-icons bx bx-edit"></span>
             </button>
             <button type="button" class="btn rounded-pill btn-icon btn-dark"">
                 <span class=" tf-icons bx bx-trash"></span>
             </button>
         </div>
         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Posto</h4>

         <div class="row mb-5">
             <div class="col-md col-lg-8 col-8">
                 <div class="card mb-3">
                     <div class="row g-0">
                         <!-- <div class="col-md-4">
                             <img class="card-img card-img-left" src="../assets/img/elements/12.jpg" alt="Card image" />
                         </div> -->
                         <div class="col">
                             <div class="card-body">
                                 <h5 class="card-title text-uppercase"><?= $posto->postoDesignacao ?></h5>
                                 <small class="text-muted"><?= $posto->categoriaPostoDesignacao ?></small>
                                 <div class="mb-1 p-2">
                                     <div>
                                         <span>
                                             <i class='bx bx-envelope me-2'></i> Email
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
                                 </div>
                                 <p class="card-text mb-3 text-white"><small class="text-white">.</small></p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4">
                 <div class="row">
                     <div class="col-6 mb-4">
                         <div class="card">
                             <div class="card-body">
                                 <div class="card-title d-flex align-items-start justify-content-between">
                                     <div class="avatar flex-shrink-0">
                                         <i class="bx bx-list-ul bx-border-circle bx-sm"></i>
                                     </div>
                                 </div>
                                 <span class="fw-semibold d-block mb-1">Serviços</span>
                                 <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                                 <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
                             </div>
                         </div>
                     </div>
                     <div class="col-6 mb-4">
                         <div class="card">
                             <div class="card-body">
                                 <div class="card-title d-flex align-items-start justify-content-between">
                                     <div class="avatar flex-shrink-0">
                                         <i class="bx bx-user-plus bx-border-circle bx-sm"></i>
                                     </div>
                                 </div>
                                 <span class="fw-semibold d-block mb-1">Solicitações</span>
                                 <h3 class="card-title mb-2">$14,857</h3>
                                 <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
                             </div>
                         </div>
                     </div>
                     <div class="col-6 mb-4">
                         <div class="card">
                             <div class="card-body">
                                 <div class="card-title d-flex align-items-start justify-content-between">
                                     <div class="avatar flex-shrink-0">
                                         <i class="bx bx-file bx-border-circle bx-sm"></i>
                                     </div>
                                 </div>
                                 <span class="fw-semibold d-block mb-1">Comprovativos</span>
                                 <h3 class="card-title mb-2">$14,857</h3>
                                 <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
                             </div>
                         </div>
                     </div>
                     <div class="col-6 mb-4">
                         <div class="card">
                             <div class="card-body">
                                 <div class="card-title d-flex align-items-start justify-content-between">
                                     <div class="avatar flex-shrink-0">
                                         <i class="bx bx-archive bx-border-circle bx-sm"></i>
                                     </div>
                                 </div>
                                 <span class="fw-semibold d-block mb-1">Relatórios</span>
                                 <h3 class="card-title mb-2">$14,857</h3>
                                 <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
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


     <div class="content-backdrop fade"></div>
 </div>

 <!--Invocando a moda de postos -->
 <?php require_once '../components/ModalNovoPosto.php'; ?>
 <script>
     document.querySelector('title').innerHTML = "Gerenciamento de postos | PRSP"
     /* document.addEventListener("DOMContentLoaded", function() {
         var modal = new bootstrap.Modal(document.getElementById("modalPostoNovo"));
         modal.show();
     }); 

     /* INSTRUÇÃO PARA REGISTRAR Posto */

     const divResposta = document.querySelector('.resposta')

     const formulario = document.querySelector('#form')

     formulario.addEventListener('submit', (e, dados) => { // ao submeter o formulário

         e.preventDefault() // remove a ação do formulário

         dados = new FormData(formulario) // capta os dados do formulário
         dados.append('acao', 'registrar-posto')
         fetch('../../../Requests/requestAjax.php', { // envia os dados para uma página php
                 body: dados, // Dados a serem enviados
                 method: 'POST' // verbo ou metodo HTTP da requisição
             })
             .then(res => res.json()) // envia e espera uma resposta no formato json de dados
             .then(resposta => { // armazena os dados da resposta no objeto resposta
                 if (resposta.status == 200) {
                     divResposta.innerHTML = `<div class="alert alert-success text-center">${resposta.msg}</div>`
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
         document.querySelector('input[name=token]').value = randomCode
     })
     // Função para obter a localização atual do usuário
     /*    function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        } */

     /*     // Função para exibir as coordenadas da localização atual
         function showPosition(position) {
             const latitude = position.coords.latitude;
             const longitude = position.coords.longitude;

             // Criar objeto Geocoder do Google Maps
             const geocoder = new google.maps.Geocoder();

             // Converter coordenadas em informações de localização
             const latlng = new google.maps.LatLng(latitude, longitude);
             geocoder.geocode({
                 location: latlng
             }, (results, status) => {
                 if (status === "OK" && results[0]) {
                     const addressComponents = results[0].address_components;

                     // Procurar por tipo "locality" para obter o nome do município
                     for (const component of addressComponents) {
                         if (component.types.includes("locality")) {
                             const municipality = component.long_name;
                             console.log("Município:", municipality);
                             break;
                         }
                     }
                 } else {
                     console.log("Geocoder failed due to:", status);
                 }
             });
         }

         // Chamar a função para obter a localização atual do usuário
         getCurrentLocation(); */
 </script>