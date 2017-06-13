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
        $url = '/databaseservice/pricestats/1/'.$data->trimId.'/'.$data->year.'/'.$data->km;
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
        $url = '/databaseservice/reviews/'.$data->modelId.'/'.$data->modelYear;
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
    * get the receveid calls by the advertiser.
    * @param array $data
    * @return array List of Dealers
    **/
    public function getDealerCalls($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/calls';
        // $url = '/dealerservice/statsbydate/'.$data->dealerId.'/20161211/20170609';
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

    /**
    * List the dealer's current inventory
    * @param array $data
    * @return array List of Dealers
    **/
    public function getDealerInventory($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/inventory';
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

    /**
    * Create a new ad
    * @param array $data
    * @return arrayAnswer success or fail
    **/
    public function createDeal($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/inventory';
        /*
            Attributes relation:
             -modeloId: id dealer
             -fields: fields to send in post http

        */
        try {
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'POST';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Content-Type: application/json';
            $header[1]='Accept: application/json';
            $header[2]=$data->token;

            
            $fields = new \stdClass();
            $fields->trimId = $data->fields->trimId;
            $fields->productionYear = $data->fields->productionYear;
            $fields->modelYear = $data->fields->modelYear;
            $fields->doors = $data->fields->doors;
            $fields->colorId = $data->fields->colorId;
            $fields->km = $data->fields->km;
            $fields->price = $data->fields->price;
            $fields->priceResale = $data->fields->priceResale;
            $fields->fuelId = $data->fields->fuelId;
            $fields->plate = $data->fields->plate;
            $fields->text = $data->fields->text;
            $fields->dealerId = $data->fields->dealerId;
            $fields->equipmentsIds = $data->fields->equipmentsIds;
            $fields->photosIds = $data->fields->photosIds;

            $fields->initialDateDisplay = $data->fields->initialDateDisplay;
            $fields->dateDisplayEnd = $data->fields->dateDisplayEnd;

            $myCurl->setPost($fields);
            $myCurl->setHeader($header);

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Create a new ad
    * @param array $data
    * @return array Answer success or fail
    **/
    public function deleteDeal($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/inventory/'.$data->dealId;
        /*
            Attributes relation:
             -modeloId: id dealer
             -dealId: delete that ad

        */
        try {
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'DELETE';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $myCurl->setDelete();
            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns the datas of the current requested ad
    * @param array $data
    * @return array datas of this dealer
    **/
    public function getDataDeal($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/inventory/'.$data->dealId;
        /*
            Attributes relation:
             -modeloId: id dealer
             -dealId: delete that ad

        */
        try {
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'GET';
            $dateCurl->_status = '';

            $myCurl = new MyCurl($dateCurl);
            $header[0]='Accept: application/json';
            $header[1]=$data->token;

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Update ad with uploaded data
    * @param array $data
    * @return array Answer success or fail
    **/
    public function updateDeal($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/inventory/'.$data->dealId;
        /*
            Attributes relation:
             -modeloId: id dealer
             -dealId: delete that ad

        */
        try {
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'PUT';
            $dateCurl->_status = '';

            /*
            $fields = new \stdClass();
            $fields->trimId = $data->fields->trimId;
            $fields->productionYear = $data->fields->productionYear;
            $fields->modelYear = $data->fields->modelYear;
            $fields->doors = $data->fields->doors;
            $fields->colorId = $data->fields->colorId;
            $fields->km = $data->fields->km;
            $fields->price = $data->fields->price;
            $fields->priceResale = $data->fields->priceResale;
            $fields->fuelId = $data->fields->fuelId;
            $fields->plate = $data->fields->plate;*/

            // $fields->photosIds = $data->fields->photosIds;
            // $fields->equipmentsIds = $data->fields->equipmentsIds;
            // $fields->text = $data->fields->text;
            // $fields->dealerId = $data->fields->dealerId;

            // $fields->initialDateDisplay = $data->fields->initialDateDisplay;
            // $fields->dateDisplayEnd = $data->fields->dateDisplayEnd;
            // $fields->publishes->priority = $data->fields->publishes->priority;
            // $fields->publishes->feature1 = $data->fields->publishes->feature1;
            // $fields->publishes->feature2 = $data->fields->publishes->feature2;
            // $fields->publishes->feature3 = $data->fields->publishes->feature3;
            // $fields->publishes->zeroKm = $data->fields->publishes->zeroKm;
            // $fields->publishes->publishProviderId = $data->fields->publishes->publishProviderId;

           /* $fields_json = json_encode($data->fields);
            $myCurl->setPut();

            $header[0]='Accept: application/json';
            $header[1]=$data->token;
            $myCurl->setHeader($header);

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;*/

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Creates a new image for the informed ad
    * @param array $data
    * @return array answer success or fail
    **/
    public function createNewPicture($data){
        $url = '/dealerservice/uploadimage/13793847';
        // $url = '/dealerservice/dealer/'.$data->dealerId.'/inventory/'.$data->fields->dealId.'/image';

        /*
            Attributes relation:
             -modeloId: id dealer
             -dealId: delete that ad

        */
        try {
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;

            $dateCurl->_method = 'POST';
            $dateCurl->_status = '';
            $myCurl = new MyCurl($dateCurl);

            $fields = new \stdClass();
            $fields->conteudo =$data->fields->conteudo;
            $fields->mimetype = 'image/jpeg';

            $myCurl->setPost($fields);

            $header[0]='Accept: application/json';
            $header[1]=$data->token;
            $myCurl->setHeader($header);

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Delete a image for the informed ad
    * @param array $data
    * @return array Answer success or fail
    **/
    public function deletePicture($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/inventory/'.$data->dealId.'/image/'.$data->imageId;
        /*
            Attributes relation:
             -modeloId: id dealer
             -dealId: delete that ad
             -imageId: id image
        */
        try {
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'DELETE';
            $dateCurl->_status = '';
            $myCurl = new MyCurl($dateCurl);

            $myCurl->setDelete();

            $header[0]='Accept: application/json';
            $header[1]=$data->token;
            $myCurl->setHeader($header);

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Reorder the ad images in the order they were sent (ids of the images separated by underline eg 123_432_9832)
    * @param array $data
    * @return string ids of the images
    **/
    public function reorderPicture($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/inventory/'.$data->dealId.'/orderimages/'.$data->imagesUnderline;
        /*
            Attributes relation:
             -modeloId: id dealer
             -dealId: delete that ad
             -imagesUnderline: ids of the images separated by underline eg 123_432_9832
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

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns all mail and financing leads (grouped by user) for the last 90 days.
    * @param array $data
    * @return array mail and financing leads
    **/
    public function getLeads($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/leads';
        /*
            Attributes relation:
             -dealerId: id dealer
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

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }

    }

    /**
    * Returns all mail and financing leads (grouped by user) since initial date
    * @param array $data
    * @return array mail and financing leads
    **/
    public function getLeadsSiceDate($data){
        $url = '/dealerservice/dealer/'.$data->dealerId.'/leads/'.$data->initial_data;
        /*
            Attributes relation:
             -dealerId: id dealer
             -initial_data: initial data
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

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns all mail and financing leads (grouped by user) between two dates
    * @param array $data
    * @return array mail and financing leads
    **/
    public function getInvoicesBetweenDates($data){
        $url = '/dealerservice/invoices/'.$data->dealerId.'/'.$data->initial_data.'/'.$data->final_date;
        /*
            Attributes relation:
             -dealerId: id dealer
             -initial_data: initial data
             -final_date: final data
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

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Check which advertiser IDs you've received after a specific date.
    * @param array $data
    * @return array mail and financing leads
    **/
    public function getLastTimeChecked($data){
        $url = '/dealerservice/leads/check/'.$data->lastTimeChecked;
        /*
            Attributes relation:
             -lastTimeChecked: specific period will check
        */

        try{
            $dateCurl = new \stdClass();
            $dateCurl->_url = $this->host.$url;
            $dateCurl->_method = 'POST';
            $dateCurl->_status = '';
            $myCurl = new MyCurl($dateCurl);

            
            $header[0]='Accept: application/json';
            $header[1]=$data->token;
            $myCurl->setHeader($header);

            $fields_json = json_encode($data->fields);
            $myCurl->setPost($fields_json);

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

    /**
    * Returns all produtcs by id dealer
    * @param array $data
    * @return array mail and financing leads
    **/
    public function getProducts($data){
        $url = '/dealerservice/products/'.$data->dealerId;
        /*
            Attributes relation:
             -dealerId: id dealer
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

            $return = $myCurl->createCurl();
            $return = json_decode($return);
            return $return;

        } catch (Exception $e) {
            $return = [
                'status'=>'fail',
                'message'=>$e->getMessage()
            ];
            return $return;
        }
    }
}