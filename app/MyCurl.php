<?php
class MyCurl {
	/**
	* host url
	* @var string
	**/
	protected $_url;

	/**
	* http method
	* @var string
	**/
	protected $_method;

	/**
	* json object
	* @var string
	**/
	protected $_json;

	/**
	* http status
	* @var string
	**/
	protected $_status;

	/**
	* post fields
	* @var string
	**/
	protected $_postFields;

	/**
	* http header
	* @var string
	**/
	protected $_header;

	/**
	* if method post
	* @var string
	**/
	protected $_post;

	/**
	* construct of function, initialize curl
	* @param array $data
	**/
	public function __construct($data){
		$this->_method = $data->_method;
		$this->_status = $data->_status;
		$this->_url = $data->_url;
	}

	/**
	* if it's post method http set post (necessary), 
	* @param array $fields
	**/
	public function setPost($postFields){ 
        $this->_post = true; 
        $this->_postFields = $postFields; 
    } 


    /**
	* set header http
	* @param array $data
	**/
    public function setHeader($data){

    	foreach ($data as $key => $value) {
    		$this->_header[$key] = $value;
    	}
    }

    /**
	* create curl and exec url
	**/
    public function createCurl(){

    	try{
	    	$myCurl = curl_init(); 
	    	
	    	if($this->_post){ 
	        	curl_setopt($s,CURLOPT_POST,true); 
	        	curl_setopt($s,CURLOPT_POSTFIELDS,$this->_postFields); 
	        } 

	    	curl_setopt($myCurl,CURLOPT_URL,$this->_url); 
	    	curl_setopt($myCurl,CURLOPT_SSL_VERIFYPEER, false); 
	    	curl_setopt($myCurl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($myCurl,CURLOPT_HTTPHEADER,$this->_header); 
	        curl_setopt($myCurl,CURLOPT_TIMEOUT, 30); 
	        curl_setopt($myCurl,CURLOPT_MAXREDIRS, 4); 
	        curl_setopt($myCurl,CURLOPT_RETURNTRANSFER,true); 

	        $data = curl_exec($myCurl);
	        // var_dump($data);
	        
	        if($data === false){
	        	$error = curl_error($myCurl);
	        	throw new Exception("Error Message: ".$error);
	        }

	        if(empty($data)==true){
	        	$error = curl_error($myCurl);
	        	throw new Exception("Error Message: Empty response");
	        }

	        curl_close($myCurl); 
	        return $data;

	    } catch (Exception $e) {
            $return = [
            	'status'=>'fail',
            	'message'=>$e->getMessage()
            ];
            return $return;
        }
    }

}