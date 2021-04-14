<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    //

    public function listaTodasLasPeliculas () {
        return ["Hola Diego" => "Funcionando"];
    }

    public function registraPelicula () {
        return ["Añade pelicula" => "Ok"];
    }
}
