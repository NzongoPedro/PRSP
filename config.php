<?php
session_start();

$protocolo = 'http://';
$route = $protocolo . $_SERVER['HTTP_HOST'] . '/' . 'prsp' . '/';
define('ROUTE', $route);
define('BOOTSTRAP', $route . 'public/css/bootstrap-5.3.0-alpha3-dist/');
define('BICON', $route . 'public/css/bootstrap-5.3.0-alpha3-dist/bootstrap-icons/font/bootstrap-icons.css');
define('CSS', $route . 'public/css/');
define('IMAGENS', $route . 'storage/image/');
define('AOS', $route . 'public/js/aos/');
define('JS', $route . 'public/js/');
