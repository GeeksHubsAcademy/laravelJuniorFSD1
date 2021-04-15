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

        return Post::when($titulo, function($query, $titulo) {
            return $query->where('titulo', 'LIKE', $titulo);
        })
        ->when($text, function($query, $text) {
            return $query->where('text', 'LIKE', $text);
        })
        ->when($image_link, function($query, $image_link) {
            return $query->where('image_link', 'LIKE', $image_link);
        })
        ->get();

    }
}


/*

return Oferta::selectRaw('ofertas.* , empresas.name, empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->when($activas, function ($query, $activas) {
            return $query->where('isActive', '=', $activas);
        })
        ->when($orden, function ($query, $orden) {
            return $query->orderBy('fecha_publi', 'DESC');
        })
        ->when($estado, function ($query, $estado) {
            return $query->where('estado', '=', $estado);
        })
        ->when($keyword, function ($query, $keyword) {
            return $query->where('desc_general', 'LIKE', "%{$keyword}%");
        })
        ->where('idempresa', '=',$id)
        ->get();






*/