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
  'deal_id'          => '{deal_id}',
  'dealer_id'        => '{dealer_id}',
  'trim_id'          => '{trim_id}',
  'production_year'  => '{production_year}',
  'model_year'       => '{model_year}',
  'doors'            => '{doors}',
  'color_id'         => '{color_id}',
  'km'               => '{km}',
  'price'            => '{price}',
  'price_resale'     => '{price_resale}',
  'fuel_id'          => '{fuel_id}',
  'plate'            => '{plate}',
  'text'             => '{text}',
  'equipments_ids'   => ['id1', 'id2', 'id3', ... ,'idn'],
  'photos_ids'       => []
];

$dealId = $icarros->postDeal($params);