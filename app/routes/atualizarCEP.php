<?php
	Flight::route('GET /', function() {
	    $ctrl = new Atualizar();
	    return $ctrl->logradouro();
	});

