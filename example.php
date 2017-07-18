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
      'scope'       => '{scope}',
      'client_id'   => '{client_id}',
      'redirect_uri'=> '{redirect_uri}',
      'client_secret'=>'{client_secret}'
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

//======================================================================
// New Ad
//======================================================================

$params=[
  'dealer_id'        => '{dealer_id}',
  'trim_id'          => '26884',
  'production_year'  => '2017',
  'model_year'       => '2017',
  'doors'            => '4',
  'color_id'         => '5',
  'km'               => '25000',
  'price'            => '28000',
  'price_resale'     => '28000',
  'fuel_id'          => '5',
  'plate'            => 'AAA8000',
  'text'             => 'Texto exemplo teste, teste, teste',
  'equipments_ids'   => ['1', '2', '3', '4', '7', '8', '11', '12'],
  'photos_ids'       => []
];

$dealId = $icarros->postDeal($params);