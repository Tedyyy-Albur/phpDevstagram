<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\select;

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
    public function comentarios()
    {
        //Se ocupa hasMany para hacer la peticion de todo lo que esta ahi dentro de esa
        //tabla 
        return $this->hasMany(Comentario::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function checkLike(User $user)
    {
        //Valida que ya exista un like
        return $this->likes->contains('user_id', $user->id);
    }
}
