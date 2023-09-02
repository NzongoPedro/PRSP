<?php

$id_comprovativo = '';

if (isset($_GET['id-comprovativo'])) {

  $id_comprovativo = filter_input(INPUT_GET, 'id-comprovativo');
}

require './vendor/autoload.php';

require_once './dompdf/autoload.inc.php';
// pegar os dados da base de dados

# Utentes, Referencia, Pedido

use App\controller\ServicosController as comprovativo;

$dadoC = comprovativo::mostrarDadosPDF($id_comprovativo);


//utente
$utente = $dadoC->utenteNome;
$utenteTelefone = $dadoC->utenteTelefone;
$utenteEmail = $dadoC->utenteEmail;

// documentos
$documento = $dadoC->documentoDesignacao;

// posto

$posto = $dadoC->postoDesignacao;
$postoLocalizacao = $dadoC->postoMunicipio;
$postoEmail = $dadoC->postoEmail;

// Reserva

$reservaEstado = $dadoC->estadoSolicitacao;

$dataReserva = $dadoC->solicitacaoReservaData;
$horaReserva = $dadoC->solicitacaoReservaHora;
$requisitos = $dadoC->documentoRequisitos;

// referência

$referencia = $dadoC->codigoReferencia;

// data

$dataGeracao = $dadoC->comprovativoData;




use Dompdf\Dompdf;

use Dompdf\Options;

$options = new Options();

$options->set('isRemoteEnabled', true);

$dompdf = new DOMPDF($options);

$image = './storage/image/logo/logotipo1_principal.png';

// Read image path, convert to base64 encoding
$imageData = base64_encode(file_get_contents($image));

// Format the image SRC: data:{mime};base64,{data};
$src = 'data:' . mime_content_type($image) . ';base64,' . $imageData;
$html = '

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Comprovativo de reserva</title>
    <style>
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: sans-serif;
      }
      p.info{
        font-family:sans-serif !important;
        color: #444;
      }

      .container .logo {
        top: 0;
        padding: 10px;
        position: relative;
        margin-top:40px;
      }
      .container .logo img {
        max-width: 100% !important;
        width: 130px !important;
        margin-top:5px;
      }
      .container .logo .titulo {
        float: right;
        margin-top: 28px;
        width: 400px;
        margin-right: 5%;
      }
      .container .logo .titulo h5 {
        font-size: 14px;
        text-transform: uppercase;
        text-decoration: underline;
        margin-left:12px;
      }

      .other {
        float: right;
      }

      .other h6 {
        text-transform: capitalize;
        font-size: 20px;
        margin-right: 50px;
      }

      .lado-esquerdo {
        padding: 10px;
        border-bottom: 4px;
        width: 300px;
        height: 200px;
        text-align:center;
        margin-bottom: 20px;
        margin-left: 2.5%;
      }

      .lado-direito {
        padding: 10px;
        border-bottom: 4px;
        width: 300px;
        height: 200px;
        text-align:center;
        float:right;
        margin-top: -236px;
        margin-right:15px
      }
      .lado-esquerdo .item h5 {
        font-size: 20px;
        margin: auto;
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 10px;
        margin-top: 10px;
      }
      .lado-esquerdo .item p {
        font-size: 18px;
        margin: auto;
        margin-bottom: 10px;
        margin-top: 10px;
        margin-left: 10px;
      }

      .lado-direito .item {
    
      }

      .lado-direito .item h5 {
        font-size: 20px;
        margin: auto;
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 10px;
        margin-top: 10px;
      }
      .lado-direito .item p {
        font-size: 18px;
        margin: auto;
        margin-left: 10px;
        margin-bottom: 10px;
        margin-top: 10px;
      }

      .informacao {
        padding: 30px;
        margin-left: 10px;
        margin-bottom: 20px;
      }
      .informacao .p {
        font-size: 18px;
        color: #991f0c;
        font-weight: 500;
        font-family: sans-serif;
      }

      .files{
        margin-left: 1.5%;
      }

      .obrigatorio {
        padding: 10px;
        max-width:250px;
        width: 250px;
        position: relative;
        float:left;
      }
      .obs {
        max-width:250px;
        width: 250px;
        margin-right: 20px;
        float:right;
        margin-top:11.5px;
      }
      .requisitos {
        max-width:250px;
        width: 250px;
        margin-left: 0;
        float:left;
        margin-top:11.5px;
      }

      .obrigatorio h5 {
        padding: 20px;
        top: 0;
        left: 0;
      }
      .obs h5 {
        padding: 20px;
        margin-left: 0;
        margin-right: 20px !important;
      }
      .requisitos h5 {
        padding: 20px;
        margin-left: 0;
        margin-right: 20px !important;
      }

      .obrigatorio ul{
        margin-left: 25px;
      }
      .obs ul{
        margin-left: 25px;
      }
      .requisitos ul{
        margin-left: 25px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="logo">
        <div class="other">
          <h6>comprovativo</h6>
          <p>Referência: ' . $referencia . '</p>
          <p>Data: ' . $dataGeracao . '</p>
          <p>Moeda: Kz</p>
        </div>
        <img src="' . $src . '" alt="" />
        <div class="titulo">
          <h5>Plataforma de Reserva de Serviços Públicos</h5>
        </div>
      </div>
      <br />
      <hr />
      <br />
      <br >
      <br >
      <br >
      <div class="lado-esquerdo">
        <div class="item">
          <h5>Dados do utente</h5>
          <p>Nome: ' . $utente . '</p>
          <p>Telefone: ' . $utenteTelefone . '</p>
          <p>email: ' . $utenteEmail . '</p>
          <p>Documento: ' . $documento . '</p>
        </div>
      </div>
      <div class="lado-direito">
        <div class="item">
          <h5>Dados do posto</h5>
          <p>Nome: ' . $posto . '</p>
          <p>Município: ' . $postoLocalizacao . '</p>
          <p>Estado da reserva: ' . $reservaEstado . '</p>
          <p>email: ' . $postoEmail . '</p>
        </div>
      </div>
      <div class="informacao">
      
        <p class="info">
          <b>PRSP - Reservas. </b> Foi feita a solicitação do(a) <i>' . $documento . '</i>, foi marcado no(a) <i>' . $posto . ';</i>  para ' . $utente . ' para a data/hora
        ' . $dataReserva . ' as ' . $horaReserva . '.
        </p>
          <br><br>
          <strong>OBS: Os documentos necessário para os serviços ' . $posto . ', encontram-se disponíveis no plataforma PRSP. </strong>
       
      </div>

      <div class="files">
          <div class="obrigatorio">
            <h5>Obrigatório</h5>
            <p>
                <ul>
                <li>
                Leve o seu comprovativo de marcação imprenso ou eletrónico;
                </li>
                <li>
                    Leve todos os documentos necessários para os serviço que pretende;
                </li>
                    <li>
                        No(a) ' . $posto . ' dirija-se a área de atendimento.
                    </li>
                </ul>
            </p>
          </div>
          <div class="requisitos">
          <h5>O que é necessário</h5>
          <p>
              <ul type="none">
                  <li>
                     ' . $requisitos . '
                  </li>
                  
              </ul>
          </p>
        </div>
          <div class="obs">
            <h5>Antes do antendimento</h5>
            <p>
                <ul>
                    <li>
                        Chegar 30 minutos antes, para pertmitir que seja atendido na hora marcada;
                    </li>
                    <li>
                        Apresentar o comprovativo do pagamento;
                    </li>
                  </ul>
            </p>
          </div>
        
      </div>

      <br><br>    <br><br>    <br><br>    <br><br>    <br><br>    <br><br>    <br><br>    <br><br>     <br><br>    <br><br>
  
  
      <p style="text-align:center;">Documento processado pela <b>PRSP</b> em: ' . $dataGeracao . '.</p>
    </div>
  </body>
</html>
';

$dompdf->loadhtml($html);


$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream(
  'Comprovativo_' . $utente . '_' . $documento,
  array(
    "Attachment" => false //Para realizar o download somente alterar para true
  )
);
