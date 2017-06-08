<?php

error_reporting(1);
error_reporting(E_ALL);
ini_set('display_errors', 1);


include('app/authentication/OAuth.php');
include('app/inventory/Inventory.php');

try{
	$data = new \stdClass();
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
	$data->token='Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJqdGkiOiIxMjk0NmVmMy01NTQ5LTQzMGQtYjM5NS03YWU4YjNkZDcyMjMiLCJleHAiOjE0OTY5Mjc2MTEsIm5iZiI6MCwiaWF0IjoxNDk2OTI0MDExLCJpc3MiOiJodHRwczovL2FjY291bnRzLmljYXJyb3MuY29tL2F1dGgvcmVhbG1zL2ljYXJyb3MiLCJhdWQiOiJzd2FnZ2VyIiwic3ViIjoiNjdmMWYyZWItNDM3Mi00MGZlLWFmY2UtNmY3MTJkOGE1ODRjIiwidHlwIjoiQmVhcmVyIiwiYXpwIjoic3dhZ2dlciIsInNlc3Npb25fc3RhdGUiOiI2YTFiYjg5ZC0yMWM1LTQ4YjctYWM3YS1iYmEwZmI3ZWY0MzUiLCJjbGllbnRfc2Vzc2lvbiI6IjhmNGM4NmI0LTVlYjAtNGIyMi1hMThlLTZiYmUwODMwOTEzMiIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3BhZ2luYXNlZ3VyYS5pY2Fycm9zLmNvbS5iciIsImh0dHA6Ly9sb2NhbGhvc3Q6ODA4MCJdLCJyZXNvdXJjZV9hY2Nlc3MiOnsiaWNhcnJvcy13ZWJhcHAiOnsicm9sZXMiOlsidXN1YXJpb3NpdGUiLCJhbnVuY2lhbnRlcGYiLCJhbnVuY2lhbnRlcGoiXX0sImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJ2aWV3LXByb2ZpbGUiXX19LCJuYW1lIjoiQ0lDQUwgVkVJQ1VMT1MiLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiJjaXZlbmRhczAxQGdydXBvY2ljYWwuY29tLmJyIiwiZ2l2ZW5fbmFtZSI6IkNJQ0FMIiwiZmFtaWx5X25hbWUiOiJWRUlDVUxPUyIsImVtYWlsIjoiY2l2ZW5kYXMwMUBncnVwb2NpY2FsLmNvbS5iciJ9.UhoPQCjabTPCFLiJ_ZooEYBLSexSKkknalWYFnp-YyLcpkyh7jn6IJoCX0j13eXEbjgJI9kF8IDPulF3c79vNrBn59MWcWZPge-g9RWLiwRMs6oOjEwGgS2P2jiydP3uyV0UvHVg4qRP5P_hM2PSAaZPzGIGybsF-lEtY-mIZZ0';


	$estoque = new Estoque();
	$aux = [];
	$aux = $estoque->getTrims($data);
	var_dump($aux);

	
} catch (Exception $e) {
    $return = [
    	'status'=>'fail',
    	'message'=>$e->getMessage()
    ];
   var_dump($return);
}


			/*$params=[
				'response_type'=> $data['response_type'],
				'client_id'=>$data['client_id'],
				'redirect_uri'=>$data['redirect_uri'],
				'scope'=>$data['scope'],
				'grant_type'=>'authorization_code'
			];*/

// $access = new OAuth($data);
// $resposta = $access->getAccessAutorization($data);
// $resposta2 = $access->getAccessToken($data);
