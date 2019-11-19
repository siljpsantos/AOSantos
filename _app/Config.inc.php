<?php

session_start();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$dir = explode(DIRECTORY_SEPARATOR, getcwd());
if (end($dir) == 'php') {
    include "./querys.php";
    $var_json = file_get_contents('../_app/var.json');
}else if (end($dir) == 'ajax') {
    include "../querys.php";
    $var_json = file_get_contents('../../_app/var.json');
} else {
    include "php/querys.php";
    $var_json = file_get_contents('_app/var.json');
}

$var_json = json_decode($var_json);

// print_r($var_json->fds);

$crud = new crud();

//Rotas
define('HOME', 'http://192.168.1.149/aosantos');
define('THEME', 'sshtml');

define('INCLUDE_PATH', HOME . '/themes/' . THEME);
define('REQUIRE_PATH', 'themes/' . THEME);

//IMAGENS PADRÃO
define('LOGO_NAV', INCLUDE_PATH . "/img/logo_nav.png");
define('LOGO_FAV', INCLUDE_PATH . "/img/fav.png");
define('LOGO_NORM', INCLUDE_PATH . "/img/logo_norm.png");
define('SAVE_BTN', INCLUDE_PATH . "/img/save.png");
define('OK_BTN', INCLUDE_PATH . "/img/ok_icon.png");
define('NO_BTN', INCLUDE_PATH . "/img/no_icon.png");

//-----------------------------------------------------------------------
$getUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setUrl = (empty($getUrl) ? 'index' : $getUrl);
$Url = explode('/', $setUrl);
