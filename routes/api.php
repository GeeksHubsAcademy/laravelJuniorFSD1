<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/pedido', 'App\Http\Controllers\OrderController@lista');


//Rutas de moviecontroller

Route::get('/allmovies', [MovieController::class, 'listaTodasLasPeliculas']);
Route::get('/newmovie', [MovieController::class, 'registraPelicula']);