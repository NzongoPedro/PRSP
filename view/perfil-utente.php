<link rel="stylesheet" href="<?= CSS ?>perfil.css">

<?php

use App\controller\utentesController as utentes;
use App\controller\ServicosController as servicos;
use App\Model\Servicos as comprovativo;

// chama a class de auth
require_once './Auth/checkSessionUtente.php';
// executa o método #1 de autorização
$idUtente = $auth->checkSEssion();
if ($idUtente) :

    // Grava dos dados do Utente num vetor de dados
    $dadosUtente = utentes::mostraDadosUtente($idUtente);

    //Grava os dados da reserva desse utente
    $reservas = servicos::show($idUtente);

    // comprovativo
    $comprovativo = comprovativo::verificaComprovativo($idUtente);
    $comprovativos = comprovativo::listaComprovativo($idUtente);

endif
?>
<nav class="navbar fixed-top p-2 bg-dark">
    <div class="container-fluid">
        <a class="icon-voltar rounded-circle" href="./" onclick=" history.go(-1);">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <span class="titulo"><?= $dadosUtente->utenteNome ?></span>
    </div>
</nav>
<!-- Section Cover (Capa) -->
<section>
    <div class="perfil-capa shadow-sm"></div>
    <div class="perfil-foto-utente" data-aos="fade-up" data-aos-transition="500" data-aos-duration="1000">
        <img src=" <?= IMAGENS ?>admin/admin.png" class="foto shadow-sm img-fluid" lazy>
    </div>
    <div class="menu-nav container">
        <a href="<?= ROUTE ?>?page=perfil-utente&view=reservas">
            <i class="bi bi-file-text-fill"></i>
            reservas
        </a>
        <a href="<?= ROUTE ?>?page=perfil-utente&view=dados">
            <i class="bi bi-file-person-fill"></i>
            Dados
        </a>
        <a href="<?= ROUTE ?>?page=perfil-utente&view=comprovativos">
            <i class="bi bi-file-pdf-fill"></i>
            Comprovativo
        </a>
        <a href="<?= ROUTE ?>?page=sair">
            <i class="bi bi-door-open-fill"></i>
            Sair
        </a>
    </div>
    <hr>

</section>
<!-- Fim seccção foto de capa -->

<?php
// alternando a vista de conteúdo de usuários
if (isset($_GET['view'])) {
    $page = filter_input(INPUT_GET, 'view');
    switch ($page) {
        case 'reservas': ?>
            <!-- Redervas -->
            <section class="reservas container">
                <h5 class="titulos">Minhas reservas</h5>
                <div class="mt-3 mb-3"></div>
                <div class="card-group">
                    <div class="row">
                        <?php

                        $btnGerarPdf = "";
                        foreach ($reservas as $reserva) {
                            $statusClasse = 'warning';
                            if ($reserva->estadoSolicitacao == "recusado") {
                                $statusClasse = 'danger';
                            }
                            if ($reserva->estadoSolicitacao == "aprovado") {
                                $statusClasse = 'success';
                                if ($comprovativo) {
                                    $btnGerarPdf = '<a href="' . ROUTE . 'comprovativo.php?id-comprovativo=' . $comprovativo . '" class="text-danger btn btn-sm">
                                     <i class="bi bi-file-earmark-pdf"></i>
                                    </a>';
                                }
                            } ?>

                            <div class="col-12 mb-3">
                                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-easing="ease" data-aos-duration="1000" data-aos-transition="500">
                                    <div class="card-body">
                                        <h5 class="nome-doc"><?= $reserva->documentoDesignacao ?></h5>
                                        <p class="card-text">
                                            <b>Estado:</b> <b class="text-<?= $statusClasse ?>"><?= $reserva->estadoSolicitacao ?></b>
                                            <br>
                                            <b>Local:</b> <?= $reserva->postoDesignacao ?>
                                        </p>
                                    </div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h6 class="accordion-header text-center mb-2">
                                                <a href="#!" class=" text-danger  accordion-button border-0 text-decoration-none nav-link collapsed text-center" data-bs-toggle="collapse" data-bs-target="#flush<?= $reserva->idsolicitacao_reserva ?>" aria-expanded="false" aria-controls="flush<?= $reserva->idsolicitacao_reserva ?>" onclick="leftTime(<?= $reserva->idsolicitacao_reserva ?>, '<?= $reserva->solicitacaoReservaData ?>', '<?= $reserva->solicitacaoReservaHora ?>')">
                                                    Ver mais informações
                                                </a>
                                            </h6>
                                            <div id="flush<?= $reserva->idsolicitacao_reserva ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="acordos">
                                                        <span class="text-muted">Preço: <b class="float-end"><?= $reserva->documentoPreco ?> Kz</b></span>
                                                        <span class="text-muted">Duração: <b class="float-end"><?= $reserva->documentoTempoDuracao ?></b></span>
                                                        <span class="text-muted">Validade: <b class="float-end"><?= $reserva->documentoDataValidade ?></b></span>
                                                    </div>
                                                    <h5 class="text-center">Requisitos Necessários</h5>
                                                    <div class="alert alert-warning rounded-0">
                                                        <small><?= html_entity_decode($reserva->documentoRequisitos) ?></small>
                                                    </div>
                                                    <div class="">
                                                        <div class="alert alert-success contagem-<?= $reserva->idsolicitacao_reserva ?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <small class="cor-primaria text-dark">
                                            <i class="bi bi-calendar me-2"></i>
                                            <?= $reserva->solicitacaoReservaData ?> | <i class="bi bi-clock me-2"></i><?= $reserva->solicitacaoReservaHora ?>
                                        </small>
                                        <div class="icon-acao">
                                            <a href="#!" class="bi bi-trash h5" data-bs-toggle="modal" data-bs-target="#modalEliminar" onclick="confirmaEliminacaoReserva()"></a>
                                            <?php
                                            if ($reserva->estadoSolicitacao == "aprovado") {
                                                print '<a href="#!" class="bi bi-file-pdf-fill h5" onclick="criarComprovativo(' . $idUtente . ', ' . $reserva->idsolicitacao_reserva . ')"></a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <!-- Fim section reseevas -->
        <?php
            break;
        case 'dados': ?>
            <!-- dados pessoais -->
            <section class="dados-utente container">
                <h5 class="titulos">Meus Dados</h5>
                <div class="row">
                    <!-- Dados de identificação -->
                    <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-transition="500">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Dados pessoais</h5>
                            </div>
                            <div class="card-body">
                                <div class="resposta-edicao text-center">
                                </div>
                                <form action="#!" id="form-dado-pessoais">
                                    <div class="form-group mb-2">
                                        <input type="text" name="utenteNome" class="form-control rounded-0" value="<?= $dadosUtente->utenteNome ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="tel" name="utenteTelefone" class="form-control rounded-0" value="<?= $dadosUtente->utenteTelefone ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="mail" name="utenteEmail" class="form-control rounded-0" value="<?= $dadosUtente->utenteEmail ?>">
                                    </div>
                                    <input type="hidden" name="idUtente" value="<?= $idUtente ?>">
                                    <div class="mt-2 text-end">
                                        <input type="submit" class="btn btn-sm rounded-0 btn-primario" value="EDITAR">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- Fim dados identificação -->

                    <!-- Dados de segurança -->
                    <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-transition="500">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Alterar senha</h5>
                            </div>
                            <div class="card-body">
                                <div class="resposta-senha"></div>
                                <form action="#!" id="form-editar-senha">
                                    <div class="form-group mb-2">
                                        <input type="text" name="utenteSenhaAtual" class="form-control rounded-0" placeholder="Insira a senha atual">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="text" name="utenteSenhaNova" class="form-control rounded-0" placeholder="Insira uma senha nova">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="text" name="utenteSenhaNovaRepetida" class="form-control rounded-0" placeholder="Repita a senha nova">
                                    </div>
                                    <input type="hidden" name="senha" value="<?= $dadosUtente->utenteSenha ?>">
                                    <input type="hidden" name="idUtente" value="<?= $dadosUtente->idutente ?>">

                                    <div class="mt-2 text-end">
                                        <input type="submit" class="btn btn-sm rounded-0 btn-primario" value="Alterar Senha">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div><!-- Fim dados de segurança -->
                </div>
            </section>
            <!-- Fim seccção dados pessoais -->

        <?php

        case 'comprovativos': ?>
            <section class="container">
                <?php
                if (($comprovativos)) :
                    foreach ($comprovativos as $comp) : ?>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <div class="p-2">
                                    <a href="<?= ROUTE ?>comprovativo.php?id-comprovativo=<?= $comp->idcomprovativo_reserva ?>" class="nav-link">
                                        <i class="bi bi-file-pdf-fill me-2"></i>
                                        <span>Comprovativo: <?= $comp->codigoReferencia ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </section>

<?php
            break;
        default:
            # code...
            break;
    }
}
?>




<!-- Modal Confirmação de eleinação de reservas-->
<div class="modal fade" id="modalEliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true" data-aos="zoom-in" data-aos-easing="ease" data-aos-duration="1500" data-aos-transition="500">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-eliminar-reserva border-0">
            <div class="modal-body">
                <div class="m-auto text-center">
                    <img src="<?= IMAGENS ?>icones/feito.png" class="img-fluid icon-img" alt="icon-aviso">
                </div>
                <div class="mt-2 texto-aviso">
                    prentende realmente cancelar está reserva?
                    está ação não poderá ser revertida.
                </div>
            </div>
            <div class="p-2 border-0 text-center">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">NÃO</button>
                <button type="button" class="btn btn-success btn-confirm">SIM</button>
            </div>
        </div>
    </div>
</div>
<style>
    footer,
    .navegacao {
        display: none !important;
    }

    .acordos span {
        font-size: 12px !important;
        display: block !important;
        margin-bottom: 6px;
        border-bottom: dotted 1px #444 !important;

    }
</style>
<script>
    /* ========== ELIMINAR RESERVAS ============= */
    let corpo = document.querySelector('.modal-body')
    let botaoConfirmar = document.querySelector('.btn-confirm')

    const confirmaEliminacaoReserva = () => {

    }
</script>
<script src="<?= JS ?>editarDados.js"></script>

<script>
    // Atualize a contagem a cada segundo
    function leftTime(id, data, hora) {
        setInterval(() => {

            // Defina a data e hora alvo para a contagem regressiva
            const dataAlvo = new Date(data + "T" + hora).getTime();
            const agora = new Date().getTime();
            const diferenca = dataAlvo - agora;

            if (diferenca <= 0) {
                // Quando a data alvo for atingida, pare a contagem
                clearInterval(interval);
                document.querySelector(".contagem").innerHTML = "Contagem encerrada!";
            } else {
                // Calcule os dias, horas, minutos e segundos restantes
                const dias = Math.floor(diferenca / (1000 * 60 * 60 * 24));
                const horas = Math.floor((diferenca % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutos = Math.floor((diferenca % (1000 * 60 * 60)) / (1000 * 60));
                const segundos = Math.floor((diferenca % (1000 * 60)) / 1000);

                // Exiba a contagem no elemento com o id "contagem"
                document.querySelector(".contagem-" + id).innerHTML = `
                        Faltam ${dias} dias, ${horas} horas, ${minutos} minutos e ${segundos} segundos para a data marcada
                    `;
            }
        }, 1000);
        // Atualize a cada segundo
    }


    // URL do Google Maps
    const googleMapsUrl = "https://www.google.com/maps/place/Farm%C3%A1cia+Azael/@-8.9110363,13.2699679,17z/data=!3m1!4b1!4m6!3m5!1s0x1a51f7f60e2b05df:0x8e64ceefdc40a530!8m2!3d-8.9110416!4d13.2725428!16s%2Fg%2F11h05q2m5z?entry=ttu";

    // Função para extrair informações geográficas
    function extrairInformacoesGeograficas() {
        // Verifica se a API do Google Maps está carregada
        if (typeof google === "undefined" || typeof google.maps === "undefined") {
            console.error("A API do Google Maps não está carregada.");
            return;
        }

        // Extrai as coordenadas de latitude e longitude do URL
        const coordenadas = googleMapsUrl.match(/@([-0-9.]+),([-0-9.]+)/);
        if (!coordenadas) {
            console.error("Coordenadas não encontradas no URL.");
            return;
        }

        const latitude = parseFloat(coordenadas[1]);
        const longitude = parseFloat(coordenadas[2]);

        // Cria um objeto Geocoder
        const geocoder = new google.maps.Geocoder();

        // Cria uma solicitação de geocodificação reversa
        const latLng = new google.maps.LatLng(latitude, longitude);
        const geocoderRequest = {
            location: latLng
        };

        // Realiza a geocodificação reversa
        geocoder.geocode(geocoderRequest, (results, status) => {
            if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
                const addressComponents = results[0].address_components;
                let bairro, rua, provincia;

                // Itera pelos componentes do endereço
                for (const component of addressComponents) {
                    if (component.types.includes("sublocality_level_1")) {
                        bairro = component.long_name;
                    } else if (component.types.includes("route")) {
                        rua = component.long_name;
                    } else if (component.types.includes("administrative_area_level_1")) {
                        provincia = component.long_name;
                    }
                }

                // Exibe as informações obtidas
                console.log("Bairro:", bairro);
                console.log("Rua:", rua);
                console.log("Província:", provincia);
            } else {
                console.error("Não foi possível obter informações geográficas.");
            }
        });
    }

    // Chama a função para extrair informações geográficas após o carregamento da API do Google Maps
    google.maps.event.addDomListener(window, "load", extrairInformacoesGeograficas);


    // alterar estados das solicitações 

    function alterarEstadoSolicitacoes(id_estado, estado, id_solicitacao) {
        const datas = new FormData()
        datas.append('acao', 'muda-estado-solicitacoes')
        datas.append('id-estado', id_estado)
        datas.append('estado', estado)
        datas.append('id-solicitacao', id_solicitacao)
        fetch('./Rquests/requestAjax.php', {
                method: 'POST',
                body: datas
            })
            .then(res => res.json())
            .then(resposta => {

            })
    }
</script>
<script>
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

        const randomNumbers = generateRandomChars(2, numbers);
        const randomUppercaseLetters = generateRandomChars(2, uppercaseLetters);
        const randomLowercaseLetters = generateRandomChars(2, lowercaseLetters);

        const combinedRandomChars = randomNumbers + randomUppercaseLetters + randomLowercaseLetters;

        // Shuffle the characters to ensure randomness
        const shuffledCode = combinedRandomChars.split("").sort(() => 0.5 - Math.random()).join("");

        return shuffledCode;
    }

    let randomCode = "";

    setInterval(() => {
        randomCode = generateRandomCode()
    }, 500);

    function criarComprovativo(utente, reserva) {

        dados = new FormData() // capta os dados do formulário
        dados.append('acao', 'cria-comprovativo')
        dados.append('reserva', reserva)
        dados.append('utente', utente)
        dados.append('referencia', randomCode)
        fetch('<?= ROUTE ?>Requests/requestAjax.php ', { // envia os dados para uma página php
                body: dados, // Dados a serem enviados
                method: 'POST' // verbo ou metodo HTTP da requisição
            })
            .then(res => res.json()) // envia e espera uma resposta no formato json de dados
            .then(resposta => { // armazena os dados da resposta no objeto resposta
                if (resposta.status == 200) {
                    // alert(resposta.msg + ' ' + resposta.id_comprovativo)
                    setTimeout(() => {
                        location.href = '<?= ROUTE ?>comprovativo.php?id-comprovativo=' + resposta.id_comprovativo
                    }, 5000);
                } else {
                    alert(resposta.msg)
                    location.href = '<?= ROUTE ?>comprovativo.php?id-comprovativo=' + resposta.id_comprovativo
                }
            })
            .catch(err => { // caso houver um erro

            })

    }
</script>