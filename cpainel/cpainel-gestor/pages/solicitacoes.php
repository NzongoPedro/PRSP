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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Solicitações de reservas</h4>

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Lista de reservas</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Serviço</th>
                                <th>Utente</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            foreach ($solicitacoes as $solicitacao) { ?>
                                <td></td>
                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong><?= $solicitacao->documentoDesignacao ?></strong>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="<?= $solicitacao->utenteNome ?>">
                                                <img src="<?= IMAGENS ?>admin/admin.png" alt="Avatar" class="rounded-circle" />
                                            </li>
                                        </ul>
                                    </td>
                                    <td>2023-08-12</td>
                                    <td>20H-30</td>
                                    <td><span class="badge bg-label-primary me-1 rounded-5">Pendente</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php  }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!--/ Basic Bootstrap Table -->


            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php require '../pages/footer.php'; ?>
            <!-- / Footer -->


            <div class="content-backdrop fade"></div>
        </div>
    </div>
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