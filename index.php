<?php

require_once './config.php';


// criando o sistema e roteamennto

if (isset($_GET['url'])) {

    $rota = htmlspecialchars(addslashes(filter_input(INPUT_GET, 'url')));

    $url = array_filter(explode('/', $rota));

    $file = $url[0]  . '.php';

    if (file_exists('./view/' . $file)) {
        require './layouts/header.php';
        require './layouts/navbar.php';
        require './view/' . $file;
        require './layouts/footer.php';
    } else {
        // require './view/404.php';
        echo 'Falha ' . $file;
    }
} else {
    require './layouts/header.php';
    require './layouts/navbar.php';
    require './view/home.php';
    require './layouts/footer.php';
}
