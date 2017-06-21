<?php

namespace IcarrosAPI;


/**
 * Icarros API v1.
 *
 * TERMS OF USE:
 * - This code is in no way affiliated with, authorized, maintained, sponsored
 *   or endorsed by Icarros or any of its affiliates or subsidiaries. This is
 *   an independent and unofficial API. Use at your own risk.
 * - We do NOT support or tolerate anyone who wants to use this API to send spam
 *   or commit other online crimes.
 *
 */


class Icarros
{



	/**
	* config to all requests
	*
	* @var array
	**/
	protected $cfg = [];

	/**
	* Login url
	*
	* @var string
	**/
	protected $_loginUrl = 'https://accounts.icarros.com/auth/realms/icarros/protocol/openid-connect';

	/**
	* Rest API
	*
	* @var string
	**/
	protected $_api = 'https://paginasegura.icarros.com.br/rest';





	/**
	* use a 2 types of data
	* @var array
	*				client_id
	*				client_secret
	*				redirect_uri
	*				response_type
	*				scope
	*
	* @var string
	*				token
	**/

	public function __construct(
        $data = null)
	{


		if(empty($data))
			throw new Exception("Empty data in construct");


		if(is_array($data)){

			self::$cfg['client_id'] 	= $data['client_id'];
			self::$cfg['client_secret'] = $data['client_secret'];
			self::$cfg['redirect_uri'] 	= $data['redirect_uri'];
			self::$cfg['response_type'] = $data['response_type'];
			self::$cfg['scope'] 		= $data['scope'];

		} else{

			self::$cfg['token'] = 'Bearer ' . $data;

		}

    }




    /**
	* 
	* Get a login url to send your user
	* in $scope include offline_access to get indefined token
	*
	* @return string 	
	*
	**/

    public function getLoginUrl()
	{

		$endpoint = $this->_loginUrl . '/auth'
		unlink(self::$cfg['client_secret']);
		return $endpoint . http_build_query(self::$cfg);




	}


	/**
	* 
	* Get token for the request
	* in $scope include code to receiver in return a getLoginUrl
	*
	* @return array 	
	*
	**/

    public function getToken()
	{


		return $this->request($this->_loginUrl . 'token')
                ->addPost('code', self::$cfg['scope'])
                ->addPost('client_id', self::$cfg['client_id'])
                ->addPost('client_secret', self::$cfg['client_secret'])
                ->addPost('redirect_uri', self::$cfg['redirect_uri'])
                ->addPost('grant_type', 'authorization_code')
            	->getResponse();

	}






	/**
	* 
	* Get colors used in iCarros register
	*
	* @return array 	
	*
	**/

    public function getColors()
	{

		$endpoint = $this->_api . '/databaseservice/colors';


		return $this->request($endpoint)
                ->addHeader('Accept', 'application/json')
                ->addHeader('Authorization', self::$cfg['token'])
            	->getResponse();

	}


	/**
	* 
	* Get equipments used in iCarros register
	*
	* @return array 	
	*
	**/

    public function getEquipments()
	{

		$endpoint = $this->_api . '/databaseservice/equipments/1';


		return $this->request($endpoint)
                ->addHeader('Accept', 'application/json')
                ->addHeader('Authorization', self::$cfg['token'])
            	->getResponse();

	}


	/**
	* 
	* Get fuel types used in iCarros register
	*
	* @return array 	
	*
	**/

    public function getFuelTypes()
	{

		$endpoint = $this->_api . '/databaseservice/fueltypes';


		return $this->request($endpoint)
                ->addHeader('Accept', 'application/json')
                ->addHeader('Authorization', self::$cfg['token'])
            	->getResponse();

	}


	/**
	* 
	* Get makes used in iCarros register
	*
	* @return array 	
	*
	**/

    public function getMakes()
	{

		$endpoint = $this->_api . '/databaseservice/makes/1';


		return $this->request($endpoint)
                ->addHeader('Accept', 'application/json')
                ->addHeader('Authorization', self::$cfg['token'])
            	->getResponse();

	}

	/**
	* 
	* Get makes used in iCarros register
	*
	* @return array 	
	*
	**/

    public function getModelsLaunch()
	{

		$endpoint = $this->_api . '/databaseservice/models/launch/1';


		return $this->request($endpoint)
                ->addHeader('Accept', 'application/json')
                ->addHeader('Authorization', self::$cfg['token'])
            	->getResponse();

	}


	/**
	* 
	* Get models used in iCarros register
	* 
	* @var make_id is a marcaId, if all use 0
	*
	* @return array 	
	*
	**/

    public function getModels($make_id = 0)
	{

		$endpoint = $this->_api . '/databaseservice/models/launch/1';


		return $this->request($endpoint)
                ->addHeader('Accept', 'application/json')
                ->addHeader('Authorization', self::$cfg['token'])
                ->addParam('makeId', $make_id)
            	->getResponse();

	}


	/**
	* 
	* Get models used in iCarros register
	* 
	* @var make_id is a marcaId, if all use 0
	*
	* @return array 	
	*
	**/

    public function getModels($make_id = 0)
	{

		$endpoint = $this->_api . '/databaseservice/models/launch/1';


		return $this->request($endpoint)
                ->addHeader('Accept', 'application/json')
                ->addHeader('Authorization', self::$cfg['token'])
                ->addParam('makeId', $make_id)
            	->getResponse();

	}

	/**
	* 
	* Create a new ad in the inventory
	* 
	* @var array 
	*				dealerId
	*				trimId
	*				productionYear
	*				modelYear
	*				doors
	*				colorId
	*				km
	*				price
	*				priceResale
	*				fuelId
	*				plate
	*				text
	*				equipmentsIds
	*				photosIds
	*
	*
	* @return array 	
	*
	**/

    public function postDeal($params)
	{

		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealerId'].'/inventory';


		return $this->request($endpoint)
                ->addHeader('Accept', 'application/json')
                ->addHeader('Authorization', self::$cfg['token'])
                ->addPost('trimId', $params['trimId'])
                ->addPost('productionYear', $params['productionYear'])
                ->addPost('modelYear', $params['modelYear'])
                ->addPost('doors', $params['doors'])
                ->addPost('colorId', $params['colorId'])
                ->addPost('km', $params['km'])
                ->addPost('price', $params['price'])
                ->addPost('priceResale', $params['priceResale'])
                ->addPost('fuelId', $params['fuelId'])
                ->addPost('plate', $params['plate'])
                ->addPost('text', $params['text'])
                ->addPost('dealerId', $params['dealerId'])
                ->addPost('equipmentsIds', $params['equipmentsIds'])
                ->addPost('photosIds', $params['photosIds'])
            	->getResponse();

	}



	/**
	* 
	* Remove a ad in the inventory
	* 
	* @var array 
	*				dealerId
	*				dealId
	*
	*
	* @return array 	
	*
	**/

    public function deleteDeal($params)
	{

		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealerId'].'/inventory/'.$params['dealId'];


		return $this->request($endpoint)
                ->addHeader('Accept', 'application/json')
                ->addHeader('Authorization', self::$cfg['token'])
                ->addDelete(true)
            	->getResponse();

	}









	/**
     *
     * Used internally, but can also be used by end-users if they want
     * to create completely custom API queries without modifying this library.
     *
     * @param string $url
     *
     * @return array
     */
    public function request(
        $url)
    {
        return new Request($this, $url);
    }




}