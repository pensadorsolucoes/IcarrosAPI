<?php
/**
 * Class OAuth
 *
 * @package authentication
 */

include('app/MyCurl.php');
class OAuth {

	// //$username, $password, $client_id, $client_secret, $url, $redirect_url
	public function __construct($data){

	}

	/**
	* url do host icarros
	* @var string
	**/
	protected $host = '';
	
	/**
	* obter autorização para solicitar o token
	* @param array $data
	**/
	public function getAccessAutorization($data){
		$host = 'https://accounts.icarros.com/auth/realms/icarros/protocol/openid-connect/auth?';
		// $host = 'https://linguagem-programacao4.herokuapp.com/v1/livros';

		try{

			$host = $host.'client_id='.$data['client_id'].'&';
			$host = $host.'redirect_uri='.$data['redirect_uri'].'&';
			$host = $host.'response_type='.$data['response_type'].'&';
			$host = $host.'scope='.$data['scope'];

			$header[0]='Content-Type: application/json';

			$dateCurl = new \stdClass();
			$dateCurl->_url = $host;
			$dateCurl->_method = 'GET';
			$dateCurl->_status = '';

			$myCurl = new MyCurl($dateCurl);

			$myCurl->setHeader($header);
			$response = $myCurl->createCurl();
		    return $response;

			
		} catch (Exception $e) {
            $return = [
            	'status'=>'fail',
            	'message'=>$e->getMessage()
            ];
            return $return;
        }
	}

	public function getAccessToken(){
		
	}
}

