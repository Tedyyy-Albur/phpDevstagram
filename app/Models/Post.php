<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //se ocupa el $fillable para que pueda generar la insercion de los registros.

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        //Forma de traer la informacion necesaria de estar relacion con el suser con el post
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
}
