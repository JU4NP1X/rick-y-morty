<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\CURLRequest;
/** 
* @brief Generic CRUD creator from objects
* @return null 
**/

class GenericCRUD extends Model
{

    /** 
    * @brief Generic entity migration
    *
    * @param int $id of the entity who will send the parameters information
    *
    * @param string $entity name of the entity to create (needs to have the same name of the origin)
    * 
    * @return null 
    **/
    public static function migrateEntity($entity, $id){
        $dbEntity = $entity;
        $dbPath   = database_path(env('DB_DATABASE', 'dbfilename'));
        $url = env('API_BASE_URL');

        // Correction of the name
        if (substr($entity, -1) == 's')
            $entity = substr ($entity, 0, strlen($entity)-1);
        
        $url .= "/$entity/$id";

        // Creation of the DB if not exist
        if (!file_exists($dbPath)){
            $db = fopen($dbPath, 'w');
            fclose($db);
        }

        // Consult the DB of the remote server
        $rspJso = CURLRequest::JSON($url);
        $data   = json_decode($rspJso);

        // Creation of the "CREATE" SQL
        foreach ($data as $key => $content){
            $type = $key === 'id' ?'INTEGER PRIMARY KEY AUTOINCREMENT' : 'TEXT';
            $colsArray[] = "$key $type";
        }
        $entityCols = implode(',' , $colsArray );
        $sql = "CREATE TABLE IF NOT EXISTS $dbEntity ($entityCols)";


        DB::insert($sql);

        // Get all elementes
        $pages = GenericCRUD::getMigrateEntitiesAll($entity);
        
        
        $sql = "SELECT COUNT(*) as count FROM $dbEntity WHERE id = :id";
        foreach ($pages as $result)
            foreach ($result as $col){
                $exist = false;


                if(property_exists($col, 'id'))
                    $exist = DB::select($sql, ['id' => $col->id])[0]->count;
        
        
                if(!$exist)
                    GenericCRUD::insertEntity($dbEntity, $col);
                else
                    GenericCRUD::updateEntity($dbEntity, $col);
        
            }
    
    }


    /** 
    * @brief Generic entity SELECT *, it will send a limited amount of rows
    *
    * @param int $page page of the entity who will send the parameters information
    *
    * @param string $entity name of the entity to SELECT the data
    *
    * @param int $perPage (default 20) number of elements to send per page
    * 
    * @return string
    **/
    public static function getEntityAll($entity, $page, $perPage = 20){
        
        // Get the number of elements
        $sql    = "SELECT COUNT(id) as total
                    FROM $entity ;";

        $result = DB::select($sql);
        $count  = $result[0]->total;
    


        // Get a number of elements from the total defined by $perPage
        $sql    = "SELECT * 
                    FROM $entity 
                    LIMIT :perPage1
                    OFFSET (:page - 1) * :perPage2;";

        $result = DB::select($sql, ['perPage1' => $perPage,
                                    'page'    => $page,
                                    'perPage2' => $perPage
                                    ]);
    
        foreach ($result as $row){
            foreach ($row as $col){
                json_decode($col);
                if(json_last_error() === JSON_ERROR_NONE){
                    error_log($col);
                    $col = json_decode($col);

                }
            }
        }
        $JSON = [
            'info' =>[
                'count'=> $count,
                'pages'=> ceil($count/$perPage),
                'next' =>env('API_BASE_URL')."/".substr($entity,0, -1)."/?page=".($page+1),
                'prev' =>NULL
            ],
            'results' => $result
        ];

        $JSON = json_encode($JSON);
        $JSON = str_replace('\\', '', $JSON);
        $JSON = str_replace('"[', '[', $JSON);
        $JSON = str_replace(']"', ']', $JSON);
        $JSON = str_replace('"{', '{', $JSON);
        $JSON = str_replace('}"', '}', $JSON);

        return $JSON;

    }



    /** 
    * @brief Generic entity SELECT *, it will send the row asociated to the id
    *
    * @param string $entity name of the entity to SELECT the data
    *
    * @param int $id id asociated with the row
    * 
    * @return string JSON or NULL
    **/

    public static function getEntityById($entity, $id){
        // Get the number of elements
        $sql    = "SELECT *
                    FROM $entity 
                    WHERE id = :id;";

        $result = DB::select($sql, ['id' => $id])[0];
        $JSON = json_encode($result, JSON_UNESCAPED_SLASHES);
        $JSON = str_replace('\\', '', $JSON);
        $JSON = str_replace('"[', '[', $JSON);
        $JSON = str_replace(']"', ']', $JSON);
        $JSON = str_replace('"{', '{', $JSON);
        $JSON = str_replace('}"', '}', $JSON);

        return $JSON;
    }



    /** 
    * @brief Generic entity INSERT, it will UPDATE if the id already exist.
    *
    * @param JSON $JSON string with the information to INSERT/UPDATE
    *
    * @param string $entity name of the entity to SELECT the data
    * 
    * @return string JSON or NULL
    **/
    public static function upsertEntity($JSON, $entity){

        // Data separation
        $data = json_decode($JSON->getContent());
        $exist = false;

        if(property_exists($data, 'id')){
            $sql = "SELECT COUNT(*) as count FROM $entity WHERE id = :id";
            $exist = DB::select($sql, ['id' => $data->id])[0]->count;
        }
            

        if(!$exist)
            GenericCRUD::insertEntity($entity, $data);
        else
            GenericCRUD::updateEntity($entity, $data);


        
        $JSON = ['error'=> false,
                'msg' => 'Registro Creado'];
        $JSON = json_encode($JSON, JSON_UNESCAPED_SLASHES);

        return $JSON;
    }


    /** 
    * @brief Generic entity DELETE *, it will delete the row asociated to the id
    *
    * @param string $entity name of the entity to DELETE the data
    *
    * @param int $id id asociated with the row
    * 
    * @return string JSON or NULL
    **/
    public static function deleteEntity($entity, $id){
    
        // Query for delete
        $sql = "DELETE FROM
                $entity
            WHERE
                id=:id
        ;";

        $result = DB::delete($sql, ['id'    => $id]);

        $JSON = ['error'=> false,
                'msg' => 'Registro Eliminado'];
        $JSON = json_encode($JSON, JSON_UNESCAPED_SLASHES);

        return $JSON;
    }




    /** 
    * @brief Generic entity INSERT *, it will insert the row
    *
    * @param string $entity name of the entity to INSERT the data
    *
    * @param object $data the information to insert
    * 
    * @return string JSON or NULL
    **/
    private static function insertEntity($entity, $data){

 
        foreach ($data as $keys => $content){
            // In case its contains an array it will encode again
            if(is_object($content) || is_array($content)){
                $content = json_encode($content, JSON_UNESCAPED_SLASHES);
            }
 
            $content = str_replace("'", "''", $content);
            $vals[] = "\n'$content'";
            $cols [] = "\n$keys";
        }

        // Data ordenation
        $cols = implode(',' , $cols );
        $vals = implode(',' , $vals );


        // Query for insert and update
        $sql = "INSERT INTO
                    $entity
                    ($cols)
                VALUES
                    ($vals)
                ;";
        
        $result = DB::insert($sql);
        error_log("\nINSERTED");
        return $result;
        
    }

    

    /** 
    * @brief Generic entity UPDATE *, it will update the row asociated to the id
    *
    * @param string $entity name of the entity to SELECT the data
    *
    * @param object $data the information to update
    * 
    * @return string JSON or NULL
    **/
    private static function updateEntity($entity, $data){

 
        foreach ($data as $keys => $content){
            // In case its contains an array it will encode again
            if(is_object($content) || is_array($content)){
                $content = json_encode($content, JSON_UNESCAPED_SLASHES);
            }

            $content = str_replace("'", "''", $content);
            $valsUpdate[] = "\n$keys = '$content'";
        }

        // Data ordenation
        $cols = implode(', ' , $valsUpdate );


        // Query for insert and update
        $sql = "UPDATE $entity
                SET
                    $cols
                WHERE
                    id = :id
                ;";

        $result = DB::update($sql, ['id' => $data->id]);
    
        error_log("\nUPDATED");
        return $result;
        
    }

    

    /** 
    * @brief Generic entity migration selection, it will select all the pages if you not specify the number of $pages
    *
    * @param string $entity name of the entity to SELECT the data
    *
    * @param int $pages (optional) needs to be >0, it will set the number of pages to get 
    * 
    * @return array of Objects 
    **/
    private static function getMigrateEntitiesAll($entity, $pages = NULL){

        $url = env('API_BASE_URL') ."/$entity/?page=1";
        error_log("\n$url");
        

        $rspJso = CURLRequest::JSON($url);
        $data[]  = json_decode($rspJso)->results;
        if (!$pages)
            $pages  = json_decode($rspJso)->info->pages;

        for ($i = 2; $i <= $pages; $i++){
            $url = env('API_BASE_URL') ."/$entity/?page=$i";
            error_log("\n$url");        
            $rspJso = CURLRequest::JSON($url);
            $data[] = json_decode($rspJso)->results;
        }
        
        // Converting an array in an object
        $JSON = json_encode($data, JSON_UNESCAPED_SLASHES);
        $data = json_decode($JSON);


        return $data;

    }

    private static function recursive_array_replace($find, $replace, $array) {

        if (!is_array($array)) {
            return str_replace($find, $replace, $array);
        }
    
        $newArray = array();
    
        foreach ($array as $key => $value) {
            $newArray[$key] = GenericCRUD::recursive_array_replace($find, $replace, $value);
        }
    
        return $newArray;
    }
}
