<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PostController;


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

// Route::get('/allmovies', [MovieController::class, 'listaTodasLasPeliculas']);
// Route::get('/newmovie', [MovieController::class, 'registraPelicula']);

//Rutas controladoras de Usuario 

Route::post('/login', [UsuarioController::class, 'loginUsuario']);
Route::post('/logout', [UsuarioController::class, 'logOut'])->middleware('token');
Route::get('/perfil/{nickname}', [UsuarioController::class, 'usuarioNombre']);
Route::post('/register', [UsuarioController::class, 'registerUser']);
Route::put('/update', [UsuarioController::class, 'modifyUser']);
Route::delete('/borrar', [UsuarioController::class, 'deleteUser']);

//Rutas controladoras de Post

Route::get('/searchpost/{parametro1}', [PostController::class, 'busquedaVariada']);
Route::post('/searchfilter', [PostController::class, 'busquedaFiltrada']);