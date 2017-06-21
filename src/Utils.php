<?php
namespace IcarrosAPI;


class Utils
{


	public static function convertHeaderCurl($array)
    {

    	foreach ($array as $key => $value) {
    		
    		$headers[] = [ $key ': '. $value];

    	}
    	
        return $headers;
    }


}