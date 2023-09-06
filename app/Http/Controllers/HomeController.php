<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //CON EL __invoke ayuda a que inicialice como un constructor, 
    //con este ya no necesitamos pasarle el nombre del metodo,
    //esto solo si se usara un controlador para algo en especifico
    public function __invoke()
    {
        //obtener a quienes seguimos
        //pluck ayuda a especificar que es lo que queremos de la peticion que estamos haciendo
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);

        return view('home',[
            'posts' => $posts
        ]);
    }
}
