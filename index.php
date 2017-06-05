<?php
// forca https
// if( $_SERVER['HTTP_HOST'] == 'app.machinegram.com' && empty($_SERVER['HTTPS'])) {
//     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
//     exit();
// }

// configuracoes php (preferivel usar htaccess)
// error_reporting(E_ALL ^ E_NOTICE);
// date_default_timezone_set('America/Sao_Paulo');
// ini_set('error_log', sprintf('logs/php/error-%s.log', date('d-m-Y')));


// // sessoes
// ini_set('session.cookie_lifetime', 60 * 60 * 24 * 30 * 12);
// ini_set('session.gc_maxlifetime',  60 * 60 * 24 * 30 * 12);
            
// session_name('mgapp');
// session_set_cookie_params(60 * 60 * 24 * 30 * 12); // sessao 1 ano (segundos)
// session_cache_expire(60 * 24 * 30 * 12); // expira em 1 ano (minutos)
// session_save_path(realpath('sessions/'));
// session_start();


// dependencias globais do composer
require 'vendor/autoload.php';

// nosso app
require 'app/index.php';