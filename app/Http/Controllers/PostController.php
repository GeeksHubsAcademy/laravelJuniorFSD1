<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    //

    public function busquedaVariada($parametro1){

        return Post::where('titulo', 'LIKE', $parametro1)
        ->orWhere('text', 'LIKE', $parametro1)
        ->orWhere('image_link', 'LIKE', $parametro1)
        ->get();
    }

    public function busquedaFiltrada(Request $request){

        $titulo = $request->input('titulo');
        $text = $request->input('text');
        $image_link = $request->input('image_link');
        $fecha_post = $request->input('fecha_post');


        return Post::when($titulo, function($query, $titulo) {
            return $query->where('titulo', 'LIKE', $titulo);
        })
        ->when($text, function($query, $text) {
            return $query->where('text', 'LIKE', "%{$text}%");
        })
        ->when($fecha_post, function ($query, $fecha_post) {
            return $query->orderBy('fecha_publi', 'ASC');
        })
        ->when($fecha_post, function ($query, $fecha_post) {
            $query->where('fecha_publi', '>=', $fecha_post);
        })
        ->when($image_link, function($query, $image_link) {
            return $query->where('image_link', 'LIKE', $image_link);
        })
        ->get();

    }

    public function cuentaPosts(){
        return Post::all()->count();
    }

    public function mensajesParty($identificador){

        return Post::where('id', 'LIKE', $identificador)->get();

    }

    public function searchPartyGameName($gameName){

        return Partida::selectRaw('partida.id, game.id AS idgame, game.nombre')
        ->join('games', 'games.id', '=', 'partida.game_id')
        ->where('games.nombre', 'LIKE', $gameName)
        ->get();

    }
}
