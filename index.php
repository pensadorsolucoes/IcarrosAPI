<?php
use IcarrosAPI\Icarros as Icarros;
require('vendor/autoload.php');

error_reporting(1);
error_reporting(E_ALL);
ini_set('display_errors', 1);

try{

	$icarros = new  Icarros
	(
	   array(
      'response_type'=>'{response_type}',
      'client_id'=>    '{client_id}',
      'redirect_uri'=> '{redirect_uri}',
      'scope'=>        '{scope}'
  	  )
	); 

	$token = $icarros->getLoginUrl();
	var_dump($token);

	
} catch (Exception $e) {
    $return = [
    	'status'=>'fail',
    	'message'=>$e->getMessage()
    ];
   var_dump($return);
}

