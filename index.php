<?php

error_reporting(1);
error_reporting(E_ALL);
ini_set('display_errors', 1);


include('app/authentication/OAuth.php');
include('app/inventory/Inventory.php');

try{
	$data = new \stdClass();
	$fields = new \stdClass();


	$fields->trimId =15146;
    $fields->productionYear = 2014;
    $fields->modelYear = 2014;
    $fields->doors = 4;
    $fields->colorId = 5;
    $fields->km = 25000;
    $fields->price = 27852;
    $fields->priceResale = 27852;
    $fields->fuelId = 5;
    $fields->plate = "ABC1234";
    $fields->text= "Único dono, revisões feitas na concessionária";
    $fields->dealerId= 1125649;
    $fields->initialDateDisplay = '2017-06-01T13:14:01.429Z';
    $fields->dateDisplayEnd = '2017-06-20T13:14:01.429Z';
    $fields->equipmentsIds = [1,2,3,4,6,8,12];
    $fields->photosIds=[];
    $fields->dealId=13793847;
    $fields->conteudo="";
    $fields->mimetype='image/jpeg';	

    $data->imageId=75253787;

    $data->dealId=13793847;
    $data->fields = $fields;
	$data->username='haganicolau';
	$data->password='teste';
	$data->client_id='123456789';
	$data->client_secret='3214569872';
	$data->scope='anunciantepj usuariosite offline';
	$data->response_type='code';
	$data->redirect_uri='http://api.icarros.xxx/';
	$data->makeId=14;
	$data->modelId=214;
	$data->modelYear=2014;
	$data->dealerId=1125649;
	$data->token='';

	$data->initial_data="20160501000000";

	$data->initial_data = '2017-01-01';
	$data->final_date = '2017-05-01';

	$inventory = new Inventory();
	$aux = [];
	$aux = $inventory->deleteDeal($data);
	var_dump($aux);

	
} catch (Exception $e) {
    $return = [
    	'status'=>'fail',
    	'message'=>$e->getMessage()
    ];
   var_dump($return);
}

