<footer class=".footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card bg-transparent border-0">
                    <div class="card-body">
                        <h5 class="card-title text-center">PRSP</h5>
                        <small class="text-light">Plataforma de Reservas de Serviços Públicos</small>
                        <hr class="text-light">
                        <div class="mt-2 mb-3 text-white text-center">
                            PRSP <?= date('Y') ?>. Todos os direitos reservados.
                            <samll>Desenvolvido por ARODISI.</samll>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- SCRIPTS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
<script src="<?= JS ?>jquery/jquery.js"></script>
<script src="<?= JS ?>slick/slick.min.js"></script>
<script src="<?= BOOTSTRAP ?>js/bootstrap.min.js"></script>
<script src="<?= AOS ?>aos.js"></script>
<script>
    AOS.init();
</script>
<script>
    $(document).ready(function() {
        $('.postos-slick').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            lazyLoad: 'ondemand',
            arrows: false,
            autoplay: true,
            adaptiveHeight: true,
            /*  fade: true, */
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false,
                        arrows: false,
                        adaptiveHeight: true,
                        /*  fade: true, */
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        arrows: false,
                        adaptiveHeight: true,
                        /*  fade: true, */
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        adaptiveHeight: true,
                        /*  fade: true, */
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    })
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var offcanvasNavbar = document.getElementById('offcanvasNavbar');
        var offcanvasNavbarToggle = document.querySelector('[data-bs-target="#offcanvasNavbar"]');
        var navbarTogglerBefore = document.querySelector('.navbar-toggler::before');
        var navbarTogglerAfter = document.querySelector('.navbar-toggler::after');
        var btnClose = document.querySelector('.btn-close');

        offcanvasNavbarToggle.addEventListener('click', function() {
            if (offcanvasNavbar.classList.contains('show')) {
                offcanvasNavbar.classList.remove('show');
                document.body.classList.remove('offcanvas-open');
                navbarTogglerBefore.style.transform = 'rotate(45deg)';
                navbarTogglerAfter.style.transform = 'rotate(-45deg)';
                btnClose.style.display = 'none';
            } else {
                offcanvasNavbar.classList.add('show');
                document.body.classList.add('offcanvas-open');
                navbarTogglerBefore.style.transform = 'rotate(45deg) translate(5px, 5px)';
                navbarTogglerAfter.style.transform = 'rotate(-45deg) translate(5px, -5px)';
                btnClose.style.display = 'block';
            }
        });
    });
</script>
</body>

</html>