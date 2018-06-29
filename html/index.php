<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . 'error_log.txt');
error_reporting(E_ALL);

include_once '../config/config.php';

/**
 * Método de carregamento automático das classes
 * @param class $c classe que será instanciada
 */

function __autoload($c) {
    $diretorios = array(
        '../',
        '../dao/',
        '../libs/',
        '../libs/sql/',
        '../model/',
        '../static/',
        '../to/',
        '../gui/'
    );

    foreach ($diretorios as $dir) {
        if (file_exists($dir . $c . '.php')) {
            require_once $dir . $c . '.php';
        }
    }
}

$app = new TApp();
$app->executar();
?> 