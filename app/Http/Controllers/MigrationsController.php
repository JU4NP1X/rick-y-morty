<?php

namespace App\Http\Controllers;

use App\Models\GenericCRUD;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;

class MigrationsController extends Controller
{
    public function migrate ($entity){
        GenericCRUD::migrateEntity($entity, 1);
    }
}
