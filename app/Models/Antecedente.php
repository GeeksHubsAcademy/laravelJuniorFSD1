<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad','activos','tipo','nombre'];

    public function usuario()
    {
     return $this->belongsTo('App\Models\Usuario', 'idusuario', 'id');
    }
}
