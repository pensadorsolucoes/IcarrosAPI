<?php
use IcarrosAPI\Icarros as Icarros;
require('vendor/autoload.php');

//======================================================================
// Oauth
//======================================================================

/*
 * Get Url
 */

$icarros = new  Icarros(
   array(
      'response_type'  => '{response_type}',
      'client_id'      => '{client_id}',
      'client_secret'  => '{client_secret}',
      'redirect_uri'   => '{redirect_uri}',
      'scope'          => '{scope}'
	  )
); 

$url_login = $icarros->getLoginUrl();

/*
 * Get token
 */
$icarros = new  Icarros(
   array(
      'scope'       => '{scope}'
      'client_id'   => '{client_id}',
      'redirect_uri'=> '{redirect_uri}'
      'client_secret'=>'{client_secret}',
      'response_type'=>'{response_type}',
    )
); 

$token = $icarros->getToken();

//======================================================================
// Features Databaseservice
//======================================================================

/*
 * Get equipaments
 */
$icarros    = new Icarros($token);
$equipments = $icarros->getEquipments();


/*
 * Get fuel types
 */
$icarros    = new Icarros($token);
$equipments = $icarros->getFuelTypes();

//======================================================================
// Features Dealerservice
//======================================================================

$icarros = new Icarros($token);
$dealer  = $icarros->getDealer();