<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertenencia extends Model
{
    use HasFactory;

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario','idusuario','id');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Models\Grupo','idgrupo','id');
    }
}
