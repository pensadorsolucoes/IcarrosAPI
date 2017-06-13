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
	* if method put
	* @var string
	**/
	protected $_put;

	/**
	* if method delete
	* @var string
	**/
	protected $_delete;

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
	* if it's post method http set post (necessary), 
	* @param array $fields
	**/
    public function setDelete(){
    	$this->_delete = true; 
    }

    /**
	* if it's put method http set put (necessary), 
	* @param array $fields
	**/
    public function setPut($postFields){
    	$this->_put = true; 
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
	* @return array response of request
	* @throws response is false
	* @throws response is empty
	* @throws http code is 401, unauthorized
	* @throws http code is 400, error server
	**/
    public function createCurl(){

	    	$myCurl = curl_init(); 
	    	
	    	if($this->_post){ 
	        	curl_setopt($myCurl,CURLOPT_POST,true); 
	        	curl_setopt($myCurl,CURLOPT_POSTFIELDS, json_encode($this->_postFields));
	        } 

	        if($this->_delete){
	        	curl_setopt($myCurl, CURLOPT_CUSTOMREQUEST, "DELETE");
	        }

	        if($this->_put){
	        	curl_setopt($myCurl, CURLOPT_CUSTOMREQUEST, "PUT");
	        	curl_setopt($myCurl, CURLOPT_POSTFIELDS, json_encode($this->_postFields));
	        }

	    	curl_setopt($myCurl,CURLOPT_URL,$this->_url); 
	    	curl_setopt($myCurl,CURLOPT_SSL_VERIFYPEER, false); 
	    	curl_setopt($myCurl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($myCurl,CURLOPT_HTTPHEADER,$this->_header); 
	        curl_setopt($myCurl,CURLOPT_TIMEOUT, 30); 
	        curl_setopt($myCurl,CURLOPT_MAXREDIRS, 4); 
	        curl_setopt($myCurl,CURLOPT_RETURNTRANSFER,true); 
	        $data = curl_exec($myCurl);
	        $httpcode = curl_getinfo($myCurl, CURLINFO_HTTP_CODE); 

	       	$header_size = curl_getinfo($myCurl, CURLINFO_HEADER_SIZE);
	        $header_aux = substr($data, 0, $header_size);

	        if($this->_delete){
	        	if(strcmp($data, "false") ==0){
	        		throw new Exception("Error Message: Object Not Found ");
	        	}
	        }
	        
	        if($data === false){
	        	$error = curl_error($myCurl);
	        	throw new Exception("Error Message: ".$error." ".$header_aux);
	        }

	        if(empty($data)==true){
	        	$error = curl_error($myCurl);
	        	throw new Exception("Error Message: Empty response, ".$header_aux);
	        }

	        if($httpcode==400){
	        	$error = curl_error($myCurl);
	        	throw new Exception("Error Message: ".$error." ".$header_aux);
	        }

	        if($httpcode == 401){
	        	throw new Exception("Error Message: Expired Token, ".$header_aux);
	        }

	        if($httpcode == 405){
	        	throw new Exception("Error Message: Not Allowed, ".$header_aux);
	        }

	        if($httpcode == 500){
	        	throw new Exception("Error Message: Error Server. ".$header_aux);
	        }

	        curl_close($myCurl); 
	        return $data;
	    
    }

}