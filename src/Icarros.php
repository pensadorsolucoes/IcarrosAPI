<?php
namespace IcarrosAPI;
require 'src/Request.php';
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
	private static $cfg = [];

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
	*		   client_id
	*		   client_secret
	*		   redirect_uri
	*		   response_type
	*		   scope
	*
	* @var string
	*		   token
	**/
	public function __construct(
        $data = null)
	{

		if(empty($data))
			throw new Exception("Empty data in __construct");

		if(is_array($data)){

			self::$cfg['client_id'] 	= $data['client_id'];
			self::$cfg['client_secret'] = $data['client_secret'];
			
			self::$cfg['redirect_uri'] 	= $data['redirect_uri'];
			self::$cfg['response_type'] = $data['response_type'];
			self::$cfg['scope'] 		= $data['scope'];
			
			if(isset($data['refresh_token'])) 
				self::$cfg['refresh_token'] = $data['refresh_token'];

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
		$endpoint = $this->_loginUrl . '/auth';
		unset(self::$cfg['client_secret']);
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
	* Get reflesh token when has expired
	* in $scope include code to receiver in return a getLoginUrl
	*
	* @return array 	
	*
	**/
	public function getRefleshToken(){
		return $this->request($this->_loginUrl . 'token')
            ->addPost('refresh_token', self::$cfg['refresh_token'])
            ->addPost('client_id', self::$cfg['client_id'])
            ->addPost('client_secret', self::$cfg['client_secret'])
            ->addPost('grant_type', 'refresh_token')
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
    public function getModels($params)
	{
		$endpoint = $this->_api . '/databaseservice/models/launch/1';

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->addParam('makeId', $params['make_id'])
            ->getResponse();

	}

	/**
	* 
	* GET the minimum, average and maximum price announced for the vehicle not iCarros (Brazil and if possible, in the state) with the combined price Fipe
	* 
	* @var Array containing trimId, model year and km
	*
	* @return array 	
	*
	**/
	public function getPricestats($params)
	{
		$endpoint = $this->_api . '/databaseservice/pricestats/1/'.$params['trim_id'].'/'.$params['model_year'].'/'.$params['km'];

		return $this->request($endpoint)
			->addHeader('Accept', 'application/json')
			->addHeader('Authorization', self::$cfg['token'])
			->getResponse();
	}

	/**
	* 
	* GET the destinations in which ads can be published
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getPublishProviders()
	{
		$endpoint = $this->_api . '/databaseservice/publishproviders';

		return $this->request($endpoint)
			->addHeader('Accept', 'application/json')
			->addHeader('Authorization', self::$cfg['token'])
			->getResponse();
	}


	/**
	* 
	* GET the Reviews of a model according to the year
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getReviews($params)
	{
		$endpoint = $this->_api . '/databaseservice/reviews/'.$params['model_id'].'/'.$params['model_year'];

		return $this->request($endpoint)
			->addHeader('Accept', 'application/json')
			->addHeader('Authorization', self::$cfg['token'])
			->getResponse();
	}

	/**
	* 
	* GET the encoding for the transmission field to be used for ad inclusion
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getTransmissions()
	{
		$endpoint = $this->_api . '/databaseservice/transmissions';

		return $this->request($endpoint)
			->addHeader('Accept', 'application/json')
			->addHeader('Authorization', self::$cfg['token'])
			->getResponse();
	}

	/**
	* 
	* GET the list of versions and their encoding in iCarros. Versions are a specialization of the model and are associated with it by the id.
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getTrims($data)
	{
		$endpoint = $this->_api . '/databaseservice/trims/1';

		return $this->request($endpoint)
			->addHeader('Accept', 'application/json')
        	->addHeader('Authorization', self::$cfg['token'])
        	->addParam('makeId', $data['make_id'])
        	->addParam('modelId', $data['model_id'])
        	->addParam('modelYear', $data['model_year'])
        	->getResponse();

	}

	/**
	* 
	* GET of Dealers to this login has access
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getDealer()
	{
		$endpoint = $this->_api . '/dealerservice/dealer';

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->getResponse();
	}

	/**
	* 
	* GET of Dealers to this login has access
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getDealerCalls($params)
	{
		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealer_id'].'/calls';

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->getResponse();
	}

	/**
	* 
	* GET the dealer's current inventory
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getDealerInventory($params)
	{
		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealer_id'].'/inventory';

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->getResponse();
	}

	/**
	* 
	* GET the datas of the current requested ad
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getDataDeal($params)
	{
		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealer_id'].'/inventory/'.$params['deal_id'];

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->getResponse();
	}

	/**
	* 
	* GET all mail and financing leads (grouped by user) for the last 90 days.
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getLeads($params)
	{
		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealer_id'].'/leads';

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->getResponse();
	}

	/**
	* 
	* GET all mail and financing leads (grouped by user) since initial date
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getLeadsSiceDate($params)
	{
		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealer_id'].'/leads/'.$params['initial_data'];

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->getResponse();
	}

	/**
	* 
	* GET all invoices between two dates
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getInvoicesBetweenDates($params)
	{
		$endpoint = $this->_api . '/dealerservice/invoices/'.$params['dealer_id'].'/'.$params['initial_data'].'/'.$params['final_date'];

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->getResponse();
	}

	/**
	* 
	* GET all produtcs by id dealer
	* 
	* @var Array 
	*
	* @return array 	
	*
	**/
	public function getProducts($params)
	{
		$endpoint = $this->_api . '/dealerservice/products/'.$params['dealer_id'];

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->getResponse();
	}

	/**
	* 
	* Create a new ad in the inventory
	* 
	* @var array 
	*		dealer_id
	*		trim_id
	*		production_year
	*		model_year
	*		doors
	*		color_id
	*		km
	*		price
	*		price_resale
	*		fuel_id
	*		plate
	*		text
	*		equipments_ids
	*		photos_ids
	*
	* @return array 	
	*
	**/
    public function postDeal($params)
	{

		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealer_id'].'/inventory';

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->addPost('trimId', $params['trim_id'])
            ->addPost('productionYear', $params['production_year'])
            ->addPost('modelYear', $params['model_Year'])
            ->addPost('doors', $params['doors'])
            ->addPost('colorId', $params['color_id'])
            ->addPost('km', $params['km'])
            ->addPost('price', $params['price'])
            ->addPost('priceResale', $params['price_resale'])
            ->addPost('fuelId', $params['fuel_id'])
            ->addPost('plate', $params['plate'])
            ->addPost('text', $params['text'])
            ->addPost('dealerId', $params['dealer_id'])
            ->addPost('equipmentsIds', $params['equipments_ids'])
            ->addPost('photosIds', $params['photos_ids'])
            ->getResponse();
	}

	/**
	* 
	* Create a new ad in the inventory
	* 
	* @var array 
	*				deale_id
	*				deal_id
	*				image_64
	*				mimetype
	*
	* @return array 	
	*
	**/
    public function postImage($params)
    {
    	$endpoint = $this->_api . '/dealerservice/dealer/'.$params['deale_id'].'/inventory/'.$params['deal_id'].'/image';
		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->addPost('conteudo', $params['image_64'])
            ->addPost('mimetype ', $params['mimetype'])
            ->getResponse();
    }

	/**
	* 
	* update a ad in the inventory
	* 
	* @var array 
	*		dealer_id
	*		deal_id
	*		trim_id
	*		production_year
	*		model_year
	*		doors
	*		color_id
	*		km
	*		price
	*		price_resale
	*		fuel_id
	*		plate
	*		text
	*		equipments_ids
	*		photos_ids
	*
	* @return array 	
	*
	**/
    public function putDeal($params)
	{
		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealer_id'].'/inventory'.$params['deal_id'];

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('Authorization', self::$cfg['token'])
            ->addPut('id ', $params['deal_id'])
            ->addPut('trimId', $params['trimId'])
            ->addPut('productionYear', $params['production_year'])
            ->addPut('modelYear', $params['model_year'])
            ->addPut('doors', $params['doors'])
            ->addPut('colorId', $params['color_id'])
            ->addPut('km', $params['km'])
            ->addPut('price', $params['price'])
            ->addPut('priceResale', $params['price_resale'])
            ->addPut('fuelId', $params['fuel_id'])
            ->addPut('plate', $params['plate'])
            ->addPut('text', $params['text'])
            ->addPut('dealerId', $params['dealer_id'])
            ->addPut('equipmentsIds', $params['equipments_ids'])
            ->addPut('photosIds', $params['photos_ids'])
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
    public function deleteImage($params)
	{
		$endpoint = $this->_api . '/dealerservice/dealer/'.$params['dealer_id'].'/inventory/'.$params['deal_id'].'/image/'.$params['image_id'];

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