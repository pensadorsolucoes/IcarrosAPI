<?php

error_reporting(1);
error_reporting(E_ALL);
ini_set('display_errors', 1);

// dependencias globais do composer
// require 'vendor/autoload.php';
//require 'vendor/autoload.php';

// nosso app
// require 'app/index.php';

include('app/authentication/OAuth.php');
// include('app/Base.php');

$data=[
	'username'=>'haganicolau',
	'password'=>'teste',
	'client_id'=>'123456789',
	'client_secret'=>'3214569872',
	'scope'=>'anunciantepj usuariosite',
	'response_type'=>'code',
	'redirect_uri'=>'http://api.icarros.xxx/' 
];


			/*$params=[
				'response_type'=> $data['response_type'],
				'client_id'=>$data['client_id'],
				'redirect_uri'=>$data['redirect_uri'],
				'scope'=>$data['scope'],
				'grant_type'=>'authorization_code'
			];*/

$teste = new OAuth($data);
$resposta = $teste->getAccessAutorization($data);
var_dump($resposta);
