<?php

use Illuminate\Support\Facades\Route;


//Controllers list:
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\MigrationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/




//**********************************************//
//**************Character Requests**************//
//**********************************************//
Route::get('/Characters/{id}', [CharactersController::class, 'getCharacterById']);
Route::get('/characters/{id}', [CharactersController::class, 'getCharacterById']);
Route::get('/Crud/Characters/{id}', [CharactersController::class, 'getCharacterById']);
Route::get('/crud/characters/{id}', [CharactersController::class, 'getCharacterById']);
Route::get('/Api/Character/{id}', [CharactersController::class, 'getCharacterById']);
Route::get('/api/character/{id}', [CharactersController::class, 'getCharacterById']);

Route::get('/Crud/Characters', [CharactersController::class, 'getCharactersAll']);
Route::get('/crud/characters', [CharactersController::class, 'getCharactersAll']);
Route::get('/Api/Character', [CharactersController::class, 'getCharactersAll']);
Route::get('/api/character', [CharactersController::class, 'getCharactersAll']);
Route::get('/Characters', [CharactersController::class, 'getCharactersAll']);
Route::get('/characters', [CharactersController::class, 'getCharactersAll']);

Route::match(['post', 'patch'],'/Crud/Characters/', [CharactersController::class, 'upsertCharacter']);
Route::match(['post', 'patch'],'/crud/characters/', [CharactersController::class, 'upsertCharacter']);
Route::match(['post', 'patch'],'/Api/Character/', [CharactersController::class, 'upsertCharacter']);
Route::match(['post', 'patch'],'/api/character/', [CharactersController::class, 'upsertCharacter']);
Route::match(['post', 'patch'],'/Characters/', [CharactersController::class, 'upsertCharacter']);
Route::match(['post', 'patch'],'/characters/', [CharactersController::class, 'upsertCharacter']);

Route::delete('/Crud/Characters', [CharactersController::class, 'deleteCharacter']);
Route::delete('/crud/characters', [CharactersController::class, 'deleteCharacter']);
Route::delete('/Api/Character', [CharactersController::class, 'deleteCharacter']);
Route::delete('/api/character', [CharactersController::class, 'deleteCharacter']);
Route::delete('/Characters', [CharactersController::class, 'deleteCharacter']);
Route::delete('/characters', [CharactersController::class, 'deleteCharacter']);




//**********************************************//
//**************Location Requests***************//
//**********************************************//
Route::get('/Crud/Locations/{id}', [LocationsController::class, 'getLocationById']);
Route::get('/crud/locations/{id}', [LocationsController::class, 'getLocationById']);
Route::get('/Api/Locations/{id}', [LocationsController::class, 'getLocationById']);
Route::get('/api/locations/{id}', [LocationsController::class, 'getLocationById']);
Route::get('/Locations/{id}', [LocationsController::class, 'getLocationById']);
Route::get('/locations/{id}', [LocationsController::class, 'getLocationById']);

Route::get('/Crud/Locations', [LocationsController::class, 'getLocationsAll']);
Route::get('/crud/locations', [LocationsController::class, 'getLocationsAll']);
Route::get('/Api/Locations', [LocationsController::class, 'getLocationsAll']);
Route::get('/api/locations', [LocationsController::class, 'getLocationsAll']);
Route::get('/Locations', [LocationsController::class, 'getLocationsAll']);
Route::get('/locations', [LocationsController::class, 'getLocationsAll']);

Route::match(['post', 'patch'],'/Crud/Locations/', [LocationsController::class, 'upsertLocation']);
Route::match(['post', 'patch'],'/crud/locations/', [LocationsController::class, 'upsertLocation']);
Route::match(['post', 'patch'],'/Api/Locations/', [LocationsController::class, 'upsertLocation']);
Route::match(['post', 'patch'],'/api/locations/', [LocationsController::class, 'upsertLocation']);
Route::match(['post', 'patch'],'/Locations/', [LocationsController::class, 'upsertLocation']);
Route::match(['post', 'patch'],'/locations/', [LocationsController::class, 'upsertLocation']);

Route::delete('/Crud/Locations', [LocationsController::class, 'deleteLocation']);
Route::delete('/crud/locations', [LocationsController::class, 'deleteLocation']);
Route::delete('/Api/Locations', [LocationsController::class, 'deleteLocation']);
Route::delete('/api/locations', [LocationsController::class, 'deleteLocation']);
Route::delete('/Locations', [LocationsController::class, 'deleteLocation']);
Route::delete('/locations', [LocationsController::class, 'deleteLocation']);



//**********************************************//
//**************Episodes Requests***************//
//**********************************************//
Route::get('/Crud/Episodes/{id}', [EpisodesController::class, 'getEpisodeById']);
Route::get('/crud/episodes/{id}', [EpisodesController::class, 'getEpisodeById']);
Route::get('/Api/Episodes/{id}', [EpisodesController::class, 'getEpisodeById']);
Route::get('/api/episodes/{id}', [EpisodesController::class, 'getEpisodeById']);
Route::get('/Episodes/{id}', [EpisodesController::class, 'getEpisodeById']);
Route::get('/episodes/{id}', [EpisodesController::class, 'getEpisodeById']);

Route::get('/Crud/Episodes', [EpisodesController::class, 'getEpisodesAll']);
Route::get('/crud/episodes', [EpisodesController::class, 'getEpisodesAll']);
Route::get('/Api/Episodes', [EpisodesController::class, 'getEpisodesAll']);
Route::get('/api/episodes', [EpisodesController::class, 'getEpisodesAll']);
Route::get('/Episodes', [EpisodesController::class, 'getEpisodesAll']);
Route::get('/episodes', [EpisodesController::class, 'getEpisodesAll']);

Route::match(['post', 'patch'],'/Crud/Episodes/', [EpisodesController::class, 'upsertEpisode']);
Route::match(['post', 'patch'],'/crud/episodes/', [EpisodesController::class, 'upsertEpisode']);
Route::match(['post', 'patch'],'/Api/Episodes/', [EpisodesController::class, 'upsertEpisode']);
Route::match(['post', 'patch'],'/api/episodes/', [EpisodesController::class, 'upsertEpisode']);
Route::match(['post', 'patch'],'/Episodes/', [EpisodesController::class, 'upsertEpisode']);
Route::match(['post', 'patch'],'/episodes/', [EpisodesController::class, 'upsertEpisode']);

Route::delete('/Crud/Episodes', [EpisodesController::class, 'deleteEpisode']);
Route::delete('/crud/episodes', [EpisodesController::class, 'deleteEpisode']);
Route::delete('/Api/Episodes', [EpisodesController::class, 'deleteEpisode']);
Route::delete('/api/episodes', [EpisodesController::class, 'deleteEpisode']);
Route::delete('/Episodes', [EpisodesController::class, 'deleteEpisode']);
Route::delete('/episodes', [EpisodesController::class, 'deleteEpisode']);



//**********************************************//
//*************Migrations Requests**************//
//**********************************************//
Route::get('/crud/migrate/{entity}', [MigrationsController::class, 'migrate']);
Route::get('/Crud/Migrate/{entity}', [MigrationsController::class, 'migrate']);















