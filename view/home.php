<?php

use App\controller\PostosController as postos;

$postos = postos::index();

?>
<div class="capa w-100" data-aos="fade-down" data-aos-duration="2000" data-aos-transtion="1000">
    <div class="container d-flex justify-content-center align-content-center align-items-center flex-column">
        <br>
        <br>
        <br>
        <div class="titulo text-center mt-3" data-aos="fade-down" data-aos-duration="2000" data-aos-transtion="1000">
            <h1 class="text-white display-1">PRSP</h1>
        </div>
        <div class="mt-3 text-center " data-aos="fade-down" data-aos-duration="2500">
            <h3 class="text-white display-5">Plataforma de Reserva de Serviços Públicos</h3>
        </div>
    </div>
</div>
<!-- END HERO -->

<!-- Sobre -->
<section class="sobre mb-3 w-100">
    <div class="sobre-content gradiente-2 p-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-5 col-xl-5 mb-3" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card text-start">
                        <img src="<?= IMAGENS ?>icones/1.png" src="holder.js/100px180/" alt="Title">
                        <div class="card-body">
                            <h3 class="card-title text-uppercase text-center">
                                <b>O que é PRSP</b>
                            </h3>
                            <p class="card-text text-center mb-3 p-2">
                                PRSP é uma solução computacional baseada na web desenvolvida com o propósito de facilitar o processo de reservas de serviços públicos para os cidadãos angolanos. A ferramenta proporciona maior simplicidade no processo de reservas.
                            </p>
                            <h5 class="card-title about-titl text-center">Sobre Nós</h5>
                            <div>
                                <p class="card-text text-center mb-3 p-2">
                                    Somos uma solução computacional para reservas de diferentes tipos de serviços públicos (ou documentos). A busca pela excelência aliada a inovação tecnológica será (ou tem sido) fulcrais para a consolidação da nossa meta.

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-sm-12 col-lg-7 col-xl-7">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col" data-aos="fade-up" data-aos-duration="1000">
                            <div class="card h-100">
                                <img src="<?= IMAGENS ?>icones/missao.png" class="img-about shadow" alt="icone-missão">
                                <div class="card-body">
                                    <h5 class="card-title about-titl text-center">Missão</h5>
                                    <p class="card-text text-center mb-4">
                                        Facilitar a reserva de serviços públicos aos cidadãos da província de Luanda no conforto de suas casas.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col" data-aos="fade-up" data-aos-duration="1500">
                            <div class="card h-100">
                                <img src="<?= IMAGENS ?>icones/valores.png" class="img-about shadow" alt="icone-valores">
                                <div class="card-body">
                                    <h5 class="card-title about-titl text-center">Valores</h5>
                                    <div class="card-text text-center mb-4">
                                        <h6>* Foco nas solicitações de reservas;</h6>
                                        <h6> * Compromisso com o trabalho;</h6>
                                        <h6>* Foco na qualidade;</h6>
                                        <h6>* Foco na inovação;</h6>
                                        <h6>* Responsabilidade.</h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" data-aos="fade-up" data-aos-duration="2000" data-aos-transtion="1000">
                            <div class="card h-100">
                                <img src="<?= IMAGENS ?>icones/visao.png" class="img-about shadow" alt="icone-visão">
                                <div class="card-body">
                                    <h5 class="card-title about-titl text-center">Visão</h5>
                                    <p class="card-text text-center mb-4">
                                        Ser reconhecido rigorosamente pela excelência em gestão de reservas e contribuir para solucionar as dificuldades enfrentadas pelos cidadãos angolanos ao adquirir os serviços públicos.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- fim sobre -->

<!-- Section Info-->
<setction class="mb-5 hero-quem bg-white">
    <div class="container">
        <div class="card bg-transparent border-0">
            <div class="card-body bg-transparent" data-aos="fade-up" data-aos-duration="1500">
                <h5 class="card-title m-5 text-muted text-uppercase text-center text-black">
                    <b>Quem pode usar?</b>
                </h5>
            </div>
        </div>
    </div>
    <div class="fundo-paralax">
        <div class="text-paralax m-auto container p-2" data-aos="fade-up" data-aos-duration="2000" data-aos-transtion="1000">
            Todos os cidadãos angolanos residentes na província de Luanda
        </div>
    </div>
    </div>
</setction>
<!--Fim section Info-->

<!-- section -->
<section class="bg-white hero-login w-100">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card border-0 h-100">
                    <img src="<?= IMAGENS ?>hero/5.png" class="card-img-top" data-aos="zoom-in" data-aos-duration="2000" data-aos-transtion="1000">
                    <!--   -->
                    <div class="card-body container">
                        <h5 class="card-title f-roboto text-center">Oque preciso?</h5>
                        <div class="m-auto card-text text-center">
                            Baste teres um dispositivo que consiga aceder a internert, criares uma conta
                            e poderes assim aproveitar de todos os recursos disponíveis. A autenticação é de factor
                            obrigatório para caso de envio de dados ou solicitação de reservas.
                        </div>
                        <div class="mt-2 mb-2 text-center">
                            <a href="#" class="btn rounded-5 btn-primario">
                                <i class="bi-lock-fill me-1"> </i>
                                Autenticar-se
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LOCALES -->
<section>
    <div class="text-center mt-3 mb-3 p-2 text-uppercase card-title">
        <h5 class="f-robot"><b>Postos em Lunda</b></h5>
    </div>
    <div class="postos-slick p-2">
        <?php
        foreach ($postos as $posto) : ?>
            <div>
                <div class="content shadow">
                    <img src="<?= IMAGENS ?>postos/p1.png" class="posto-foto">
                </div>
                <div class="card-title posto-nome">
                    <h5>
                        <a href="./" class="nav-link"> <?= $posto->postoDesignacao ?></a>
                    </h5>
                </div>
            </div>
        <?php endforeach ?>

    </div>
</section>
<!-- FIM LOCALES -->

<br>
<!-- New latter -->
<section class="newlatter mt-2 bg-black mb-3">
    <div class="contaidner">
        <div class="card rounded-0 bg-transparent">
            <div class="card-body">
                <div class="card-title m-auto mb-3 cor-primario">
                    <h5 class="f-roboto">Assine o Newlatter</h5>
                </div>
                <div class="card-text mb-3 text-light">Insira o seu e-mail para receber notificações.</div>
                <form action="" class="form-inline">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control form-control-lg rounded-0" placeholder="seuemail@provedor.com" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primario rounded-0 btn-lg w-100">
                                ASSINAR
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>