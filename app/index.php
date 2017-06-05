<?php 

// autoload
Flight::path('app/controllers/');

// salva log de exceptions
Flight::set('flight.log_errors', true);


// rotas
require 'routes/index.php';


// executa
Flight::start();
