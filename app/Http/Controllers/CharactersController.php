<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CURLRequest;
use App\Models\GenericCRUD; // Model for generic CRUDs

class CharactersController extends Controller
{

    /** 
    * @brief Getting a page of characters JSON file
    *
    * @param Request $options number of page to see
    * 
    * @return string JSON
    **/
    public function getCharactersAll(Request $options){
        //If page doesn't exist then it will get the value 1
        $page = $options['page'] ?? 1;
        $entity = 'characters';
        
        $result = GenericCRUD::getEntityAll($entity, $page);
        
        return $result;


        // OLD CODE, ONLY FOR EXPERIMENTATION
        /*
        //base URL where the data is catched
        $baseURL = env('API_BASE_URL') ;

        //Construction of the usable URL for read the data of a specific page in JSON
        $url = $baseURL ."/character/?page=".$page;

        //Getting the JSON file
        $rspJso=CURLRequest::JSON($url);

        //Returning the file
        return $rspJso;
        */
    }


    /** 
    * @brief Getting a specific character JSON file
    *
    * @param int $id number of page to see
    * 
    * @return string JSON
    **/
    public function getCharacterById($id){
        $entity = 'characters';

        $result = GenericCRUD::getEntityById($entity, $id);

        return $result;
    
        /*    //base URL where the data is catched
        $baseURL=env('API_BASE_URL') ;

        //Construction of the usable URL for read the data of a specific page in JSON
        $url = $baseURL ."/character/".$id;

        //Getting the JSON file
        $rspJso=CURLRequest::JSON($url);

        //Returning the file
        return $rspJso;
    
    */
    }

    /** 
    * @brief Inserting/Updating a specific character from a JSON file
    *
    * @param string $data JSON of the data
    * 
    * @return string JSON
    **/
    public function upsertCharacter(Request $data){

        $entity = 'characters';
        
        // Insert or update in Character
        $result = GenericCRUD::upsertEntity($data, $entity);

        return $result;
        
    }


    /** 
    * @brief Deleting a specific character from a JSON file
    *
    * @param string $data JSON of the data
    * 
    * @return string JSON
    **/
    public function deleteCharacter(Request $data){
        $id = $data["id"];
        $entity = 'characters';

        $result = GenericCRUD::deleteEntity($entity, $id);

        return $result;

    }
}
