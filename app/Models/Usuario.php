<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','password','email','nickname'];

    public function posts () {
        
        return $this->hasMany('App\Models\Post','idusuario');
            
    }
}
