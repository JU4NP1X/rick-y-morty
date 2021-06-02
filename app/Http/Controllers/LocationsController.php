<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CURLRequest;
use App\Models\GenericCRUD; // Model for generic CRUDs

class LocationsController extends Controller
{

    /** 
    * @brief Getting a page of locations JSON file
    *
    * @param Request $options number of page to see
    * 
    * @return string JSON
    **/
    public function getLocationsAll(Request $options){
        //If page doesn't exist then it will get the value 1
        $page = $options['page'] ?? 1;
        $entity = 'locations';
        
        $result = GenericCRUD::getEntityAll($entity, $page);
        
        return $result;


        // OLD CODE, ONLY FOR EXPERIMENTATION
        /*
        //base URL where the data is catched
        $baseURL = env('API_BASE_URL') ;

        //Construction of the usable URL for read the data of a specific page in JSON
        $url = $baseURL ."/location/?page=".$page;

        //Getting the JSON file
        $rspJso=CURLRequest::JSON($url);

        //Returning the file
        return $rspJso;
        */
    }


    /** 
    * @brief Getting a specific location JSON file
    *
    * @param int $id number of page to see
    * 
    * @return string JSON
    **/
    public function getLocationById($id){
        $entity = 'locations';

        $result = GenericCRUD::getEntityById($entity, $id);

        return $result;
    
        /*    //base URL where the data is catched
        $baseURL=env('API_BASE_URL') ;

        //Construction of the usable URL for read the data of a specific page in JSON
        $url = $baseURL ."/location/".$id;

        //Getting the JSON file
        $rspJso=CURLRequest::JSON($url);

        //Returning the file
        return $rspJso;
    
    */
    }

    /** 
    * @brief Inserting/Updating a specific location from a JSON file
    *
    * @param string $data JSON of the data
    * 
    * @return string JSON
    **/
    public function upsertLocation(Request $data){

        $entity = 'locations';
        
        // Insert or update in Location
        $result = GenericCRUD::upsertEntity($data, $entity);

        return $result;
        
    }


    /** 
    * @brief Deleting a specific location from a JSON file
    *
    * @param string $data JSON of the data
    * 
    * @return string JSON
    **/
    public function deleteLocation(Request $data){
        $id = $data["id"];
        $entity = 'locations';

        $result = GenericCRUD::deleteEntity($entity, $id);

        return $result;

    }
}
