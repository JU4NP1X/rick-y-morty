<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


    /** 
    * 
    * @brief prepared CURL Request class
    *
    **/
class CURLRequest extends Model
{
    use HasFactory;
    /** 
    * @brief prepared CURL Request for JSON strings, only needs an URL
    *
    * @param string $url name of the URL of the JSON file
    * 
    * @return string or NULL
    **/
    public static function JSON($url){
        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        return $result;
    }
}
