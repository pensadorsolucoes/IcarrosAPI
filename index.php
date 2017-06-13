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
    $fields->plate = "RFG1234";
    $fields->text= "Único dono, revisões feitas na concessionária";
    $fields->dealerId= 1125649;
    $fields->initialDateDisplay = '2017-06-01T13:14:01.429Z';
    $fields->dateDisplayEnd = '2017-06-20T13:14:01.429Z';
    $fields->equipmentsIds = [1,2,3,4,6,8,12];
    $fields->photosIds=['74805576_1'];
    $fields->dealId=13784817;

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
	$data->token='Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJqdGkiOiIzNDgwYTQ1NS1jNmU4LTRkNTAtOWY1NC1iNmQ3OTdhYWVhZWEiLCJleHAiOjE0OTcyOTg4MTUsIm5iZiI6MCwiaWF0IjoxNDk3Mjk1MjE1LCJpc3MiOiJodHRwczovL2FjY291bnRzLmljYXJyb3MuY29tL2F1dGgvcmVhbG1zL2ljYXJyb3MiLCJhdWQiOiJzd2FnZ2VyIiwic3ViIjoiNzIxMWQ4MTktMWY2MS00NmI3LWE1OGYtNTY1OGIyOGVkZTFjIiwidHlwIjoiQmVhcmVyIiwiYXpwIjoic3dhZ2dlciIsInNlc3Npb25fc3RhdGUiOiJkYmUwMmU1My0wYmUyLTRiZTAtYTAwMS1mOTZlNjNkZGJmYWEiLCJjbGllbnRfc2Vzc2lvbiI6IjQ3MzM5ODc3LTc3YWUtNDU0Yy05MjNiLTljMDY3ZWUzMmU0ZCIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3BhZ2luYXNlZ3VyYS5pY2Fycm9zLmNvbS5iciIsImh0dHA6Ly9sb2NhbGhvc3Q6ODA4MCJdLCJyZXNvdXJjZV9hY2Nlc3MiOnsiaWNhcnJvcy13ZWJhcHAiOnsicm9sZXMiOlsidXN1YXJpb3NpdGUiLCJhbnVuY2lhbnRlcGoiXX0sImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJ2aWV3LXByb2ZpbGUiXX19LCJuYW1lIjoiQ2ljYWwgIiwicHJlZmVycmVkX3VzZXJuYW1lIjoibWFya2V0aW5ndWRpQGdydXBvY2ljYWwuY29tLmJyIiwiZ2l2ZW5fbmFtZSI6IkNpY2FsIiwiZW1haWwiOiJtYXJrZXRpbmd1ZGlAZ3J1cG9jaWNhbC5jb20uYnIifQ.eKoCMnKQEFS3wCeASbeqa29xPnpcrIpKvivcW4hns9vFOOUCqsC2IBiH5wt2huBl06-RQWYdQ8bRw9C5ZLTB6Xrj4ZkUG29_cfn9sljC_-lEiMiYOmpUpuTx7QMouAavmr20KiXpYOBYWoyMbCoARp75tzQK7A8a7-V3W9CD5Es';

	$data->initial_data="20160501000000";

	$data->initial_data = '2017-01-01';
	$data->final_date = '2017-05-01';

	$inventory = new Inventory();
	$aux = [];
	$aux = $inventory->createDeal($data);
	var_dump($aux);

	
} catch (Exception $e) {
    $return = [
    	'status'=>'fail',
    	'message'=>$e->getMessage()
    ];
   var_dump($return);
}

