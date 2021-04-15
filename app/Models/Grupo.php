<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','boss','lema'];

    public function pertenencias()
    {
        return $this->hasMany('App\Models\Pertenencia','idgrupo','id');
    }
}
