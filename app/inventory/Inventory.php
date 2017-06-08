<?php

class Inventory {

    /**
    * url do host icarros
    * @var string
    **/
    protected $host = 'https://paginasegura.icarros.com.br/rest';


    public function __construct() {
      
    }

    /**
    * Returns the encoding for the colors field to be used for ad inclusion 
    * @param array $data
    * @return array field to be used for ad inclusion
    **/
    public function getColors($data) {
        $url = '/databaseservice/colors';
        try {

            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $color = $myCurl->createCurl();
            $color = json_decode($color);
            return $color;
            
        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns the encoding for the equipments field (optional for the vehicle) to be used for ad inclusion
    * @param array $data
    * @return array field to be used for ad inclusion
    **/
    public function getEquipments($data){
        $url = '/databaseservice/equipments/1';
        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $equipments = $myCurl->createCurl();

            // if(gettype($equipments) === 'array'){
            //     var_dump($equipments['status'].': '.$equipments['message']);
            // }

            $equipments = json_decode($equipments);
            return $equipments;


        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }

    }

    /**
    * Returns the encoding for the fuel field to be used for ad inclusion
    * @param array $data
    * @return array Containing fuel field to be used for ad inclusion
    **/
    public function getFuelTypes($data){
        $url = '/databaseservice/fueltypes';
        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $fuelTypes = $myCurl->createCurl();

            $fuelTypes = json_decode($fuelTypes);
            return $fuelTypes;


        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns the list of tags and their encoding in iCarros
    * @param array $data
    * @return array of tags and their encoding in iCarros
    **/
    public function getMakes($data){
        $url = '/databaseservice/makes/1';
        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $makes = $myCurl->createCurl();

            $makes = json_decode($makes);
            return $makes;


        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }


    /**
    * Returns the list of newly released templates and their encoding in iCarros. The tag is associated with id.
    * @param array $data
    * @return array of newly released templates and their encoding in iCarros.
    **/
    public function getModelsLaunch($data){
        $url = '/databaseservice/models/launch/1';
        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $models = $myCurl->createCurl();

            $models = json_decode($models);
            return $models;


        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }

    }

    /**
    * Returns the list of templates and their encoding in iCarros. The tag is associated with id.
    * @param array $data
    * @return array of templates and their encoding in iCarros.
    **/
    public function getModels($data){
        $url = '/databaseservice/models/1?makeId='.$data->makeId;
        /*
            Attributes relation:
             -makeId: Represents make id
        */
        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $models = $myCurl->createCurl();

            $models = json_decode($models);
            return $models;


        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }

    }


    /**
    * Returns the minimum, average and maximum price announced for the vehicle in iCarros (Brazil and, if possible, in the state) along with the Fipe price.
    * @param array $data
    * @return array of average and maximum price announced for the vehicle in iCarros
    **/
    public function getPricestats($data){
        $url = '/databaseservice/pricestats/'.$data->ufId.'/'.$data->trimId.'/'.$data->year.'/'.$data->km;
        /*
            Attributes relation:
             -ufId: has no logic, any number entered, returns the same data
             -trimId: version id and its encoding in iCarros
             -year: model year
             -km: kilometers rolled
        */
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $publish = $myCurl->createCurl();

            $publish = json_decode($publish);
            return $publish;
        try{

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns the destinations in which ads can be published
    * @param array $data
    * @return array the destinations in which ads can be published
    **/
    public function getPublishProviders($data){
        $url = '/databaseservice/publishproviders';
        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $publish = $myCurl->createCurl();

            $publish = json_decode($publish);
            return $publish;


        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns the Reviews of a model according to the year
    * @param array $data
    * @return array Reviews of a model according to the year
    **/
    public function getReviews($data){
        $url = '/databaseservice/reviews/'.$data->modeloId.'/'.$data->anoModelo;
        /*
            Attributes relation:
             -modeloId: id model
             -anoModelo: year model

        */
        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $reviews = $myCurl->createCurl();

            $reviews = json_decode($reviews);
            return $reviews;


        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns the encoding for the transmission field to be used for ad inclusion
    * @param array $data
    * @return array of transmission field
    **/
    public function getTransmissions($data){
        $url = '/databaseservice/transmissions';
        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $transmissions = $myCurl->createCurl();

            $transmissions = json_decode($transmissions);
            return $transmissions;


        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns the list of versions and their encoding in iCarros. Versions are a specialization of the model and are associated with it by the id.
    * @param array $data
    * @return array the list of versions and their encoding in iCarros
    **/
    public function getTrims($data){
        $url = '/databaseservice/trims/1?makeId='.$data->makeId.'&modelId='.$data->modelId.'&modelYear='.$data->modelYear;
        /*
            Attributes relation:
             -ufId: has no logic, any number entered, returns the same data
             -trimId: version id and its encoding in iCarros
             -year: model year
             -km: kilometers rolled
        */
        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $trims = $myCurl->createCurl();

            $trims = json_decode($trims);
            return $trims;


        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }


    /**
    * List of Dealers to whom this access
    * @param array $data
    * @return array List of Dealers
    **/
    public function getDealer($data){
        $url = '/dealerservice/dealer';

        try {
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $dealer = $myCurl->createCurl();

            $dealer = json_decode($dealer);
            return $dealer;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * seach the receveid calls by call
    * @param array $data
    * @return array List of Dealers
    **/
    public function getDealerCalls($data){
        $url = '/dealerservice/dealear/'.$data->dealerId.'/calls';
        /*
            Attributes relation:
             -modeloId: id dealer

        */
        try {
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setHeader($header);
            $dealer = $myCurl->createCurl();

            $dealer = json_decode($dealer);
            return $dealer;
            
        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }


}