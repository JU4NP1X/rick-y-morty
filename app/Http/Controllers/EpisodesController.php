<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CURLRequest;
use App\Models\GenericCRUD; // Model for generic CRUDs

class EpisodesController extends Controller
{

    /** 
    * @brief Getting a page of episodes JSON file
    *
    * @param Request $options number of page to see
    * 
    * @return string JSON
    **/
    public function getEpisodesAll(Request $options){
        //If page doesn't exist then it will get the value 1
        $page = $options['page'] ?? 1;
        $entity = 'episodes';
        
        $result = GenericCRUD::getEntityAll($entity, $page);
                //base URL where the data is catched
                $baseURL = env('API_BASE_URL') ;

                //Construction of the usable URL for read the data of a specific page in JSON
                $url = $baseURL ."/episode/?page=".$page;
                error_log($url);
        
        return $result;


        // OLD CODE, ONLY FOR EXPERIMENTATION
        /*
        //base URL where the data is catched
        $baseURL = env('API_BASE_URL') ;

        //Construction of the usable URL for read the data of a specific page in JSON
        $url = $baseURL ."/episode/?page=".$page;

        //Getting the JSON file
        $rspJso=CURLRequest::JSON($url);

        //Returning the file
        return $rspJso;
        */
    }


    /** 
    * @brief Getting a specific episode JSON file
    *
    * @param int $id number of page to see
    * 
    * @return string JSON
    **/
    public function getEpisodeById($id){
        $entity = 'episodes';

        $result = GenericCRUD::getEntityById($entity, $id);

        return $result;
    
        /*    //base URL where the data is catched
        $baseURL=env('API_BASE_URL') ;

        //Construction of the usable URL for read the data of a specific page in JSON
        $url = $baseURL ."/episode/".$id;

        //Getting the JSON file
        $rspJso=CURLRequest::JSON($url);

        //Returning the file
        return $rspJso;
    
    */
    }

    /** 
    * @brief Inserting/Updating a specific episode from a JSON file
    *
    * @param string $data JSON of the data
    * 
    * @return string JSON
    **/
    public function upsertEpisode(Request $data){

        $entity = 'episodes';
        
        // Insert or update in Episode
        $result = GenericCRUD::upsertEntity($data, $entity);

        return $result;
        
    }


    /** 
    * @brief Deleting a specific episode from a JSON file
    *
    * @param string $data JSON of the data
    * 
    * @return string JSON
    **/
    public function deleteEpisode(Request $data){
        $id = $data["id"];
        $entity = 'episodes';

        $result = GenericCRUD::deleteEntity($entity, $id);

        return $result;

    }
}
