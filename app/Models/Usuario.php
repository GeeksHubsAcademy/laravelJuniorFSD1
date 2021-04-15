<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','password','email','nickname','token'];

    //Relación uno a muchos de usuario hacia posts
    public function posts () {
        
        return $this->hasMany('App\Models\Post','idusuario');
            
    }

    //Relacion uno a uno
    public function antecedentes() {
        
        return $this->hasOne('App\Models\Antecedente');
    }

    //Relación muchos a muchos de usuario hacia la tabla central
    public function pertenencias()
    {
        return $this->hasMany('App\Models\Pertenencia','idusuario');
        
    }


}
