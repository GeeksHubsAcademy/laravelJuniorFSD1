<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','fecha_publicacion','text','image_link'];

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario','idusuario','id');
    }
}
